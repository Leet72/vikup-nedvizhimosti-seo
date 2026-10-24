<!DOCTYPE html>
<html <?php language_attributes(); ?>>
	<head>
    <?php wp_head(); ?>
    <title><?php wp_title();?></title>
    <meta property="og:image" content="https://vikup-nedvizhimosti.moscow/wp-content/uploads/2025/02/unnamed-5.jpg">
	<meta name="viewport" content="width=device-width">
		<meta name="yandex-verification" content="d7fd6dddd7765991" />
		<meta name="google-site-verification" content="lu7hEP__e0j3yXBXk4KJxuDhQfDQUv2YhYD91p4DpsE" />
    <link href="<?php bloginfo("template_directory"); ?>/favicon.svg" rel="shortcut icon" />
    <link href="<?php bloginfo("template_directory"); ?>/favicon.svg" rel="icon" type="image/x-icon" />
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Comfortaa:wght@300;400;500;600;700&family=Montserrat:wght@100;200;300;400;500;600;700;800;900&family=Roboto:wght@100;300;400;500;700;900&display=swap" rel="stylesheet">
    <!— Marquiz script start —>
<script>
(function(w, d, s, o){
var j = d.createElement(s); j.async = true; j.src = '//script.marquiz.ru/v2.js';j.onload = function() {
if (document.readyState !== 'loading') Marquiz.init(o);
else document.addEventListener("DOMContentLoaded", function() {
Marquiz.init(o);
});
};
d.head.insertBefore(j, d.head.firstElementChild);
})(window, document, 'script', {
host: '//quiz.marquiz.ru',
region: 'eu',
id: '65cb29b53f87bf002616f8f9',
autoOpen: false,
autoOpenFreq: 'once',
openOnExit: false,
disableOnMobile: false
}
);
</script>
<!— Marquiz script end —>
<script defer src="https://af.click.ru/af.js?id=18295"></script>
	</head>
    <?php 
    $logo_site = carbon_get_theme_option('nk_logo_site');
    $logo_site_url = wp_get_attachment_image_url( $logo_site, 'full' );
    $acc_color = carbon_get_theme_option( 'nk_acc_color' );
    $dark_color = carbon_get_theme_option( 'nk_dark_color' );
    $bg_color = carbon_get_theme_option( 'nk_bg_color' );
    $nk_ph_one = carbon_get_theme_option( 'nk_phone_one' );
    $nk_adr = carbon_get_theme_option( 'nk_address' );
    ?>
    <style type="text/css">
        :root {
          --acc: #FF7A3A;
          --main: #035269;
          --dark: #414141;
          --bg: #F4F4F4;
          --gr: linear-gradient(90deg, #003C4D, #0085AB);
          --tr: rgba(255, 255, 255, .06);
          --tr_2: rgba(255, 255, 255, .1);
          --fs_w:44px;
          --fs_1:32px;
          --fs_2:18px;
          --fs_3:15px;
          --fs_4:14px;
        }
        @media screen and (max-width: 560px){
        :root {
          --fs_w:34px;
        }
        :root {
          --fs_1:24px;
        }
        :root {
          --fs_2:16px;
        }
        }
        @media screen and (max-width: 360px){
        :root {
          --fs_2:15px;
        }
        }
		.grecaptcha-badge {visibility: hidden;}
    </style>
<body <?php body_class(); ?>>
<div class="nk_full_box"> <!-- ------------------------------------- обертка всего сайта -->
<!-- ------------------------------------- попап видео -->
<div class="nk_popap _video">
    <div class="nk_close_cover"></div>
    <div class="nk_box">
        <div class="nk_close">
            <svg width="17" height="18" viewBox="0 0 17 18" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path fill-rule="evenodd" clip-rule="evenodd" d="M6.45038 8.85348L0 15.3039L1.90326 17.2071L8.35364 10.7567L14.804 17.2071L16.7073 15.3039L10.2569 8.85348L16.7072 2.40323L14.8039 0.499969L8.35364 6.95022L1.90338 0.499969L0.000123373 2.40323L6.45038 8.85348Z" fill="white"/>
            </svg>
        </div>
        <div class="nk_video_box">
             <iframe width="560" height="315" src="/tehnicheskaya/" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" allowfullscreen></iframe>
        </div>
    </div>
</div>
<!-- ------------------------------------- форма обратная связь -->
<div class="nk_popap _form">
    <div class="nk_close_cover"></div>
    <div class="nk_box">
        <div class="nk_close">
            <svg width="17" height="18" viewBox="0 0 17 18" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path fill-rule="evenodd" clip-rule="evenodd" d="M6.45038 8.85348L0 15.3039L1.90326 17.2071L8.35364 10.7567L14.804 17.2071L16.7073 15.3039L10.2569 8.85348L16.7072 2.40323L14.8039 0.499969L8.35364 6.95022L1.90338 0.499969L0.000123373 2.40323L6.45038 8.85348Z" fill="white"/>
            </svg>
        </div>
        <div class="nk_form">
        <h3>Оставте ваш телефон</h3>
        <p class="nk_desc">Мы перезвоним вам в ближайшее время</p>    
        <?php echo do_shortcode( '[contact-form-7 id="a9470ea" title="Форма 1 поле"]' ); ?>
        <?php if ($nk_ph_one):?> 
        <h4>Или позвоните по номеру:</h4>
            <a class="nk_phone nk_acc" href="tel:<?php echo $nk_ph_one ?>">
            <?php echo $nk_ph_one ?>
            </a>
        <?php endif; ?>
        </div>
        
    </div>
</div>
<!-- ------------------------------------- мобильное меню -->
<div class="nk_popap _menu">
    <div class="nk_close_cover"></div>
    <div class="nk_box">
        <div class="nk_close">
            <svg width="17" height="18" viewBox="0 0 17 18" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path fill-rule="evenodd" clip-rule="evenodd" d="M6.45038 8.85348L0 15.3039L1.90326 17.2071L8.35364 10.7567L14.804 17.2071L16.7073 15.3039L10.2569 8.85348L16.7072 2.40323L14.8039 0.499969L8.35364 6.95022L1.90338 0.499969L0.000123373 2.40323L6.45038 8.85348Z" fill="white"/>
            </svg>
        </div>
        <div class="nk_contact_bar">
            <?php if ($nk_ph_one): ?>  
               <a class="nk_phone" href="tel:<?php echo $nk_ph_one ?>"><?php echo $nk_ph_one ?></a>
            <?php endif; ?>
            <div class="nk_bar">
              <?php
              $nk_link_bar = carbon_get_theme_option('nk_link_bar');
              if (!empty($nk_link_bar)): ?> 
              <?php foreach ($nk_link_bar as $nk_link_item): 
              $icon_link = $nk_link_item['nk_icon_link'];
              $icon_link_url = wp_get_attachment_image_url( $icon_link, 'full' );
              $link_link = $nk_link_item['nk_link_link'];
              ?> 
              <?php if ($icon_link and $link_link):?> 
              <a target="_blank" class="nk_point" href="<?php echo $link_link ?>">
                  <img src="<?php echo $icon_link_url ?>">
              </a>
              <?php endif; ?>
              <?php endforeach;?>
              <?php endif; ?>
            </div> 
        </div>
        <?php wp_nav_menu( array( 'theme_location'=>'top_menu') );?>
    </div>
</div>
<!-- ------------------------------------- выподающая шапка -->
<header class="nk_header _drop">
 <div class="nk_nav">
    <div class="nk_container">
    <?php wp_nav_menu( array( 'theme_location'=>'top_menu') );?>
    <div class="nk_mob_btn"><span></span></div>
    </div>
 </div>
</header>
<!-- ------------------------------------- шапка -->
<header class="nk_header">
    <div class="nk_container">
      <div class="nk_wrapp">
       <a class="nk_logo" href="/">
         <?php if ($logo_site): ?>  
             <img src="<?php echo $logo_site_url ?>" alt="Московский выкуп квартир" title="Агентство недвижимости Московский выкуп квартир">
         <?php endif; ?>
       </a>
       <div class="nk_links">
           <div class="nk_box">
               <?php if ($nk_ph_one): ?>  
               <a class="nk_phone" href="tel:<?php echo $nk_ph_one ?>"><?php echo $nk_ph_one ?></a>
               <?php endif; ?>
               <div class="nk_bar">
                  <?php
                  $nk_link_bar = carbon_get_theme_option('nk_link_bar');
                  if (!empty($nk_link_bar)): ?> 
                  <?php foreach ($nk_link_bar as $nk_link_item): 
                  $icon_link = $nk_link_item['nk_icon_link'];
                  $icon_link_url = wp_get_attachment_image_url( $icon_link, 'full' );
                  $link_link = $nk_link_item['nk_link_link'];
                  ?> 
                  <?php if ($icon_link and $link_link):?> 
                  <a target="_blank" class="nk_point" href="<?php echo $link_link ?>">
                      <img src="<?php echo $icon_link_url ?>">
                  </a>
                  <?php endif; ?>
                  <?php endforeach;?>
                  <?php endif; ?>
               </div>
           </div>
           <div class="nk_btn _form">получить консультацию</div>
        </div>
       </div>
    </div>
 <div class="nk_nav">
    <div class="nk_container">
    <?php wp_nav_menu( array( 'theme_location'=>'top_menu') );?>
    <div class="nk_mob_btn"><span></span></div>
    </div>
 </div>
</header>
<!-- ------------------------------------- мобильное меню  -->