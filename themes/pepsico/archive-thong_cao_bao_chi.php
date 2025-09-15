<?php get_header(); ?>

<?php
// 1) ẢNH NỀN
$bg = '';
if (function_exists('get_field')) {

  // === ƯU TIÊN: LẤY TỪ PAGE 'tin-tuc' NẾU BẠN MUỐN DÙNG 1 ẢNH CHUNG ===
  if (!$bg) {
    if ($src = get_page_by_path('tin-tuc')) {
      // Trường đơn:
      $bg = trim((string) get_field('news_bg_url', $src->ID));

      // Nếu bạn lưu dưới Group field tên 'news', mở dòng dưới:
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
if (is_post_type_archive()) {
  $hero_title = post_type_archive_title('', false);      // tiêu đề archive của CPT
} elseif (is_tax()) {
  $hero_title = single_term_title('', false);            // tiêu đề taxonomy archive
} elseif (is_search()) {
  $hero_title = sprintf(__('Kết quả cho: %s','td'), get_search_query());
} elseif (is_archive()) {
  $hero_title = get_the_archive_title();                 // các archive khác (ngày, tác giả…)
} else {
  $hero_title = get_the_title();                         // page hoặc single
}
?>
<section class="page-hero" <?php if($bg) echo 'style="background-image:url('.esc_url($bg).')"'; ?>>
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
                <?php echo esc_html( get_the_date('d/m/Y') ); ?>
              </span>
            </div>
          </article>
        <?php endwhile; ?>

        <nav class="spv-news-pagination">
          <?php
          echo paginate_links([
            'total'     => $GLOBALS['wp_query']->max_num_pages,
            'prev_text' => '« Trước',
            'next_text' => 'Sau »',
          ]);
          ?>
        </nav>

      <?php else: ?>
        <p class="spv-news-empty">Chưa có bài viết.</p>
      <?php endif; ?>
    </section>

    <!-- Cột phải (30%) dành cho bộ lọc sau -->
    <aside class="spv-news-filter" aria-label="Bộ lọc">
      <div class="spv-news-filterCard">
        <h3 class="spv-news-filterTitle">Bộ lọc</h3>
        <p class="spv-news-filterHint">Khu vực bộ lọc (30%).</p>
      </div>
    </aside>
  </div>

</main>

<?php get_footer(); ?>