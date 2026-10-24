<?php get_header(); ?>

<section class="nk_page _esti">
<!-- ------------------------------------- верх страници -->
<div class="nk_page_top">
   <div class="nk_bg"><?php the_post_thumbnail('large'); ?></div>
   <!-- ---------- хлебные крошки -->
   <div class="nk_bread_crumbs"> 
        <div class="nk_container">
           <?php if( function_exists('kama_breadcrumbs') ) kama_breadcrumbs(' / '); ?>
       </div>
   </div>
   <div class="nk_container nk_page_title">
       <h1>Статьи</h1>
   </div>
</div>
<!-- ------------------------------------- портфолио -->
<section class="nk_portfolio">
  <div class="nk_container">
    <div class="nk_wrapp">
      <?php
            if ( have_posts() ) : 
            $posts = get_posts( array(
            'post_type' => 'post',
            'post_status'  => 'publish',
            'posts_per_page' => -1
            ));
                foreach( $posts as $post ){ setup_postdata( $post );
                ?> 
                <a href="<?php the_permalink(); ?>" class="nk_job"> 
                    <div class="nk_img"><?php the_post_thumbnail('medium'); ?></div>
                    <h3><?php the_title(); ?></h3>
                </a>
                <?php 
                };
                wp_reset_postdata();
            endif;
            ?>      
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
      <h2 class="nk_title">ХОТИТЕ ПОДРОБНЕЕ ОБСУДИТЬ ВАШУ ПРОБЛЕМУ И ВОЗМОЖНОСТЬ СРОЧНОЙ ПРОДАЖИ КВАРТИРЫ?</h2>
      <h3>Позвоните нам <a class="nk_acc" href="tel:<?php echo $nk_ph_one ?>"><?php echo $nk_ph_one ?></a> или оставьте заявку и мы сразу же  с вами свяжемся.</h3>
      <p>Наш менеджер готов вас бесплатно проконсультировать и подобрать для Вас оптимальное решение. Мы выкупаем квартиры в максимально  быстрые сроки и несем полную юридическую  ответственность за все этапы сделки.</p>
    </div>
  </div>
</section>
</section>
<?php get_footer(); ?>