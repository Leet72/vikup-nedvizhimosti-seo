# Reviews block v2 — installation plan (not deployed)

The new isolated responsive block is implemented as:

- `wp-content/themes/mvk/template-parts/reviews.php` — PHP template, reads existing `nk_feedback_bar` Carbon Fields records.
- `wp-content/themes/mvk/css/reviews-redesign.css` — styles scoped to `.mvk-reviews`.
- `wp-content/themes/mvk/js/reviews-redesign.js` — accessible previous/next controls, no jQuery/Owl dependency.

## Integrate into existing theme

1. **Before touching production:** make a complete tested backup of WordPress files and the database.
2. Replace **only** the old reviews section in `index.php` (from the `<!-- отзывы -->` comment through its closing `</section>`, before the `<!-- видео отзывы -->` comment) with:

```php
<!-- ------------------------------------- отзывы -->
<?php get_template_part('template-parts/reviews'); ?>
```

3. Register the new CSS/JS using `wp_enqueue_scripts` in `functions.php`:

```php
function mvk_enqueue_review_block_assets() {
    if (is_front_page()) {
        $css_rel = '/css/reviews-redesign.css';
        $js_rel = '/js/reviews-redesign.js';
        wp_enqueue_style('mvk-reviews', get_template_directory_uri() . $css_rel, array(), filemtime(get_template_directory() . $css_rel));
        wp_enqueue_script('mvk-reviews', get_template_directory_uri() . $js_rel, array(), filemtime(get_template_directory() . $js_rel), true);
    }
}
add_action('wp_enqueue_scripts', 'mvk_enqueue_review_block_assets');
```

4. Ensure the three new files exist before replacing `index.php` / `functions.php`.
5. Test on staging: desktop/mobile layout, real Carbon Fields reviews/images, links, keyboard operation, no console errors, no new PHP warnings, and unchanged page metadata / forms.
6. Replace the placeholder in `#mvk-yandex-rating-slot` with the **exact code from the company's Yandex Business account**. No rating value is invented.

## Notes

- The original website's URLs and other PHP templates are untouched.
- Existing reviews still come from Carbon Fields; the empty admin panel problem is separate and remains unresolved.
- The earlier static `ya_feedback-3.png` is **not** a live official badge.
- This GitHub repository is public: no passwords, database exports, private information, or credentials belong here.
