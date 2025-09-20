<?php
/**
 * Template Name: Sản phẩm
 */

get_header();

// Cho phép 'data:' nếu sau này bạn nhúng SVG data URI
$allowed_protocols = array_merge(wp_allowed_protocols(), ['data']);
?>

<?php
// ===== Danh sách sản phẩm (CPT pepsico) =====
$drinks_query = new WP_Query([
  'post_type' => 'pepsico',
  'posts_per_page' => -1,
  'orderby' => 'date',
  'order' => 'ASC',
  'no_found_rows' => true,
  'ignore_sticky_posts' => true,
]);

if ($drinks_query->have_posts()): ?>
<div class="container">
    <div class="home-drink-carousel" role="region" aria-label="<?=
      esc_attr__('Băng chuyền sản phẩm', 'pepsico-theme')
      ?>">
        <div class="home-drink-track">
            <?php while ($drinks_query->have_posts()):
          $drinks_query->the_post(); ?>
            <div class="drink-item">
                <a href="<?php the_permalink(); ?>" aria-label="<?=
                esc_attr(sprintf(__('Xem “%s”', 'pepsico-theme'), get_the_title()))
                ?>">
                    <?php
              if (has_post_thumbnail()) {
                the_post_thumbnail('medium', ['loading' => 'lazy', 'decoding' => 'async']);
              } else {
                echo '<span class="drink-thumb-ph" aria-hidden="true"></span>';
              }
              ?>
                </a>
            </div>
            <?php endwhile; ?>
        </div>
    </div>
</div>
<?php
else:
  // Fallback khi chưa có bài “pepsico”
  echo '<div class="container"><p class="spv-empty">' .
    esc_html__('Chưa có sản phẩm.', 'pepsico-theme') .
    '</p></div>';
endif;
wp_reset_postdata();
?>

<?php
// ===== Khối giới thiệu thương hiệu (ACF group: brand_intro) =====
$brand = (array) get_field('brand_intro'); // trả về array hoặc []
$title = trim((string) ($brand['brand_title'] ?? ''));
$body = (string) ($brand['brand_body'] ?? '');
?>

<?php if ($title || $body): ?>
<section class="brand-hero" aria-label="<?=
    esc_attr__('Giới thiệu thương hiệu', 'pepsico-theme')
    ?>">
    <?php if ($title): ?>
    <h2 class="brand-hero__title"><?php echo esc_html($title); ?></h2>
    <?php endif; ?>

    <?php if ($body): ?>
    <div class="brand-hero__desc"><?php echo wp_kses_post($body); ?></div>
    <?php endif; ?>
</section>
<?php endif; ?>

<?php get_footer(); ?>