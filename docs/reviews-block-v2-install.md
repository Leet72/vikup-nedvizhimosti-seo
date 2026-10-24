# Установка блока отзывов с Яндекс Картами (черновик, НЕ опубликован)

Новый блок состоит из трёх файлов:
- `wp-content/themes/mvk/template-parts/reviews.php`
- `wp-content/themes/mvk/css/reviews-redesign.css`
- `wp-content/themes/mvk/js/reviews-redesign.js`

## Официальный виджет
Предоставленный владельцем iframe ведёт на `https://yandex.ru/maps-reviews-widget/161893440217?comments`, карточка организации: `https://yandex.ru/maps/org/moskovskiy_vykup_kvartir/161893440217/`.

**Это полноценный виджет отзывов 560×800, не маленький бейдж 150×50.** На широком экране он встраивается справа от пояснения, а на мобильном — под текстом на всю ширину. Ссылка-атрибуция Яндекс Карт сохранена. Яндекс загружает реальные отзывы/рейтинг в iframe.

## Интеграция в WordPress
1. Создать и проверить полный бэкап файлов + базы данных; желательно отдельную тестовую копию.
2. Сверить текущие файлы на сервере с локальными исходниками, переданными ранее. Старые файлы нельзя заменять вслепую.
3. Скопировать файлы шаблона, CSS, JS в соответствующие пути темы `mvk`.
4. **Только** старую секцию `nk_feedback` в `index.php` (между комментариями `<!-- отзывы -->` и `<!-- видео отзывы -->`) заменить вызовом:

```php
<!-- ------------------------------------- отзывы -->
<?php get_template_part('template-parts/reviews'); ?>
```

5. Добавить в `functions.php` после существующей регистрации стилей скриптов:

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

6. Тесты перед публикацией: реальные отзывы Carbon Fields, URL, слайдер, адаптивность, загрузка iframe в браузере, клики в Яндекс, доступность внешнего виджета, формы заявок, PHP и консольные ошибки. Сравнить метатеги и время загрузки.

## Статус
- Код и CSS изменены только в рабочей ветке GitHub.
- На реальном WordPress изменения **не внесены**.
- В локальном окружении `php -l` для PHP файлов успешен; макеты 1440px и 390px без горизонтального переполнения.
- В среде автоматического локального предпросмотра сетевой iframe блокируется. В браузере пользователя виджет загружается, если Яндекс доступен и разрешает встраивание.
