<?php
/**
 * MVK service page #123: safely replace hardcoded SEO text in tp_archive.php.
 * Usage: php apply-service-123-copy.php /absolute/path/to/wp-content/themes/mvk/tp_archive.php /private/site-backups
 * Only edits this template; never modifies the WordPress database or URLs.
 */
declare(strict_types=1);
if (PHP_SAPI !== 'cli' || count($argv) !== 3) {
    fwrite(STDERR, "Usage: php apply-service-123-copy.php THEME_TEMPLATE BACKUP_DIR\n");
    exit(2);
}
$file = realpath($argv[1]);
$dir = realpath($argv[2]);
if ($file === false || $dir === false ||
    basename($file) !== 'tp_archive.php' ||
    basename(dirname($file)) !== 'mvk' ||
    basename(dirname(dirname($file))) !== 'themes' ||
    !is_file($file) || !is_dir($dir) || !is_writable($dir) ||
    str_starts_with($dir . '/', dirname($file) . '/')) {
    fwrite(STDERR, "STOP: unexpected template/backup location.\n");
    exit(2);
}
$old = file_get_contents($file);
if ($old === false) {
    fwrite(STDERR, "STOP: cannot read original file.\n");
    exit(3);
}
$oldTitle = '<h1><?php the_title(); ?></h1>';
$blockStart = '<h2>Срочный выкуп квартир в Москве с обременением: Гарантированное решение вашей проблемы!</h2>';
$blockEnd = 'Мы заботимся о вашем комфорте и безопасности!</p>';
$required = [
    "Template Name: архив",
    "'post_parent' => 123",
    'do_shortcode( ',
    "get_footer();"
];
foreach ($required as $marker) {
    if (!str_contains($old, $marker)) {
        fwrite(STDERR, "STOP: unexpected template structure, missing: $marker\n");
        exit(4);
    }
}
if (substr_count($old, $oldTitle) !== 1 ||
    substr_count($old, $blockStart) !== 1 ||
    substr_count($old, $blockEnd) !== 1) {
    fwrite(STDERR, "STOP: expected H1 or old SEO section not unique. No change.\n");
    exit(4);
}
$start = strpos($old, $blockStart);
$finish = strpos($old, $blockEnd, $start);
if ($start === false || $finish === false ||
    $finish <= $start ||
    $finish - $start > 10000) {
    fwrite(STDERR, "STOP: could not safely locate old content range.\n");
    exit(4);
}
$finish += strlen($blockEnd);

$newH1 = <<<'HTML'
<h1><?php if (is_page(123)) { echo 'Срочный выкуп квартир с обременениями в Москве'; } else { the_title(); } ?></h1>
HTML;

$newBlock = <<<'HTML'
<?php if (is_page(123)) : ?>
<div class="nk_content nk_txt_editor mvk-service-seo-content">
  <h2>Как срочно продать квартиру с обременением в Москве?</h2>
  <p>Нужно продать квартиру, но она в ипотеке, в залоге или есть долги? Такая сделка может потребовать дополнительных документов и согласований. В «Московском выкупе квартир» можно обсудить вашу ситуацию и возможность срочного выкупа недвижимости в Москве. Цена, сроки и сама возможность сделки зависят от ограничений и документов.</p>

  <h3>С какими ситуациями можно обратиться?</h3>
  <ul>
    <li><a href="<?php echo esc_url(home_url('/srochnyj-vykup-kvartir/kvartira-v-ipoteke/')); ?>">Квартира в ипотеке</a> — если кредит ещё не выплачен и квартиру нужно продать.</li>
    <li><a href="<?php echo esc_url(home_url('/srochnyj-vykup-kvartir/kvartira-v-zaloge/')); ?>">Квартира в залоге</a> — если на недвижимость зарегистрировано обременение.</li>
    <li><a href="<?php echo esc_url(home_url('/srochnyj-vykup-kvartir/vykup-kvartir-s-dolgami/')); ?>">Квартира с долгами</a> — если есть задолженность по коммунальным платежам или другие долги, связанные с квартирой.</li>
    <li><a href="<?php echo esc_url(home_url('/srochnyj-vykup-kvartir/kvartira-pod-arestom/')); ?>">Квартира под арестом</a> — сначала необходимо выяснить, какие ограничения действуют и что потребуется для их снятия.</li>
  </ul>

  <h3>Как происходит срочный выкуп?</h3>
  <ol>
    <li>Вы рассказываете о квартире, её местоположении и известных ограничениях.</li>
    <li>Специалист уточняет документы и обстоятельства, которые могут повлиять на сделку.</li>
    <li>После оценки обсуждаются возможная цена, порядок расчётов и сроки.</li>
    <li>Если условия подходят и юридических препятствий нет, стороны согласовывают документы и оформление сделки.</li>
  </ol>

  <h3>Можно ли продать квартиру, если ипотека ещё не погашена?</h3>
  <p>Да, такая продажа возможна в ряде случаев, но порядок зависит от условий кредита и требований банка. Сначала нужно уточнить остаток задолженности и согласовать допустимый способ проведения сделки.</p>

  <h3>А если на квартиру наложен арест?</h3>
  <p>Арест или запрет регистрационных действий нельзя игнорировать. Пока ограничение действует, зарегистрировать переход права собственности может быть невозможно. Сначала выясняют основание ограничения и порядок его снятия.</p>

  <h3>За сколько можно срочно продать такую квартиру?</h3>
  <p>Универсальной цены нет. На предложение влияют расположение, состояние квартиры, рыночная стоимость, сумма задолженности и юридические сложности. Предварительную оценку можно обсудить после уточнения основных данных об объекте.</p>

  <p><strong>Хотите понять, получится ли продать вашу квартиру?</strong> Оставьте заявку в форме ниже или позвоните по номеру на сайте. Специалист уточнит детали и расскажет о возможных вариантах.</p>
</div>
<?php endif; ?>
HTML;

$replacement = substr($old, 0, $start) . $newBlock . substr($old, $finish);
$replacement = str_replace($oldTitle, $newH1, $replacement);

if (substr_count($replacement, 'post_parent') !== substr_count($old, 'post_parent') ||
    substr_count($replacement, 'do_shortcode(') !== substr_count($old, 'do_shortcode(') ||
    !str_contains($replacement, 'get_footer();') ||
    !str_contains($replacement, 'is_page(123)')) {
    fwrite(STDERR, "STOP: structural validation failed; no changes made.\n");
    exit(5);
}
umask(0077);
$backup = rtrim($dir, '/') . '/tp_archive-before-seo-' . date('Ymd-His') .
          '-' . bin2hex(random_bytes(3)) . '.php.bak';
if (!copy($file, $backup)) {
    fwrite(STDERR, "STOP: backup failed; original unchanged.\n");
    exit(6);
}
chmod($backup, 0600);
$temp = tempnam(dirname($file), '.mvk-service-');
if ($temp === false || file_put_contents($temp, $replacement) !== strlen($replacement)) {
    if ($temp !== false) @unlink($temp);
    fwrite(STDERR, "STOP: cannot write temporary file; original unchanged. Backup: $backup\n");
    exit(7);
}
chmod($temp, fileperms($file) & 0777);
$lintResult = 1;
$lintOutput = [];
exec(escapeshellarg(PHP_BINARY) . ' -l ' . escapeshellarg($temp) . ' 2>&1', $lintOutput, $lintResult);
if ($lintResult !== 0) {
    @unlink($temp);
    fwrite(STDERR, "STOP: syntax check failed; original unchanged. Backup: $backup\n" . implode("\n", $lintOutput) . "\n");
    exit(8);
}
if (!rename($temp, $file)) {
    @unlink($temp);
    fwrite(STDERR, "STOP: could not install; backup: $backup\n");
    exit(9);
}
echo "SUCCESS: replaced only old SEO copy and page-123 H1 in tp_archive.php.\n";
echo "BACKUP: $backup\n";
echo "PHP LINT: OK\n";
echo "POSTCHECK: page ID 123 H1, service links, cards and Contact Form 7, mobile layout.\n";
