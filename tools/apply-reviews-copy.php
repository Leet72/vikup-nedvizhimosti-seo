<?php
/**
 * MVK: patch the Yandex reviews introduction only.
 * Usage: php apply-reviews-copy.php /absolute/path/to/wp-content/themes/mvk/index.php /private/backup-directory
 * Does not touch the review iframe, other homepage sections, or the WordPress database.
 */
declare(strict_types=1);

$file = $argv[1] ?? '';
$backupDir = $argv[2] ?? '';
if (
    PHP_SAPI !== 'cli' ||
    basename($file) !== 'index.php' ||
    basename(dirname($file)) !== 'mvk' ||
    basename(dirname(dirname($file))) !== 'themes' ||
    !is_file($file) ||
    !is_dir($backupDir) ||
    !is_writable($backupDir)
) {
    fwrite(STDERR, "STOP: expected theme index.php and a writable private backup directory.\n");
    exit(2);
}
$source = file_get_contents($file);
if ($source === false) {
    fwrite(STDERR, "STOP: cannot read theme template.\n");
    exit(3);
}
$changes = [
    [
        '<p class="mvk-yandex-reviews__eyebrow">Яндекс Карты</p>',
        '<p class="mvk-yandex-reviews__eyebrow">Отзывы клиентов</p>'
    ],
    [
        '<h2 class="mvk-yandex-reviews__title" id="mvk-yandex-reviews-title">Отзывы о компании<br>на Яндекс Картах</h2>',
        '<h2 class="mvk-yandex-reviews__title" id="mvk-yandex-reviews-title">Отзывы о «Московском<br>выкупе квартир»</h2>'
    ],
    [
        '<p class="mvk-yandex-reviews__description">Читайте отзывы клиентов непосредственно из карточки «Московский выкуп квартир» на Яндекс Картах.</p>',
        '<p class="mvk-yandex-reviews__description">Узнайте, что клиенты говорят о нашей работе. Оценки и комментарии загружаются напрямую из Яндекс Карт.</p>'
    ],
    [
        '>Открыть отзывы на Яндексе <span aria-hidden="true">→</span></a>',
        '>Смотреть отзывы на Яндексе <span aria-hidden="true">→</span></a>'
    ],
    [
        <<<'OLD'
            <p class="mvk-yandex-reviews__note">Рейтинг и отзывы формирует Яндекс. На нашем сайте они не редактируются.</p>
            <a class="mvk-yandex-reviews__all" href="<?php echo esc_url(home_url('/otzyvy-o-kompanii-moskovskii-vykup-kvartir/')); ?>">Все отзывы на сайте <span aria-hidden="true">→</span></a>
OLD
        ,
        ''
    ],
];

$updated = $source;
$applied = 0;
foreach ($changes as [$old, $new]) {
    $count = substr_count($updated, $old);
    if ($count !== 1) {
        fwrite(STDERR, "STOP: review template differs (expected one exact match, got {$count}). No files changed.\n");
        exit(4);
    }
    $updated = str_replace($old, $new, $updated);
    $applied++;
}
if (
    substr_count($source, 'maps-reviews-widget/161893440217?comments') !== 1 ||
    substr_count($updated, 'maps-reviews-widget/161893440217?comments') !== 1 ||
    substr_count($source, 'data-marquiz-id="65cb29b53f87bf002616f8f9"') !== 1 ||
    substr_count($updated, 'data-marquiz-id="65cb29b53f87bf002616f8f9"') !== 1 ||
    !str_contains($updated, 'contact-form-7')
) {
    fwrite(STDERR, "STOP: expected iframe/quiz/form integrity check failed. No files changed.\n");
    exit(5);
}
if (substr_count($source, '<section class="mvk-yandex-reviews"') !== 1) {
    fwrite(STDERR, "STOP: reviews section not uniquely identified. No files changed.\n");
    exit(6);
}

umask(0077);
$backupDir = rtrim($backupDir, '/');
$backup = $backupDir . '/index-before-reviews-copy-' . date('Ymd-His') . '-' . bin2hex(random_bytes(3)) . '.php.bak';
if (!copy($file, $backup)) {
    fwrite(STDERR, "STOP: backup failed; original not changed.\n");
    exit(7);
}
chmod($backup, 0600);

$temp = tempnam(dirname($file), '.mvk-review-');
if ($temp === false || file_put_contents($temp, $updated) !== strlen($updated)) {
    if ($temp !== false) @unlink($temp);
    fwrite(STDERR, "STOP: temporary file failed. Original unchanged; backup: $backup\n");
    exit(8);
}
chmod($temp, fileperms($file) & 0777);
$out = [];
$exit = 1;
exec(escapeshellarg(PHP_BINARY) . ' -l ' . escapeshellarg($temp) . ' 2>&1', $out, $exit);
if ($exit !== 0) {
    @unlink($temp);
    fwrite(STDERR, "STOP: PHP lint failed; original unchanged. Backup: $backup\n");
    exit(9);
}
if (!rename($temp, $file)) {
    @unlink($temp);
    fwrite(STDERR, "STOP: rename failed; backup: $backup\n");
    exit(10);
}
echo "SUCCESS: updated $applied review text fragments only.\n";
echo "BACKUP: $backup\n";
echo "PHP LINT: OK\n";
echo "CHECK: front page, iframe, mobile and forms.\n";
