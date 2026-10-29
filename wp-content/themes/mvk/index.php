<?php get_header();?>
<!-- ------------------------------------- приветствие -->
<section class="nk_welcome">
	<img class="nk_bg" src="<?php bloginfo("template_directory"); ?>/img/welcome.jpg">
	<div class="nk_container">
		<div class="nk_txt">
			<h1>Срочный выкуп квартир <span class="nk_acc">в Москве</span></h1>
			<ul>
			   <li>Выкупим квартиру с любыми обременениями</li>
			   <li>Оценка недвижимости в течение 30 минут с момента	обращения</li>
			   <li>Оплата наличными за 1-3 дня после обращения</li>
			   <li>Аванс до 20 000 000 ₽ день в день</li>
				<li>Срок выкупа от 1 до 4 дней</li>
			   <li>Сопровождение юриста на всех этапах сделки</li>
			</ul>
		</div>
		<div class="nk_wrapp">
			<div class="nk_form">
			    <h2>Оцените	свою	квартиру	бесплатно</h2>
			    <?php echo do_shortcode( '[contact-form-7 id="51665c4" title="Форма приветствия 5 полей"]' ); ?>
			</div>
		</div>
	</div>
</section>
<!-- ------------------------------------- баннер -->
<div class="nk_banner">
	<div class="nk_container">
		<img class="nk_bg" src="<?php bloginfo("template_directory"); ?>/img/banner.jpg">
		<div class="nk_cover"></div>
		<p class="nk_t1">Мы покупаем дороже всех на рынке</p>
		<p class="nk_t2">Увеличиваем номинальную стоимость квартиры за счет ремонта</p>
		<p class="nk_t5">Обычные выкупные агентства покупают квартиры и сразу их «перепродают».
Наш подход более профессиональный и долгосрочный, выкупленные квартиры проходят через капитальный ремонт и возвращаются на рынок, за счет ремонта мы увеличиваем номинальную стоимость квартиры, поэтому мы готовы предложить самые выгодные условия для Вас!</p>
		<p class="nk_t3">до 93%</p>
		<p class="nk_t4">от рыночной стоимости</p>
	</div>
</div>
<!-- ------------------------------------- иконки с текстом -->
<section class="nk_icons_txt">
	<div class="nk_container">
		<h2 class="nk_title">Выкупаем квартиры с любыми долгами и самыми сложными ситуациями</h2>
		<div class="nk_wrapp">
		   <div class="nk_icon_txt">
		   	<img src="<?php bloginfo("template_directory"); ?>/img/icons/ic_h_1.svg" alt="Квартира в ипотеке" title="Срочный выкуп квартир в ипотеке">
		   	<div class="nk_txt">
		   		<h3>ИПОТЕКА</h3>
		   		<p>Квартира в ипотеке и нужно её продать? <a href="<?php echo esc_url(home_url('/srochnyj-vykup-kvartir/kvartira-v-ipoteke/')); ?>">Варианты выкупа ипотечной квартиры</a>.</p>
		   	</div>
		   </div>
		   <!-- ------ -->
		   <div class="nk_icon_txt">
		   	<img src="<?php bloginfo("template_directory"); ?>/img/icons/ic_h_2.svg">
		   	<div class="nk_txt">
		   		<h3>ДОЛГИ	ЖКХ</h3>
		   		<p>Есть долги по коммунальным платежам? <a href="<?php echo esc_url(home_url('/srochnyj-vykup-kvartir/vykup-kvartir-s-dolgami/')); ?>">Узнайте о выкупе квартиры с долгами</a>.</p>
		   	</div>
		   </div>
		   <!-- ------ -->
		   <div class="nk_icon_txt">
		   	<img src="<?php bloginfo("template_directory"); ?>/img/icons/ic_h_3.svg">
		   	<div class="nk_txt">
		   		<h3>Нужны деньги</h3>
		   		<p>Нужны деньги для бизнеса, обучения, лечения или на другие нужды</p>
		   	</div>
		   </div>
		   <!-- ------ -->
		   <div class="nk_icon_txt">
		   	<img src="<?php bloginfo("template_directory"); ?>/img/icons/ic_h_4.svg">
		   	<div class="nk_txt">
		   		<h3>ПРОБЛЕМЫ С ДОКУМЕНТАМИ</h3>
		   		<p>Сложности с оформлением квартиры в собственность</p>
		   	</div>
		   </div>
		   <!-- ------ -->
		   <div class="nk_icon_txt">
		   	<img src="<?php bloginfo("template_directory"); ?>/img/icons/ic_h_5.svg">
		   	<div class="nk_txt">
		   		<h3>АРЕСТ</h3>
		   		<p>На квартиру наложен арест? <a href="<?php echo esc_url(home_url('/srochnyj-vykup-kvartir/kvartira-pod-arestom/')); ?>">Какие варианты продажи возможны</a>.</p>
		   	</div>
		   </div>
		   <!-- ------ -->
		   <div class="nk_icon_txt">
		   	<img src="<?php bloginfo("template_directory"); ?>/img/icons/ic_h_6.svg">
		   	<div class="nk_txt">
		   		<h3>Покупка</h3>
		   		<p>Вы запланировали	покупку новой квартиры</p>
		   	</div>
		   </div>
		</div>
	</div>
</section>
<!-- ------------------------------------- шаги -->
<section class="nk_steps">
	<div class="nk_container">
		<h2 class="nk_title">КАК ПРОИСХОДИТ ВЫКУП ВАШЕЙ НЕДВИЖИМОСТИ С «МВК»</h2>
		<div class="nk_wrapp">
			<div class="nk_step">
				<img src="<?php bloginfo("template_directory"); ?>/img/st_1.png">
				<?php $nk_ph_one = carbon_get_theme_option( 'nk_phone_one' ); ?>
				<p>Вам необходимо оставить заявку на нашем сайте или	позвонить <a href="tel:<?php echo $nk_ph_one ?>"><?php echo $nk_ph_one ?></a></p>
			</div>
			<div class="nk_step">
				<img src="<?php bloginfo("template_directory"); ?>/img/st_2.png" alt="Бесплатная консультация по продаже квартиры">
				<p>Мы с вами свяжемся, менеджер подробно вас проконсультирует и ответит на все ваши вопросы по срочному выкупу квартиры в Москве</p>
			</div>
			<div class="nk_step">
				<img src="<?php bloginfo("template_directory"); ?>/img/st_3.png">
				<p>Специалист оценит вашу квартиру с помощью онлайн-показа	или личным визитом</p>
			</div>
			<div class="nk_step">
				<img src="<?php bloginfo("template_directory"); ?>/img/st_4.png">
				<p>Подготавливаем все необходимые документы для сделки по срочному выкупу недвижимости, предоставляя полное юридическое сопровождение</p>
			</div>
			<div class="nk_step">
				<img src="<?php bloginfo("template_directory"); ?>/img/st_5.png">
				<p>Оперативно проводим сделку по купле-продаже квартиры и вы получаете денежные средства</p>
			</div>
		</div>
	</div>
</section>
<!-- ------------------------------------- квиз -->
<section class="nk_quiz">
	<div class="nk_container">
		<h2 class="nk_title">Рассчитайте стоимость вашей квартиры за 2 минуты</h2>
		<div class="nk_wrapp">
			<div data-marquiz-id="65cb29b53f87bf002616f8f9"></div>
            <script>(function(t, p) {window.Marquiz ? Marquiz.add([t, p]) : document.addEventListener('marquizLoaded', function() {Marquiz.add([t, p])})})('Inline', {id: '65cb29b53f87bf002616f8f9', buttonText: 'Рассчитать стоимость квартиры', bgColor: '#035269', textColor: '#ffffff', rounded: true, shadow: 'rgba(3, 82, 105, 0.5)', blicked: true, buttonOnMobile: true})</script>
		</div>
	</div>
</section>
<!-- ------------------------------------- открытая форма -->
<section class="nk_open_form">
	<img class="nk_bg" src="<?php bloginfo("template_directory"); ?>/img/op_f.jpg">
	<div class="nk_container">
		<div class="nk_box">
			<div class="nk_form">
			<?php echo do_shortcode( '[contact-form-7 id="b024cc1" title="Открытая форма 3 поля"]' ); ?>
			</div>
		</div>
		<div class="nk_txt">
			<h2 class="nk_title">ХОТИТЕ	ПОДРОБНЕЕ ОБСУДИТЬ ВАШУ	ПРОБЛЕМУ И ВОЗМОЖНОСТЬ СРОЧНОЙ ПРОДАЖИ КВАРТИРЫ?</h2>
			<h3>Позвоните нам <a class="nk_acc" href="tel:<?php echo $nk_ph_one ?>"><?php echo $nk_ph_one ?></a> или оставьте заявку и мы сразу же	с вами свяжемся.</h3>
			<p>Бесплатно для Вас, наш менеджер готов проконсультировать и подобрать для Вас оптимальное решение. Мы выкупаем квартиры в максимально быстрые сроки и несем полную юридическую ответственность за все этапы сделки. Доверьте срочный выкуп квартиры в Москве нам!</p>
		</div>
	</div>
</section>
<!-- ------------------------------------- портфолио -->
<section class="nk_portfolio">
	<div class="nk_container">
		<h2 class="nk_title">Наши работы</h2>
		<div class="nk_wrapp">
			<?php
            if ( have_posts() ) : 
            $posts = get_posts( array(
            'post_type' => 'pf_posts',
            'post_status'  => 'publish',
            'posts_per_page' => 4
            ));
                foreach( $posts as $post ){ setup_postdata( $post );
                $txt_one_pf = carbon_get_post_meta(get_the_ID(), 'nk_txt_one_pf');
                $txt_two_pf = carbon_get_post_meta(get_the_ID(), 'nk_txt_two_pf');
                ?> 
                <a href="<?php the_permalink(); ?>" class="nk_job"> 
                    <div class="nk_img">
                    	<?php the_post_thumbnail('medium'); ?>
                    </div> 
                    <h3><?php the_title(); ?></h3>
                    <p>Оценочная стоимость: <?php echo $txt_one_pf ?></p>
                    <p>Выкуп: <?php echo $txt_two_pf ?></p>
                </a>
                <?php 
                };
                wp_reset_postdata();
            endif;
            ?>			
		</div>
		<a class="nk_link" href="/?page_id=19">смотреть все</a>
	</div>
</section>
<!-- ------------------------------------- отзывы: официальный виджет Яндекс Карт -->
<style>
/* Только секция отзывов. Другие разделы темы mvk не затрагиваются. */
.mvk-yandex-reviews,
.mvk-yandex-reviews * { box-sizing: border-box; }
.mvk-yandex-reviews {
    background: #f5f8fa;
    padding: 30px 16px 34px;
    font-family: Montserrat, Arial, sans-serif;
}
.mvk-yandex-reviews__panel {
    max-width: 1122px;
    margin: 0 auto;
    padding: 30px;
    border-radius: 22px;
    background: #07546a;
    display: grid;
    grid-template-columns: minmax(0, 1fr) minmax(0, 560px);
    column-gap: 40px;
    align-items: center;
    color: #ffffff;
}
.mvk-yandex-reviews__intro { min-width: 0; padding: 0 10px; }
.mvk-yandex-reviews__eyebrow {
    color: #ff9b5c;
    font-size: 14px;
    font-weight: 800;
    letter-spacing: 2px;
    text-transform: uppercase;
    margin: 0 0 17px;
}
.mvk-yandex-reviews__title {
    color: #ffffff !important;
    font-size: clamp(25px, 2.65vw, 34px) !important;
    line-height: 1.25 !important;
    font-weight: 800 !important;
    text-align: left !important;
    text-transform: none !important;
    margin: 0 0 21px !important;
}
.mvk-yandex-reviews__description {
    margin: 0 0 27px;
    color: #e6f2f5;
    font-size: 14px;
    line-height: 1.9;
    max-width: 380px;
}
.mvk-yandex-reviews__button {
    display: inline-flex;
    align-items: center;
    justify-content: center;
    gap: 12px;
    min-height: 47px;
    max-width: 100%;
    padding: 12px 19px;
    border-radius: 10px;
    background: #ff803b;
    color: #fff !important;
    font-size: 13px;
    font-weight: 700;
    line-height: 1.4;
    text-decoration: none !important;
    transition: background-color .18s ease;
}
.mvk-yandex-reviews__button:hover { background: #ed6c2b; color: #fff !important; }
.mvk-yandex-reviews__button:focus-visible,
.mvk-yandex-reviews__all:focus-visible { outline: 3px solid #ffa875; outline-offset: 3px; }
.mvk-yandex-reviews__note {
    color: #e0eef1;
    font-size: 11px;
    line-height: 1.65;
    max-width: 350px;
    margin: 16px 0 27px;
}
.mvk-yandex-reviews__all {
    color: #fff !important;
    text-decoration: underline !important;
    text-underline-offset: 4px;
    font-size: 12px;
    font-weight: 700;
}
.mvk-yandex-reviews__widget {
    width: 100%;
    height: 800px;
    position: relative;
    overflow: hidden;
    background: #fff;
    border-radius: 12px;
    min-width: 0;
}
.mvk-yandex-reviews__widget iframe {
    display: block;
    width: 100%;
    height: 100%;
    border: 1px solid #e6e6e6;
    border-radius: 12px;
}
.mvk-yandex-reviews__credit {
    position: absolute;
    bottom: 8px;
    left: 0;
    width: 100%;
    max-height: 14px;
    overflow: hidden;
    text-overflow: ellipsis;
    white-space: nowrap;
    padding: 0 16px;
    text-align: center;
    font: 10px/14px Arial, sans-serif;
    text-decoration: none !important;
    color: #b3b3b3 !important;
}
@media (max-width: 990px) {
    .mvk-yandex-reviews__panel {
        grid-template-columns: minmax(0, 1fr);
        gap: 27px;
        max-width: 650px;
    }
    .mvk-yandex-reviews__intro { padding: 12px 5px 0; }
    .mvk-yandex-reviews__widget { max-width: 560px; margin: 0 auto; }
}
@media (max-width: 600px) {
    .mvk-yandex-reviews { padding: 24px 10px; }
    .mvk-yandex-reviews__panel { padding: 19px 13px; border-radius: 15px; gap: 24px; }
    .mvk-yandex-reviews__intro { padding: 10px 6px 0; }
    .mvk-yandex-reviews__eyebrow { font-size: 12px; }
    .mvk-yandex-reviews__title { font-size: 27px !important; }
    .mvk-yandex-reviews__description { font-size: 13px; }
    .mvk-yandex-reviews__button { width: 100%; }
    .mvk-yandex-reviews__widget { border-radius: 9px; }
}
@media (prefers-reduced-motion: reduce) {
    .mvk-yandex-reviews__button { transition: none; }
}
</style>
<section class="mvk-yandex-reviews" id="yandex-reviews" aria-labelledby="mvk-yandex-reviews-title">
    <div class="mvk-yandex-reviews__panel">
        <div class="mvk-yandex-reviews__intro">
            <p class="mvk-yandex-reviews__eyebrow">Яндекс Карты</p>
            <h2 class="mvk-yandex-reviews__title" id="mvk-yandex-reviews-title">Отзывы о компании<br>на Яндекс Картах</h2>
            <p class="mvk-yandex-reviews__description">Читайте отзывы клиентов непосредственно из карточки «Московский выкуп квартир» на Яндекс Картах.</p>
            <a class="mvk-yandex-reviews__button" href="https://yandex.ru/maps/org/moskovskiy_vykup_kvartir/161893440217/" target="_blank" rel="noopener noreferrer">Открыть отзывы на Яндексе <span aria-hidden="true">→</span></a>
            <p class="mvk-yandex-reviews__note">Рейтинг и отзывы формирует Яндекс. На нашем сайте они не редактируются.</p>
            <a class="mvk-yandex-reviews__all" href="<?php echo esc_url(home_url('/otzyvy-o-kompanii-moskovskii-vykup-kvartir/')); ?>">Все отзывы на сайте <span aria-hidden="true">→</span></a>
        </div>
        <div class="mvk-yandex-reviews__widget">
            <iframe
                title="Отзывы о компании Московский выкуп квартир на Яндекс Картах"
                loading="lazy"
                src="https://yandex.ru/maps-reviews-widget/161893440217?comments">
            </iframe>
            <a class="mvk-yandex-reviews__credit" href="https://yandex.ru/maps/org/moskovskiy_vykup_kvartir/161893440217/" target="_blank" rel="noopener noreferrer">Московский выкуп квартир на карте Москвы — Яндекс Карты</a>
        </div>
    </div>
</section>
<!-- ------------------------------------- видео отзывы owl-carousel owl-theme-->
<?php 
$video_feedback_bar = carbon_get_theme_option('nk_video_feedback_bar');
if (!empty($video_feedback_bar)): ?>
<section class="nk_video_feedback">
	<div class="nk_container">
		<div class="nk_slider owl-carousel owl-theme">
          <?php foreach ($video_feedback_bar as $video_feedback_item): 
          $video_feedback_img = $video_feedback_item['nk_video_feedback_img'];
          $video_feedback_img_url = wp_get_attachment_image_url( $video_feedback_img, 'full' );
          $video_feedback_link = $video_feedback_item['nk_video_feedback_link'];
          ?> 
      	 <div class="nk_slide nk_video_btn" name="<?php echo $video_feedback_link ?>">
      	     <img class="nk_bg_video" src="<?php echo $video_feedback_img_url ?>">
      	     <img class="nk_ic" src="<?php bloginfo("template_directory"); ?>/img/icons/video.svg">
      	     <div class="nk_cover"></div>
      	 </div>
          <?php endforeach;?>
		</div>		
	</div>
</section>
<?php endif; ?>
<?php get_footer();