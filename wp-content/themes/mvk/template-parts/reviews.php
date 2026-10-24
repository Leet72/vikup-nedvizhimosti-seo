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
    <div class="mvk-reviews__footer">
      <div class="mvk-reviews__yandex">
        <div class="mvk-reviews__yandex-copy">
          <strong class="mvk-reviews__yandex-name">Оценка на Яндекс Картах</strong>
          <span class="mvk-reviews__yandex-caption">Реальные оценки и отзывы об организации</span>
        </div>
        <div class="mvk-reviews__yandex-slot" id="mvk-yandex-rating-slot">
          <?php /* Replace this placeholder with the exact official Yandex Business code. */ ?>
          Место для официального бейджа
        </div>
      </div>
      <a class="mvk-reviews__all" href="<?php echo esc_url(home_url('/otzyvy-o-kompanii-moskovskii-vykup-kvartir/')); ?>">
        Смотреть все отзывы
        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M5 12h14m-6-6 6 6-6 6"/></svg>
      </a>
    </div>
  </div>
</section>
