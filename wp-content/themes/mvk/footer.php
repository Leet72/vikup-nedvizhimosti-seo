<!-- - - - - - - - - - - - - - лого слайдер -->
<? $logo_slider = carbon_get_theme_option('nk_logo_slider');
?> 
<section class="nk_logo_slider ">
   <div class="nk_container"><h2>наши партнеры</h2></div>
   <div class="nk_slider owl-carousel owl-theme">
      <?php foreach ($logo_slider as $logo_slide):?>
        <div class="nk_slide">
           <img src="<?php echo wp_get_attachment_image_url($logo_slide, 'full'); ?>" alt="Image">
        </div>
      <?php endforeach; ?>
   </div>
</section>
<!--............................................................................................подвал.......-->
<?php 
$logo_site = carbon_get_theme_option('nk_logo_site');
$logo_site_url = wp_get_attachment_image_url( $logo_site, 'full' );
$nk_ph_one = carbon_get_theme_option( 'nk_phone_one' );
$nk_ph_two = carbon_get_theme_option( 'nk_phone_two' );
$to_mail = carbon_get_theme_option( 'nk_mail' );
$nk_adr = carbon_get_theme_option( 'nk_address' );
$to_map = carbon_get_theme_option( 'nk_map' );
?>
<footer class="nk_bg_main" id="contacts">
  <img class="nk_bg" src="<?php bloginfo("template_directory"); ?>/img/footer.jpg">
  <div class="nk_container">
    <div class="nk_item">
       <!--......-->
       <img class="nk_logo" src="<?php echo $logo_site_url ?>">
       <!--......-->
       <?php if ($nk_ph_one):?> 
       <a class="nk_point _phone" href="tel:<?php echo $nk_ph_one ?>"><?php echo $nk_ph_one ?></a>
       <?php endif; ?>
       <!--......-->
       <?php if ($nk_ph_two):?> 
       <a class="nk_point _phone" href="tel:<?php echo $nk_ph_two ?>"><?php echo $nk_ph_two ?></a>
       <?php endif; ?>
       <!--......-->
       <?php if ($to_mail):?> 
       <a class="nk_point _mail" href="mailto:<?php echo $to_mail ?>"><?php echo $to_mail ?></a>
       <?php endif; ?> 
       <!--......-->
       <?php if ($nk_adr):?> 
       <p class="nk_point"><?php echo $nk_adr ?></p>
         <?php if ($to_map):?> 
           <a href="#map" class="nk_btn _map" name="<?php echo $to_map; ?>">смотреть на карте</a>
         <?php endif; ?>
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
    <div class="nk_item _menu">
      <h3>Меню</h3>
      <?php wp_nav_menu( array( 'theme_location'=>'top_menu') );?>
    </div>
    <div class="nk_item _form">
      <div class="nk_form">
        <h3>Остались вопросы?</h3>
        <p>Оставьте ваш номер телефона и мы вам перезвоним</p>
       <?php echo do_shortcode( '[contact-form-7 id="a9470ea" title="Форма 1 поле"]' ); ?>
      </div>
    </div>
</div>
</footer>
<!--...................карта...-->
<?php if ($to_map): ?>
<div id="map"></div>
<div class="nk_map">
  <iframe src="/tehnicheskaya/" width="100%" height="320" frameborder="0"></iframe>
</div>
<?php endif; ?>
<!-- - - - - - - - - - - - - - копирайт -->
<div class="nk_copyright">
  <div class="nk_container">
      <p class="nk_copy">
      <svg width="13" height="13" viewBox="0 0 13 13" fill="none" xmlns="http://www.w3.org/2000/svg">
      <path fill-rule="evenodd" clip-rule="evenodd" d="M5.5812 0.0444624C4.91621 0.134705 4.2755 0.33366 3.63506 0.648751C2.925 0.99808 2.33571 1.42622 1.80785 1.97628C0.833295 2.99184 0.228153 4.24627 0.0412346 5.63824C-0.0147877 6.05554 -0.0135113 6.94142 0.0437578 7.37844C0.422999 10.272 2.72493 12.5681 5.63903 12.9595C6.04093 13.0135 6.95907 13.0135 7.36097 12.9595C8.09564 12.8608 8.69894 12.6776 9.36494 12.3511C11.3325 11.3863 12.667 9.53309 12.9588 7.36054C13.0148 6.94324 13.0135 6.05735 12.9562 5.62034C12.5786 2.73876 10.2573 0.415855 7.38172 0.0418196C6.94461 -0.0150459 6.0094 -0.0136799 5.5812 0.0444624ZM7.42717 1.15246C8.53449 1.3434 9.6865 1.96262 10.4442 2.77421C11.8105 4.23745 12.2811 6.36466 11.6458 8.20503C11.1513 9.63753 10.2193 10.7033 8.88993 11.3565C7.37121 12.1027 5.69897 12.1186 4.19914 11.4012C3.01852 10.8364 2.22325 10.0552 1.63482 8.88242C0.7241 7.06724 0.938896 4.87746 2.19181 3.20333C3.05109 2.05524 4.46254 1.26382 5.95076 1.09566C6.30447 1.05569 7.02733 1.08351 7.42717 1.15246ZM5.89637 2.47575C5.24798 2.58158 4.7026 2.80403 4.21007 3.16351C3.54397 3.64967 3.01647 4.35887 2.77798 5.08889C2.48974 5.97115 2.49644 7.04194 2.79553 7.89504C3.18931 9.01825 4.1044 9.94419 5.21095 10.3392C5.68285 10.5076 5.98838 10.5527 6.64844 10.5515C7.29239 10.5503 7.51487 10.5228 8.0913 10.373C8.89165 10.1651 9.42058 9.82885 9.63517 9.39172C9.72079 9.21732 9.72126 9.21334 9.73079 8.57921C9.73955 7.99802 9.73581 7.9386 9.68801 7.90365C9.6498 7.87571 9.48993 7.86535 9.09668 7.86535C8.62101 7.86535 8.55222 7.87146 8.51089 7.91731C8.47417 7.95808 8.46199 8.05795 8.45434 8.38097L8.4446 8.79268L8.30272 8.92109C7.92057 9.26694 6.83085 9.45702 6.0992 9.30545C4.96288 9.07003 4.13893 8.1293 3.97716 6.88257C3.71768 4.88322 5.08222 3.4237 7.00221 3.64697C7.54693 3.71031 8.07109 3.90258 8.23716 4.09999C8.34146 4.22397 8.37002 4.36386 8.3702 4.75164C8.37035 5.03942 8.37824 5.10041 8.41734 5.11541C8.48907 5.14293 9.53764 5.13595 9.58226 5.10766C9.61332 5.08797 9.61949 4.94439 9.61192 4.41773C9.60283 3.78256 9.59912 3.74606 9.53007 3.60673C9.44002 3.42506 9.15709 3.11924 8.96498 2.99594C8.6713 2.80744 8.08783 2.61027 7.5038 2.50218C7.14967 2.43664 6.22882 2.4215 5.89637 2.47575Z" fill="white"/>
      </svg>
      &nbsp;
      Московский выкуп квартир - агентство недвижимости,
 
      <?php echo date ( 'Y' ) ; ?> г.

      </p>
      <?php
       $copyright_info = carbon_get_theme_option('nk_copyright_info');
       if ($copyright_info): ?>  
           <p class="nk_info"><?php echo $copyright_info ?></p>
       <?php endif; ?>
   </div>
	<br>
	  <div class="container">
	<p style="text-align:center">This site is protected by reCAPTCHA and the Google
<a href="https://policies.google.com/privacy">Privacy Policy</a>
and <a href="https://policies.google.com/terms">Terms of Service</a> apply.</p>
		  </div>
</div>
<?php wp_footer(); ?>
</div><!-- ------------------------------------- обертка всего сайта end -->
<!-- Yandex.Metrika counter -->
<script type="text/javascript" >
   (function(m,e,t,r,i,k,a){m[i]=m[i]||function(){(m[i].a=m[i].a||[]).push(arguments)};
   m[i].l=1*new Date();
   for (var j = 0; j < document.scripts.length; j++) {if (document.scripts[j].src === r) { return; }}
   k=e.createElement(t),a=e.getElementsByTagName(t)[0],k.async=1,k.src=r,a.parentNode.insertBefore(k,a)})
   (window, document, "script", "https://mc.yandex.ru/metrika/tag.js", "ym");

   ym(96534818, "init", {
        clickmap:true,
        trackLinks:true,
        accurateTrackBounce:true
   });
</script>
<noscript><div><img src="https://mc.yandex.ru/watch/96534818" style="position:absolute; left:-9999px;" alt="" /></div></noscript>
<!-- /Yandex.Metrika counter -->
<!-- Begin LeadBack code {literal} -->
<script>
var _emv = _emv || [];
_emv['campaign'] = 'e1fabd6ccbf9abeb926f4de0';

(function() {
var em = document.createElement('script'); em.type = 'text/javascript'; em.async = true;
em.src = ('https:' == document.location.protocol ? 'https://' : 'http://') + 'leadback.ru/js/leadback.js';
var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(em, s);
})();
</script>
<!-- End LeadBack code {/literal} -->
<link rel="stylesheet" href="https://cdn.envybox.io/widget/cbk.css">
<script type="text/javascript" src="https://cdn.envybox.io/widget/cbk.js?wcb_code=8b821f96a164a5b07828021ac8946631" charset="UTF-8" async></script>
    <link rel="stylesheet" href="https://cdn.envybox.io/widget/cbk.css">
<script type="text/javascript" src="https://cdn.envybox.io/widget/cbk.js?wcb_code=8b821f96a164a5b07828021ac8946631" charset="UTF-8" async></script>
</body>
</html>