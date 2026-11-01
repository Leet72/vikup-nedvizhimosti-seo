<?php
/**
 * Creates ONE WordPress draft post from approved, anonymized case HTML.
 * Never publishes or updates existing posts. Run from SSH:
 * php create-mfo-case-wordpress-draft.php /path/to/public_html /path/to/case.html
 */
declare(strict_types=1);
if (PHP_SAPI !== 'cli' || count($argv) !== 3) {
    fwrite(STDERR, "Usage: php create-mfo-case-wordpress-draft.php WP_ROOT ARTICLE_HTML\n");
    exit(2);
}
$site = realpath($argv[1]);
$htmlFile = realpath($argv[2]);
if (!$site || !$htmlFile || !is_file($site . '/wp-load.php') || !is_readable($htmlFile)) {
    fwrite(STDERR, "STOP: WordPress or case file not found.\n");
    exit(2);
}
$raw = file_get_contents($htmlFile);
if ($raw === false || strlen($raw) < 2000 ||
    !str_contains($raw, 'Квартира находилась в залоге') ||
    !str_contains($raw, 'государственную регистрацию перехода права собственности') ||
    stripos($raw, '<script') !== false ||
    stripos($raw, '<iframe') !== false) {
    fwrite(STDERR, "STOP: article content differs from expected draft. No changes made.\n");
    exit(3);
}
define('WP_USE_THEMES', false);
require $site . '/wp-load.php';

$slug = 'prodazha-kvartiry-s-obremeneniem-mfo-realnyj-kejs';
$existing = get_posts([
    'name' => $slug,
    'post_type' => 'post',
    'post_status' => 'any',
    'numberposts' => 1,
]);
if ($existing) {
    fwrite(STDERR, "STOP: post with this slug already exists (ID " . $existing[0]->ID . "). No changes made.\n");
    exit(4);
}
$admins = get_users(['role'=>'administrator', 'number'=>1, 'fields'=>'ID']);
if (!$admins) {
    fwrite(STDERR, "STOP: no administrator to assign as author. No changes made.\n");
    exit(5);
}
$category = get_term_by('name', 'Статьи', 'category');
if (!$category) {
    $category = get_term_by('slug', 'stati', 'category');
}
$args = [
    'post_type' => 'post',
    'post_status' => 'draft',
    'post_author' => (int)$admins[0],
    'post_title' => 'Как помогли продать квартиру с обременением МФО: реальная сделка',
    'post_name' => $slug,
    'post_content' => wp_kses_post($raw),
    'comment_status' => 'closed',
    'ping_status' => 'closed',
];
if ($category) {
    $args['post_category'] = [(int)$category->term_id];
}
$id = wp_insert_post($args, true);
if (is_wp_error($id) || !$id) {
    fwrite(STDERR, "STOP: WordPress error inserting draft: " .
        (is_wp_error($id) ? $id->get_error_message() : 'unknown') . "\n");
    exit(6);
}
update_post_meta($id, '_yoast_wpseo_title', 'Продажа квартиры с обременением МФО — реальный кейс');
update_post_meta($id, '_yoast_wpseo_metadesc',
    'Как помогли продать квартиру с залогом МФО: погасили задолженность, получили закладную, сняли обременение и зарегистрировали переход права.');
update_post_meta($id, '_yoast_wpseo_focuskw', 'продажа квартиры с обременением МФО');

echo "DRAFT CREATED\n";
echo "ID: " . (int)$id . "\n";
echo "STATUS: " . get_post_status($id) . "\n";
echo "CATEGORY: " . ($category ? $category->name : 'default; set manually') . "\n";
echo "EDIT: " . admin_url("post.php?post=$id&action=edit") . "\n";
echo "IMPORTANT: verify client consent, names, photos and legal details before publishing.\n";
