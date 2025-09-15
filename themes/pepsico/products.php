<?php
/**
 * Template Name: Sản phẩm
 */

get_header(); ?>

<?php
$drinks_query = new WP_Query([
  'post_type'      => 'pepsico',
  'posts_per_page' => -1,
  'orderby'        => 'date',
  'order'          => 'ASC',
  'no_found_rows'  => true
]);

if ( $drinks_query->have_posts() ) : ?>
<div class="container">
  <div class="home-drink-carousel">
    <div class="container">
        <div class="home-drink-track">
            <?php while ( $drinks_query->have_posts() ) : $drinks_query->the_post(); ?>
                <div class="drink-item">
                <a href="<?php the_permalink(); ?>">
                    <?php if ( has_post_thumbnail() ) the_post_thumbnail('medium'); ?>
                </a>
                </div>
            <?php endwhile; ?>
        </div>
    </div>
  </div>
</div>
<?php
endif;
wp_reset_postdata();
?>

<?php
$brand = get_field('brand_intro'); // trả về array hoặc false
$title = is_array($brand) ? ($brand['brand_title'] ?? '') : '';
$body  = is_array($brand) ? ($brand['brand_body']  ?? '') : '';
?>

<?php if ($title || $body): ?>
<section class="brand-hero">
  <?php if ($title): ?>
    <h2 class="brand-hero__title"><?php echo esc_html($title); ?></h2>
  <?php endif; ?>

  <?php if ($body): ?>
    <div class="brand-hero__desc"><?php echo wp_kses_post($body); ?></div>
  <?php endif; ?>
</section>
<?php endif; ?>


<?php get_footer(); ?>
