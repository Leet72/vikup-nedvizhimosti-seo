<?php
/**
 * MVK WordPress database backup. CLI only.
 * Usage: php backup-wordpress-db.php /absolute/path/to/public_html /private/backups
 * Stores passwords only in a short-lived mode-0600 MySQL option file.
 * Does not execute WordPress or print credentials.
 */
declare(strict_types=1);
if (PHP_SAPI !== 'cli' || count($argv) !== 3) {
    fwrite(STDERR, "Usage: php backup-wordpress-db.php SITE_PATH PRIVATE_BACKUP_DIR\n");
    exit(2);
}
$site = realpath($argv[1]);
$backupDir = realpath($argv[2]);
if ($site === false || $backupDir === false || !is_dir($backupDir) || !is_writable($backupDir) || !is_file($site . '/wp-config.php')) {
    fwrite(STDERR, "STOP: invalid site or backup directory.\n");
    exit(2);
}
if (str_starts_with($backupDir . '/', rtrim($site, '/') . '/')) {
    fwrite(STDERR, "STOP: backup directory is inside public_html.\n");
    exit(2);
}
umask(0077);
$source = file_get_contents($site . '/wp-config.php');
if ($source === false) {
    fwrite(STDERR, "STOP: wp-config.php unreadable.\n");
    exit(2);
}
function literalDbConstant(string $source, string $name): string {
    $re = '~define\s*\(\s*[\x27\x22]' . preg_quote($name, '~') . '[\x27\x22]\s*,\s*([\x27\x22])((?:\\\\.|(?!\1).)*)\1\s*\)~s';
    if (preg_match($re, $source, $m) !== 1) {
        throw new RuntimeException("STOP: cannot read literal $name. Dynamic configurations require manual handling.");
    }
    if ($m[1] === "'") {
        return str_replace(["\\\\", "\\'"], ["\\", "'"], $m[2]);
    }
    return stripcslashes($m[2]);
}
function iniQuoted(string $value): string {
    return '"' . str_replace(["\\", '"', "\r", "\n"], ["\\\\", '\\"', '\\r', '\\n'], $value) . '"';
}
$cnf = null;
$dump = null;
try {
    $name = literalDbConstant($source, 'DB_NAME');
    $user = literalDbConstant($source, 'DB_USER');
    $password = literalDbConstant($source, 'DB_PASSWORD');
    $hostConfig = literalDbConstant($source, 'DB_HOST');
    if (preg_match('~^[a-zA-Z0-9_\-]+$~', $name) !== 1) {
        throw new RuntimeException('STOP: unusual database name; check manually.');
    }
    $host = $hostConfig;
    $port = '';
    $socket = '';
    if (preg_match('~^([^:]+):([0-9]+)$~', $hostConfig, $m)) {
        $host = $m[1]; $port = $m[2];
    } elseif (preg_match('~^([^:]+):(/[^\r\n]+)$~', $hostConfig, $m)) {
        $host = $m[1]; $socket = $m[2];
    } elseif (str_contains($hostConfig, ':')) {
        throw new RuntimeException('STOP: unusual DB_HOST; check host/port/socket manually.');
    }
    if ($host === '' || preg_match('/\s/', $host)) {
        throw new RuntimeException('STOP: invalid DB_HOST.');
    }
    $config = "[client]\n" . "user=" . iniQuoted($user) . "\n" . "password=" . iniQuoted($password) . "\n" . "host=" . iniQuoted($host) . "\n";
    if ($port !== '') $config .= 'port=' . $port . "\n";
    if ($socket !== '') $config .= 'socket=' . iniQuoted($socket) . "\n";
    $cnf = tempnam($backupDir, '.mysql-backup-');
    if ($cnf === false || !chmod($cnf, 0600) || file_put_contents($cnf, $config) !== strlen($config)) {
        throw new RuntimeException('STOP: could not create private temporary MySQL config.');
    }
    $stamp = date('Ymd-His');
    $dump = $backupDir . '/wordpress-db-' . $stamp . '-' . bin2hex(random_bytes(3)) . '.sql.gz';
    $errFile = tempnam($backupDir, '.dump-stderr-');
    if ($errFile === false) throw new RuntimeException('STOP: cannot create temporary error log.');
    chmod($errFile, 0600);
    $command = ['mysqldump', '--defaults-extra-file=' . $cnf, '--single-transaction', '--skip-lock-tables', '--quick', '--default-character-set=utf8mb4', $name];
    $pipes = [];
    $process = proc_open($command, [0 => ['file','/dev/null','r'], 1 => ['pipe','w'], 2 => ['file',$errFile,'w']], $pipes);
    if (!is_resource($process)) throw new RuntimeException('STOP: could not start mysqldump.');
    $z = gzopen($dump, 'wb6');
    if ($z === false) {
        fclose($pipes[1]); proc_close($process);
        throw new RuntimeException('STOP: cannot create compressed dump.');
    }
    $bytes = 0;
    $readError = false;
    while (!feof($pipes[1])) {
        $chunk = fread($pipes[1], 65536);
        if ($chunk === false) { $readError = true; break; }
        if ($chunk === '') continue;
        $bytes += strlen($chunk);
        if (gzwrite($z, $chunk) !== strlen($chunk)) { $readError = true; break; }
    }
    fclose($pipes[1]);
    gzclose($z);
    $exitCode = proc_close($process);
    $err = file_get_contents($errFile) ?: '';
    @unlink($errFile);
    if ($exitCode !== 0 || $bytes < 100 || $readError) {
        throw new RuntimeException('STOP: mysqldump failed or returned insufficient data; code=' . $exitCode . '. ' . substr($err, 0, 700));
    }
    $testOutput = []; $testCode = 1;
    exec('gzip -t ' . escapeshellarg($dump) . ' 2>&1', $testOutput, $testCode);
    if ($testCode !== 0 || filesize($dump) < 100) {
        throw new RuntimeException('STOP: compressed dump verification failed.');
    }
    echo "BACKUP SUCCESS\n";
    echo 'FILE: ' . $dump . "\n";
    echo 'SIZE: ' . number_format(filesize($dump)) . " bytes\n";
    echo 'SHA256: ' . hash_file('sha256', $dump) . "\n";
} catch (Throwable $e) {
    if ($dump !== null && is_file($dump)) @unlink($dump);
    fwrite(STDERR, $e->getMessage() . "\n");
    exit(1);
} finally {
    if ($cnf !== null && is_file($cnf)) @unlink($cnf);
}
