<?php
/**
 * Plugin Name: MVK Home Pagination Redirect
 * Description: Redirects fake home pagination pages to the real homepage.
 * Version: 1.0.0
 *
 * Only for the root /page/{n}/ route when WordPress considers it a paged home.
 * No changes to category, tag, search, author or article pagination.
 */
add_action('template_redirect', function () {
    if (!is_home() || !is_paged()) {
        return;
    }

    $path = parse_url(isset($_SERVER['REQUEST_URI']) ? $_SERVER['REQUEST_URI'] : '', PHP_URL_PATH);
    if (!is_string($path) || !preg_match('~^/page/([0-9]+)/?$~', $path, $matches)) {
        return;
    }

    if ((int) $matches[1] < 2) {
        return;
    }

    wp_safe_redirect(home_url('/'), 301, 'MVK SEO');
    exit;
}, 1);
