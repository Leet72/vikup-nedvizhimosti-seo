<?php get_header(); 
if( is_front_page() ){
	 require_once "home.php";
}
else {
}
if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>

<section class="nk_page _post">
  <!--......хлебные крошки.......-->   
  <div class="nk_bread_crumbs"> 
          <div class="nk_container">
             <?php if( function_exists('kama_breadcrumbs') ) kama_breadcrumbs(' / '); ?>
         </div>
  </div>
  <!--......контент.......-->
  <div class="nk_container">
      <h1><?php the_title(); ?></h1>
      <div class="nk_content nk_txt_editor"><?php the_content(); ?></div>
      <?php endwhile; else: ?>
      <p>Извините, ничего не найдено.</p>
      <?php endif; ?>
  </div>
</section>
<?php get_footer(); ?>