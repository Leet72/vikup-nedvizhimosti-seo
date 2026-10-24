<?php
/** MVK reviews section. The Yandex Business badge will replace the placeholder. */
$mvk_reviews = carbon_get_theme_option('nk_feedback_bar');
?>
<section class="nk_feedback mvk-reviews" aria-labelledby="mvk-reviews-title">
  <div class="nk_container mvk-reviews__container">
    <div class="mvk-reviews__head">
      <div>
        <span class="mvk-reviews__eyebrow">Мнение наших клиентов</span>
        <h2 class="nk_title mvk-reviews__title" id="mvk-reviews-title">Отзывы о нашей работе</h2>
        <p class="mvk-reviews__subtitle">Нам доверяют решение сложных вопросов с недвижимостью. Узнайте, что говорят наши клиенты.</p>
      </div>
      <div class="mvk-reviews__controls" aria-label="Листать отзывы">
        <button class="mvk-reviews__control" type="button" data-mvk-reviews-prev aria-label="Предыдущие отзывы" disabled>
          <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" aria-hidden="true"><path d="m14 18-6-6 6-6"/></svg>
        </button>
        <button class="mvk-reviews__control" type="button" data-mvk-reviews-next aria-label="Следующие отзывы">
          <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" aria-hidden="true"><path d="m10 18 6-6-6-6"/></svg>
        </button>
      </div>
    </div>
    <?php if (is_array($mvk_reviews) && !empty($mvk_reviews)): ?>
      <div class="mvk-reviews__viewport" data-mvk-reviews-viewport role="region" aria-label="Отзывы клиентов" tabindex="0">
        <div class="mvk-reviews__track">
          <?php foreach ($mvk_reviews as $mvk_review):
            $mvk_name = (string) ($mvk_review['nk_feedback_title'] ?? 'Клиент компании');
            $mvk_text = (string) ($mvk_review['nk_feedback_txt'] ?? '');
            $mvk_img_id = (int) ($mvk_review['nk_feedback_img'] ?? 0);
            $mvk_img_url = $mvk_img_id ? wp_get_attachment_image_url($mvk_img_id, 'thumbnail') : false;
            if (trim($mvk_text) === '') continue;
          ?>
            <article class="mvk-reviews__card">
              <div class="mvk-reviews__quote-mark" aria-hidden="true">“</div>
              <div class="mvk-reviews__quote-text"><?php echo wp_kses_post(wpautop($mvk_text)); ?></div>
              <div class="mvk-reviews__person">
                <?php if ($mvk_img_url): ?>
                  <img class="mvk-reviews__avatar" src="<?php echo esc_url($mvk_img_url); ?>" alt="" loading="lazy" decoding="async" width="44" height="44">
                <?php else: ?>
                  <span class="mvk-reviews__avatar-fallback" aria-hidden="true">●</span>
                <?php endif; ?>
                <div><h3><?php echo esc_html($mvk_name); ?></h3><span>Отзыв клиента</span></div>
              </div>
            </article>
          <?php endforeach; ?>
        </div>
      </div>
    <?php endif; ?>
    <div class="mvk-reviews__yandex-section" id="mvk-yandex-reviews">
      <div class="mvk-reviews__yandex-intro">
        <span class="mvk-reviews__eyebrow">Яндекс Карты</span>
        <h3 class="mvk-reviews__yandex-heading">Отзывы о компании на Яндекс Картах</h3>
        <p class="mvk-reviews__yandex-description">Читайте отзывы клиентов непосредственно из карточки «Московский выкуп квартир» на Яндекс Картах.</p>
        <a class="mvk-reviews__all" href="https://yandex.ru/maps/org/moskovskiy_vykup_kvartir/161893440217/" target="_blank" rel="noopener noreferrer">
          Открыть отзывы на Яндексе
          <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M5 12h14m-6-6 6 6-6 6"/></svg>
        </a>
        <p class="mvk-reviews__yandex-note">Рейтинг и отзывы формирует Яндекс. На нашем сайте они не редактируются.</p>
        <a class="mvk-reviews__internal-link" href="<?php echo esc_url(home_url('/otzyvy-o-kompanii-moskovskii-vykup-kvartir/')); ?>">Все отзывы на сайте <span aria-hidden="true">→</span></a>
      </div>
      <div class="mvk-reviews__yandex-card">
        <div class="mvk-reviews__yandex-widget">
          <iframe title="Отзывы о Московском выкупе квартир на Яндекс Картах" loading="lazy" src="https://yandex.ru/maps-reviews-widget/161893440217?comments"></iframe>
          <a href="https://yandex.ru/maps/org/moskovskiy_vykup_kvartir/161893440217/" target="_blank" rel="noopener noreferrer" class="mvk-reviews__yandex-attribution">Московский выкуп квартир на карте Москвы — Яндекс Карты</a>
        </div>
      </div>
    </div>
  </div>
</section>
