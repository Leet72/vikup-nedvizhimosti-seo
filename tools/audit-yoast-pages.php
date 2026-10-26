<?php
/**
 * MVK: read-only audit of all published WordPress pages and stored Yoast fields.
 * Usage: php audit-yoast-pages.php /home/USER/domains/DOMAIN/public_html
 * Does not modify WordPress content, settings or metadata.
 */
declare(strict_types=1);

if (PHP_SAPI !== 'cli' || count($argv) !== 2) {
    fwrite(STDERR, "Usage: php audit-yoast-pages.php /absolute/path/to/public_html\n");
    exit(2);
}
$root = realpath($argv[1]);
if ($root === false || !is_file($root . '/wp-load.php')) {
    fwrite(STDERR, "STOP: WordPress site not found.\n");
    exit(2);
}
define('WP_USE_THEMES', false);
require $root . '/wp-load.php';
$pages = get_posts([
    'post_type' => 'page',
    'post_status' => 'publish',
    'numberposts' => -1,
    'orderby' => 'menu_order',
    'order' => 'ASC'
]);
if (!is_array($pages)) {
    fwrite(STDERR, "STOP: could not list published pages.\n");
    exit(3);
}
$empty = 0;
$noFocus = 0;
$noDesc = 0;
echo "=== WORDPRESS / YOAST PUBLISHED PAGES ===\n";
echo "This report is read-only. Stored Yoast scores may differ from editor feedback.\n";
foreach ($pages as $post) {
    $id = (int) $post->ID;
    $body = trim((string) $post->post_content);
    $template = get_post_meta($id, '_wp_page_template', true);
    $keyphrase = trim((string) get_post_meta($id, '_yoast_wpseo_focuskw', true));
    $seoTitle = trim((string) get_post_meta($id, '_yoast_wpseo_title', true));
    $description = trim((string) get_post_meta($id, '_yoast_wpseo_metadesc', true));
    $linkdex = get_post_meta($id, '_yoast_wpseo_linkdex', true);
    $readability = get_post_meta($id, '_yoast_wpseo_content_score', true);
    $robots = get_post_meta($id, '_yoast_wpseo_meta-robots-noindex', true);
    if ($body === '') $empty++;
    if ($keyphrase === '') $noFocus++;
    if ($description === '') $noDesc++;
    echo "\n=== PAGE ID $id ===\n";
    echo "NAME: " . $post->post_title . "\n";
    echo "URL: " . get_permalink($id) . "\n";
    echo "TEMPLATE: " . ($template ?: 'default') . "\n";
    echo "EDITOR CONTENT: " . strlen($body) . " bytes\n";
    echo "YOAST FOCUS PHRASE: " . ($keyphrase ?: '(not set)') . "\n";
    echo "YOAST TITLE: " . ($seoTitle ?: '(default / inherited)') . "\n";
    echo "YOAST DESCRIPTION: " . ($description ?: '(empty / generated)') . "\n";
    echo "YOAST STORED SEO SCORE: " . ($linkdex === '' ? '(not stored)' : (string) $linkdex) . "\n";
    echo "YOAST STORED READABILITY: " . ($readability === '' ? '(not stored)' : (string) $readability) . "\n";
    echo "YOAST NOINDEX FLAG: " . ($robots === '' ? '(not set)' : (string) $robots) . "\n";
}
echo "\n=== SUMMARY ===\n";
echo "PUBLISHED PAGES: " . count($pages) . "\n";
echo "EMPTY WP EDITOR CONTENT: $empty\n";
echo "NO FOCUS PHRASE: $noFocus\n";
echo "NO STORED DESCRIPTION: $noDesc\n";
echo "No data has been changed.\n";
