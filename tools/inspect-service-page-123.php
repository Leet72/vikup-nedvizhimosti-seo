<?php
/**
 * Read-only audit for the existing WordPress commercial page ID 123.
 * Run: php inspect-service-page-123.php /absolute/path/to/public_html
 * Does not modify posts/options/files, and does not print wp-config credentials.
 */
declare(strict_types=1);
if (PHP_SAPI !== 'cli' || count($argv) !== 2) {
    fwrite(STDERR, "Usage: php inspect-service-page-123.php /absolute/path/to/public_html\n");
    exit(2);
}
$site = realpath($argv[1]);
if ($site === false || !is_file($site . '/wp-load.php')) {
    fwrite(STDERR, "STOP: WordPress location not found.\n");
    exit(2);
}
define('WP_USE_THEMES', false);
require $site . '/wp-load.php';

$post = get_post(123);
if (($post instanceof WP_Post) === false || $post->post_type !== 'page') {
    fwrite(STDERR, "STOP: page #123 not available.\n");
    exit(3);
}
if ($post->post_name !== 'srochnyj-vykup-kvartir') {
    fwrite(STDERR, "STOP: page #123 slug differs. No data disclosed.\n");
    exit(3);
}
$raw = (string) $post->post_content;
$clean = strip_shortcodes($raw);
$clean = preg_replace('~<(script|style)\b[^>]*>.*?</\1>~is', '', $clean);
$clean = preg_replace('~<[^>]+>~u', ' ', $clean);
$clean = html_entity_decode($clean, ENT_QUOTES | ENT_HTML5, 'UTF-8');
$clean = preg_replace('~\s+~u', ' ', $clean);
$clean = trim((string) $clean);
if (function_exists('mb_substr')) {
    $sample = mb_substr($clean, 0, 6500, 'UTF-8');
} else {
    $sample = substr($clean, 0, 6500);
}
$title = (string) get_post_meta(123, '_yoast_wpseo_title', true);
$description = (string) get_post_meta(123, '_yoast_wpseo_metadesc', true);
$template = (string) get_post_meta(123, '_wp_page_template', true);
echo "=== WORDPRESS PAGE ===\n";
echo 'ID: ' . (int) $post->ID . "\n";
echo 'TITLE: ' . $post->post_title . "\n";
echo 'SLUG: ' . $post->post_name . "\n";
echo 'STATUS: ' . $post->post_status . "\n";
echo 'TEMPLATE: ' . ($template !== '' ? $template : 'default') . "\n";
echo 'CONTENT BYTES: ' . strlen($raw) . "\n";
echo 'CONTENT SHA256: ' . hash('sha256', $raw) . "\n";
echo 'STORED YOAST TITLE: ' . ($title !== '' ? $title : '(empty / inherited)') . "\n";
echo 'STORED YOAST DESCRIPTION: ' . ($description !== '' ? $description : '(empty / inherited)') . "\n";
echo "=== VISIBLE CONTENT SAMPLE (MAX 6500 CHARS) ===\n";
echo $sample . "\n";
echo "=== DONE, READ ONLY ===\n";
