# Готовая замена одного index.php для темы MVK

Текущий вариант: пользователь может скачать полностью подготовленный **index.php** в чате и целиком заменить на сайте `wp-content/themes/mvk/index.php`.

## Что изменилось
В исходном файле заменена только секция между комментариями:
- `<!-- ------------------------------------- отзывы -->`
- `<!-- ------------------------------------- видео отзывы owl-carousel owl-theme-->`

Вся старая секция `<section class="nk_feedback"> ... </section>` удалена. Вместо неё вставлено:

```html
<!-- ------------------------------------- отзывы: официальный виджет Яндекс Карт -->
<section class="nk_feedback" id="yandex-reviews" aria-labelledby="yandex-reviews-title">
    <div class="nk_container">
        <h2 class="nk_title" id="yandex-reviews-title" style="text-align:center;">Отзывы о нашей работе</h2>
        <div style="width:100%;max-width:560px;height:800px;overflow:hidden;position:relative;margin:24px auto 0;border-radius:8px;">
            <iframe
                title="Отзывы о компании Московский выкуп квартир на Яндекс Картах"
                loading="lazy"
                src="https://yandex.ru/maps-reviews-widget/161893440217?comments"
                style="display:block;width:100%;height:100%;border:1px solid #e6e6e6;border-radius:8px;box-sizing:border-box;">
            </iframe>
            <a
                href="https://yandex.ru/maps/org/moskovskiy_vykup_kvartir/161893440217/"
                target="_blank"
                rel="noopener noreferrer"
                style="box-sizing:border-box;text-decoration:none;color:#b3b3b3;font-size:10px;font-family:Arial,sans-serif;padding:0 16px;position:absolute;bottom:8px;width:100%;text-align:center;left:0;overflow:hidden;text-overflow:ellipsis;display:block;max-height:14px;white-space:nowrap;">
                Московский выкуп квартир на карте Москвы — Яндекс Карты
            </a>
        </div>
    </div>
</section>
```

## Проверено
- Исходником служил прикреплённый владельцем полный `index.php` темы `mvk` от 21 октября 2026 года, **не корневой `public_html/index.php` WordPress**.
- Отличия ограничены секцией отзывов; остальной шаблон оставлен без изменений.
- `php -l` для полного обновлённого файла выполнен без ошибок.
- Никакие дополнительные стили, плагины или JS не требуются.

## Безопасная установка
Перед заменой: сделать бэкап действующего `index.php` и полную резервную копию файлов сайта и БД. Сравнить файл с текущей версией хостинга: если после 21 октября были изменения, не перезаписывать их. 

Место назначения: `public_html/wp-content/themes/mvk/index.php`. **Не заменять корневой `public_html/index.php`!** Проверить отображение Яндекс iframe, мобильную версию, основные формы и другие страницы. При проблеме вернуть старый `index.php`.

Сам рабочий сайт не изменён; запись в GitHub — документация единственного файла для замены.
