<?php get_header(); ?>

<?php
// 1) ẢNH NỀN
$bg = '';
if (function_exists('get_field')) {
  // ƯU TIÊN: LẤY TỪ PAGE 'tin-tuc' (lưu ý: slug này không do Loco dịch)
  if (!$bg) {
    if ($src = get_page_by_path('tin-tuc')) {
      $bg = trim((string) get_field('news_bg_url', $src->ID));
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

  if (is_array($page_con) && !empty($page_con['thong_cao_bao_chi'])) {
    $hero_title = (string) $page_con['thong_cao_bao_chi'];
  } else {
    // Trường hợp gọi trực tiếp subfield (nếu bạn không dùng group wrapper)
    $hero_title = (string) get_field('thong_cao_bao_chi', $target_id);
  }
}
?>
<section class="page-hero" <?php if (!empty($bg)) echo 'style="background-image:url(' . esc_url($bg) . ')"'; ?>>
  <span class="page-hero__overlay" aria-hidden="true"></span>
  <h1 class="page-hero__title"><?php echo esc_html($hero_title); ?></h1>
</section>


<main class="container archive-company-news">
  <div class="spv-news-archive mt-5">
    <section class="spv-news-list">
      <?php if (have_posts()): ?>
        <?php while (have_posts()): the_post(); ?>
          <article id="post-<?php the_ID(); ?>" <?php post_class('spv-news-item'); ?>>
            <h2 class="spv-news-title">
              <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
            </h2>

            <p class="spv-news-excerpt">
              <?php
              $ex = get_the_excerpt();
              if (!$ex) $ex = wp_trim_words( wp_strip_all_tags(get_the_content()), 50 );
              echo esc_html($ex);
              ?>
            </p>

            <div class="spv-news-meta">
              <span class="spv-news-date">
                <?php echo esc_html( get_the_date( get_option('date_format') ) ); ?>
              </span>
            </div>
          </article>
        <?php endwhile; ?>

        <nav class="spv-news-pagination" aria-label="<?php echo esc_attr__('Phân trang', 'td'); ?>">
          <?php
          echo paginate_links([
            'total'     => $GLOBALS['wp_query']->max_num_pages,
            'prev_text' => esc_html__('« Trước', 'td'),
            'next_text' => esc_html__('Sau »', 'td'),
          ]);
          ?>
        </nav>

      <?php else: ?>
        <p class="spv-news-empty"><?php echo esc_html__('Chưa có bài viết.', 'td'); ?></p>
      <?php endif; ?>
    </section>

    <aside class="spv-news-filter" aria-label="<?php echo esc_attr__('Bộ lọc', 'td'); ?>">
      <div class="spv-news-filter__inner">
        <?php if (is_active_sidebar('news-filter')): ?>
          <?php dynamic_sidebar('news-filter'); ?>
        <?php else: ?>
          <div class="spv-news-filterCard">
            <h3 class="spv-news-filterTitle"><?php echo esc_html__('Bộ lọc', 'td'); ?></h3>
            <p class="spv-news-filterHint">
              <?php
              echo esc_html__(
                'Vào Giao diện → Widgets và kéo “Bộ lọc bài viết (Ngày & Sắp xếp)” vào khu vực này.',
                'td'
              );
              ?>
            </p>
          </div>
        <?php endif; ?>
      </div>
    </aside>
  </div>
</main>

<?php get_footer(); ?>
