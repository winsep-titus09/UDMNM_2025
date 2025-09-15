<?php
/*
Template Name: Tin tức
*/
get_header();
?>

<?php
$bg = function_exists('get_field') ? get_field('news_bg_url', get_the_ID()) : '';
?>
<section class="page-hero mt-5" <?php if($bg) echo 'style="background-image:url('.esc_url($bg).')"'; ?>>
  <span class="page-hero__overlay" aria-hidden="true"></span>
  <h1 class="page-hero__title"><?php the_title(); ?></h1>
</section>
<?php get_footer(); ?>