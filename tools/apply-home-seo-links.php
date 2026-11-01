<?php
/**
 * MVK — narrowly scoped homepage copy/link patch.
 * Run via: php apply-home-seo-links.php /full/path/to/wp-content/themes/mvk/index.php /home/user/site-backups
 *
 * Modifies only six exact strings. It refuses unknown input and keeps an external backup.
 * Does NOT access database, themes beyond index.php, or config secrets.
 */
declare(strict_types=1);

$file = $argv[1] ?? '';
$backupDir = $argv[2] ?? '';
if (
    basename($file) !== 'index.php' ||
    basename(dirname($file)) !== 'mvk' ||
    basename(dirname(dirname($file))) !== 'themes' ||
    !is_file($file) ||
    !is_dir($backupDir) ||
    !is_writable($backupDir)
) {
    fwrite(STDERR, "STOP: invalid index.php path or backup directory.\n");
    exit(2);
}

$old = file_get_contents($file);
if ($old === false) {
    fwrite(STDERR, "STOP: cannot read index.php.\n");
    exit(3);
}

$rules = [
    ['<h1>Срочный выкуп квартир <span class="nk_acc">в москве</span></h1>',
     '<h1>Срочный выкуп квартир <span class="nk_acc">в Москве</span></h1>'],

    ['<p>Ваша квартира в ипотеке, но нет возможности платить</p>',
     <<<'HTML'
<p>Квартира в ипотеке и нужно её продать? <a href="<?php echo esc_url(home_url('/srochnyj-vykup-kvartir/kvartira-v-ipoteke/')); ?>">Варианты выкупа ипотечной квартиры</a>.</p>
HTML
    ],

    ['<p>По вашей квартире имеются долги по коммунальным платежам</p>',
     <<<'HTML'
<p>Есть долги по коммунальным платежам? <a href="<?php echo esc_url(home_url('/srochnyj-vykup-kvartir/vykup-kvartir-s-dolgami/')); ?>">Узнайте о выкупе квартиры с долгами</a>.</p>
HTML
    ],

    ['<p>На квартиру наложен арест за долги, но Вам необходимо ее продать</p>',
     <<<'HTML'
<p>На квартиру наложен арест? <a href="<?php echo esc_url(home_url('/srochnyj-vykup-kvartir/kvartira-pod-arestom/')); ?>">Какие варианты продажи возможны</a>.</p>
HTML
    ],

    ['Обычные выкупные агентсва покупают',
     'Обычные выкупные агентства покупают'],

    ['ответ на все ваши вопросы по срочному выкупу кватриры в Москве',
     'ответит на все ваши вопросы по срочному выкупу квартиры в Москве'],
];

$new = $old;
$changed = 0;
foreach ($rules as [$before, $after]) {
    $count = substr_count($new, $before);
    if ($count === 0 && substr_count($new, $after) === 1) {
        continue; // already applied
    }
    if ($count !== 1) {
        fwrite(STDERR, "STOP: unexpected template text. Expected one match, got $count. No changes made.\n");
        exit(4);
    }
    $new = str_replace($before, $after, $new);
    $changed++;
}

if ($changed === 0) {
    echo "NO CHANGE: six rules already applied.\n";
    exit(0);
}
if (strpos($old, "data-marquiz-id=") === false || strpos($old, 'maps-reviews-widget/161893440217?comments') === false) {
    fwrite(STDERR, "STOP: required quiz or Yandex review block not found. No changes made.\n");
    exit(5);
}
if (strpos($new, "data-marquiz-id=") === false || strpos($new, 'maps-reviews-widget/161893440217?comments') === false) {
    fwrite(STDERR, "STOP: content check failed. No changes made.\n");
    exit(6);
}

$backupDir = rtrim($backupDir, '/');
$backup = $backupDir . '/index-before-home-seo-' . date('Ymd-His') . '-' . bin2hex(random_bytes(3)) . '.php.bak';
if (!copy($file, $backup)) {
    fwrite(STDERR, "STOP: cannot save backup. No changes made.\n");
    exit(7);
}
chmod($backup, 0600);
$tmp = tempnam(dirname($file), '.mvk-seo-');
if ($tmp === false) {
    fwrite(STDERR, "STOP: cannot prepare temp file. Saved backup: $backup\n");
    exit(8);
}
if (file_put_contents($tmp, $new) !== strlen($new)) {
    @unlink($tmp);
    fwrite(STDERR, "STOP: cannot write patch. Saved backup: $backup\n");
    exit(9);
}
chmod($tmp, fileperms($file) & 0777);
$output = [];
$code = 1;
exec(escapeshellarg(PHP_BINARY) . ' -l ' . escapeshellarg($tmp) . ' 2>&1', $output, $code);
if ($code !== 0) {
    @unlink($tmp);
    fwrite(STDERR, "STOP: php -l failed; original untouched. Saved backup: $backup\n" . implode("\n", $output) . "\n");
    exit(10);
}
if (!rename($tmp, $file)) {
    @unlink($tmp);
    fwrite(STDERR, "STOP: cannot install patch; original should be untouched. Backup: $backup\n");
    exit(11);
}
echo "SUCCESS: patched $changed exact pieces of homepage text.\n";
echo "BACKUP: $backup\n";
echo "PHP LINT: OK\n";
echo "POSTCHECK: review links, mobile layout and form submissions in browser.\n";
