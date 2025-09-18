<?php get_header(); ?>

<?php
// 1) ẢNH NỀN
$bg = '';
if (function_exists('get_field')) {
  // ƯU TIÊN: LẤY TỪ PAGE 'tin-tuc' NẾU DÙNG 1 ẢNH CHUNG
  if (!$bg) {
    if ($src = get_page_by_path('tin-tuc')) {
      // Trường đơn:
      $bg = trim((string) get_field('news_bg_url', $src->ID));

      // Nếu lưu dưới Group field tên 'news'
      if (!$bg) {
        $g = get_field('news', $src->ID);
        if (is_array($g) && !empty($g['news_bg_url'])) {
          $bg = trim((string) $g['news_bg_url']);
        }
      }
    }
  }
}

// 2) TIÊU ĐỀ
// LẤY FIELD TỪ TRANG "Tin tức" (slug: tin-tuc)
$hero_title = '';

if (function_exists('get_field')) {
  // Tìm trang Tin tức theo slug (đổi 'tin-tuc' nếu slug khác)
  $news_page = get_page_by_path('tin-tuc');

  // Nếu dùng Polylang và muốn đúng trang theo ngôn ngữ hiện tại:
  if ($news_page && function_exists('pll_get_post')) {
    $translated_id = pll_get_post($news_page->ID);
    if ($translated_id) $news_page = get_post($translated_id);
  }

  $target_id  = $news_page ? $news_page->ID : 0;
  $page_con   = $target_id ? get_field('page_con', $target_id) : null;

  if (is_array($page_con) && !empty($page_con['tin_tuc_ve_cong_ty'])) {
    $hero_title = (string) $page_con['tin_tuc_ve_cong_ty'];
  } else {
    // Trường hợp gọi trực tiếp subfield (nếu bạn không dùng group wrapper)
    $hero_title = (string) get_field('tin_tuc_ve_cong_ty', $target_id);
  }
}
?>
<section class="page-hero" <?php if (!empty($bg)) echo 'style="background-image:url(' . esc_url($bg) . ')"'; ?>>
  <span class="page-hero__overlay" aria-hidden="true"></span>
  <h1 class="page-hero__title"><?php echo esc_html($hero_title); ?></h1>
</section>


<main class="container archive-company-news">

  <?php if (have_posts()): ?>
    <div class="news-grid mt-5">
      <?php while (have_posts()): the_post(); ?>
        <article <?php post_class('news-card'); ?>>
          <a class="news-card__thumb" href="<?php the_permalink(); ?>" aria-label="<?=
            esc_attr(sprintf(__('Xem “%s”', 'pepsico-theme'), get_the_title()))
          ?>">
            <?php if (has_post_thumbnail()): ?>
              <?php the_post_thumbnail('large', ['loading' => 'lazy']); ?>
            <?php else: ?>
              <div class="news-card__placeholder" aria-hidden="true"></div>
            <?php endif; ?>
          </a>

          <h2 class="news-card__title">
            <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
          </h2>

          <div class="news-card__meta">
            <span class="news-card__date">
              <?php echo esc_html(get_the_date(get_option('date_format'))); ?>
            </span>
          </div>
        </article>
      <?php endwhile; ?>
    </div>

    <nav class="news-pagination" aria-label="<?php echo esc_attr__('Phân trang', 'pepsico-theme'); ?>">
      <?php
      echo paginate_links([
        'total'     => $GLOBALS['wp_query']->max_num_pages,
        'prev_text' => esc_html__('« Trước', 'pepsico-theme'),
        'next_text' => esc_html__('Sau »', 'pepsico-theme'),
      ]);
      ?>
    </nav>

  <?php else: ?>
    <p><?php echo esc_html__('Chưa có bài viết.', 'pepsico-theme'); ?></p>
  <?php endif; ?>

</main>

<?php get_footer(); ?>
