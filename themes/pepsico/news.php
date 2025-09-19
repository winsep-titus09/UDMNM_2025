<?php
/*
Template Name: Tin tức
*/
get_header();

// SVG arrow (data URI). Cho phép 'data:' protocol khi esc_url.
$arrow_icon = "data:image/svg+xml;utf8,%3Csvg display='inline-block' color='inherit' width='1em' height='1em' xmlns='http://www.w3.org/2000/svg' fill='none' viewBox='0 0 24 24'%3E%3Cg clip-path='url(%23a)'%3E%3Cpath fill='url(%23b)' d='M10.673 16.328c2.514 0 4.571-1.966 4.571-4.367s-2.057-4.367-4.57-4.367c-1.65 0-3.099.86-3.894 2.122l4.302 2.2-4.302 2.29a4.618 4.618 0 0 0 3.893 2.122Z'/%3E%3Cpath fill='url(%23c)' d='M1.73 7.114c.082.056.164.123.257.168l1.473.748C4.898 5.64 7.6 4.02 10.673 4.02c4.571 0 8.312 3.574 8.312 7.941s-3.741 7.94-8.312 7.94c-3.051 0-5.716-1.597-7.166-3.953l-1.59.849s-.082.056-.128.09c1.59 2.612 4.395 4.466 7.68 4.835l10.545-5.662a9.286 9.286 0 0 0 .947-4.088c0-1.608-.41-3.127-1.134-4.467L9.48 2.2C6.16 2.57 3.32 4.456 1.74 7.114h-.01Z'/%3E%3Cpath fill='url(%23d)' d='M10.673 19.153c4.115 0 7.529-3.227 7.529-7.192 0-3.965-3.379-7.192-7.529-7.192-2.794 0-5.225 1.452-6.523 3.618l1.929.983c.935-1.508 2.619-2.513 4.594-2.513 2.958 0 5.354 2.278 5.354 5.115s-2.385 5.115-5.354 5.115c-1.964 0-3.647-1.005-4.582-2.502l-1.918 1.017c1.31 2.133 3.73 3.562 6.489 3.562l.011-.01Z'/%3E%3Cpath fill='url(%23e)' d='M21.744 11.96c0 1.24-.234 2.413-.643 3.519.935-.335 1.777-.96 2.256-1.754l.082-.122c1.192-2.01.41-4.088-1.403-4.993l-1.075-.547c.502 1.206.795 2.524.795 3.898h-.012Z'/%3E%3Cpath fill='url(%23f)' d='M1.169 17.333c-1.216 1.105-1.555 2.859-.655 4.255l.41.67c1.028 1.686 3.378 2.245 5.19 1.262l2.268-1.218c-3.063-.625-5.647-2.468-7.213-4.958v-.011Z'/%3E%3Cpath fill='url(%23g)' d='m.877 1.82-.374.67c-.83 1.374-.503 3.06.63 4.155 1.544-2.513 4.151-4.378 7.214-5.014L6.032.447C4.22-.503 1.905.123.877 1.82Z'/%3E%3C/g%3E%3Cdefs%3E%3ClinearGradient id='b' x1='14.882' x2='5.356' y1='9.024' y2='16.318' gradientUnits='userSpaceOnUse'%3E%3Cstop stop-color='%23A1CC95'/%3E%3Cstop offset='1' stop-color='%2326AAE1'/%3E%3C/linearGradient%3E%3ClinearGradient id='c' x1='19.651' x2='-1.719' y1='4.903' y2='21.268' gradientUnits='userSpaceOnUse'%3E%3Cstop stop-color='%23A1CC95'/%3E%3Cstop offset='1' stop-color='%2326AAE1'/%3E%3C/linearGradient%3E%3ClinearGradient id='d' x1='17.617' x2='1.87' y1='7.103' y2='19.158' gradientUnits='userSpaceOnUse'%3E%3Cstop stop-color='%23A1CC95'/%3E%3Cstop offset='1' stop-color='%2326AAE1'/%3E%3C/linearGradient%3E%3ClinearGradient id='e' x1='23.93' x2='18.297' y1='9.839' y2='14.161' gradientUnits='userSpaceOnUse'%3E%3Cstop stop-color='%23A1CC95'/%3E%3Cstop offset='1' stop-color='%2326AAE1'/%3E%3C/linearGradient%3E%3ClinearGradient id='f' x1='6.219' x2='-.059' y1='18.796' y2='23.615' gradientUnits='userSpaceOnUse'%3E%3Cstop stop-color='%23A1CC95'/%3E%3Cstop offset='1' stop-color='%2326AAE1'/%3E%3C/linearGradient%3E%3ClinearGradient id='g' x1='7.517' x2='-1.874' y1='-.491' y2='6.685' gradientUnits='userSpaceOnUse'%3E%3Cstop stop-color='%23A1CC95'/%3E%3Cstop offset='1' stop-color='%2326AAE1'/%3E%3C/linearGradient%3E%3CclipPath id='a'%3E%3Cpath fill='%23fff' d='M0 0h24v24H0z'/%3E%3C/clipPath%3E%3C/defs%3E%3C/svg%3E";
$allowed_protocols = array_merge(wp_allowed_protocols(), ['data']);

// BG hero
$bg = function_exists('get_field') ? get_field('news_bg_url', get_the_ID()) : '';
?>
<section class="page-hero" <?php if ($bg)
  echo 'style="background-image:url(' . esc_url($bg) . ')"'; ?>>
  <span class="page-hero__overlay" aria-hidden="true"></span>
  <h1 class="page-hero__title"><?php the_title(); ?></h1>
</section>

<?php
// Lấy group từ trang hoặc Options
$GROUP = 'news_title_btn';
$pid = get_queried_object_id() ?: get_the_ID();
$g = function_exists('get_field') ? (get_field($GROUP, $pid) ?: get_field($GROUP, 'option')) : [];

// helper: chuẩn hoá giá trị Link field
if (!function_exists('spv_resolve_link')) {
  function spv_resolve_link($raw)
  {
    if (is_array($raw))
      return $raw['url'] ?? '';
    if (is_numeric($raw))
      return get_permalink((int) $raw) ?: '';
    return trim((string) $raw);
  }
}

// ---- Item 1 ----
$title_1 = trim($g['news_post_title_1'] ?? '');
$btn_title_1 = trim($g['news_post_btn_title_1'] ?? '');
if (!$btn_title_1)
  $btn_title_1 = __('XEM TẤT CẢ', 'pepsico-theme');
$btn_link_1 = spv_resolve_link($g['news_post_btn_1'] ?? '');

// ---- Item 2 ----
$title_2 = trim($g['news_post_title_2'] ?? '');
$btn_title_2 = trim($g['news_post_btn_title_2'] ?? '');
if (!$btn_title_2)
  $btn_title_2 = __('XEM TẤT CẢ', 'pepsico-theme');
$btn_link_2 = spv_resolve_link($g['news_post_btn_2'] ?? '');

if ($title_1 || $btn_link_1 || $title_2 || $btn_link_2):
  ?>
  <div class="container mt-5 mb-5">
    <div class="spv-newsheads">

      <?php if ($title_1 || $btn_link_1): ?>
        <section class="spv-newshead" aria-label="<?php echo esc_attr($title_1 ?: __('Mục tin 1', 'pepsico-theme')); ?>">
          <h2 class="spv-newshead__title">
            <span class="spv-newshead__logo" aria-hidden="true">
              <img src="<?php echo esc_url($arrow_icon, $allowed_protocols); ?>" alt="" loading="lazy" decoding="async">
            </span>
            <span class="spv-newshead__text"><?php echo esc_html($title_1); ?></span>
          </h2>

          <?php if ($btn_link_1): ?>
            <a class="custom-btn" href="<?php echo esc_url($btn_link_1); ?>">
              <span class="spv-newshead__btnText"><?php echo esc_html($btn_title_1); ?></span>
              <span class="spv-newshead__btnIcon" aria-hidden="true">
                <img src="<?php echo esc_url($arrow_icon, $allowed_protocols); ?>" alt="" loading="lazy" decoding="async"
                  class="btn-icon">
              </span>
            </a>
          <?php endif; ?>
        </section>
      <?php endif; ?>

      <?php
      // ===== 5 bài mới nhất của CPT (1 lớn + 4 nhỏ) =====
      $cpt_key = 'tin_tuc_ve_cong_ty';
      $q = new WP_query([
        'post_type' => $cpt_key,
        'post_status' => 'publish',
        'posts_per_page' => 5,
        'orderby' => 'date',
        'order' => 'DESC',
        'ignore_sticky_posts' => true,
        'no_found_rows' => true,
      ]);

      if ($q->have_posts()):
        $posts = $q->posts;
        $first = $posts[0] ?? null;
        ?>
        <div class="spv-newsFeatured">
          <?php if ($first): ?>
            <!-- Bài nổi bật bên trái -->
            <article class="spv-newsFeatured__main">
              <a class="nf-main__thumb" href="<?php echo get_permalink($first); ?>" aria-label="<?=
                   esc_attr(sprintf(__('Xem “%s”', 'pepsico-theme'), get_the_title($first)))
                   ?>">
                <?php
                if (has_post_thumbnail($first)) {
                  echo get_the_post_thumbnail($first->ID, 'large', ['loading' => 'lazy', 'decoding' => 'async']);
                } else {
                  echo '<span class="nf-main__placeholder" aria-hidden="true"></span>';
                }
                ?>
              </a>
              <h3 class="nf-main__title">
                <a href="<?php echo get_permalink($first); ?>"><?php echo esc_html(get_the_title($first)); ?></a>
              </h3>
              <div class="nf-main__meta">
                <time datetime="<?php echo esc_attr(get_the_date('c', $first)); ?>">
                  <?php echo esc_html(get_the_date(get_option('date_format'), $first)); ?>
                </time>
              </div>
              <?php
              $raw_content = get_post_field('post_content', $first);
              $ex = wp_trim_words(get_the_excerpt($first) ?: wp_strip_all_tags($raw_content), 28);
              if ($ex): ?>
                <p class="nf-main__excerpt"><?php echo esc_html($ex); ?></p>
              <?php endif; ?>
            </article>
          <?php endif; ?>

          <!-- 4 bài bên phải -->
          <div class="spv-newsFeatured__side">
            <?php
            if (!empty($posts)) {
              for ($i = 1; $i < min(5, count($posts)); $i++):
                $p = $posts[$i];
                ?>
                <article class="nf-side__card">
                  <a class="nf-side__thumb" href="<?php echo get_permalink($p); ?>" aria-label="<?=
                       esc_attr(sprintf(__('Xem “%s”', 'pepsico-theme'), get_the_title($p)))
                       ?>">
                    <?php
                    if (has_post_thumbnail($p)) {
                      echo get_the_post_thumbnail($p->ID, 'medium_large', ['loading' => 'lazy', 'decoding' => 'async']);
                    } else {
                      echo '<span class="nf-side__placeholder" aria-hidden="true"></span>';
                    }
                    ?>
                  </a>
                  <h4 class="nf-side__title">
                    <a href="<?php echo get_permalink($p); ?>"><?php echo esc_html(get_the_title($p)); ?></a>
                  </h4>
                  <div class="nf-side__meta">
                    <span class="news-card__date">
                      <?php echo esc_html(get_the_date(get_option('date_format'), $p)); ?>
                    </span>
                  </div>
                </article>
              <?php endfor;
            } ?>
          </div>
        </div>
        <?php
        wp_reset_postdata();
      else:
        echo '<p class="spv-newslist__empty">' . esc_html__('Chưa có bài viết.', 'pepsico-theme') . '</p>';
      endif;
      ?>

      <?php if ($title_2 || $btn_link_2): ?>
        <section class="spv-newshead" aria-label="<?php echo esc_attr($title_2 ?: __('Mục tin 2', 'pepsico-theme')); ?>">
          <h2 class="spv-newshead__title">
            <span class="spv-newshead__logo" aria-hidden="true">
              <img src="<?php echo esc_url($arrow_icon, $allowed_protocols); ?>" alt="" loading="lazy" decoding="async">
            </span>
            <span class="spv-newshead__text"><?php echo esc_html($title_2); ?></span>
          </h2>

          <?php if ($btn_link_2): ?>
            <a class="custom-btn" href="<?php echo esc_url($btn_link_2); ?>">
              <span class="spv-newshead__btnText"><?php echo esc_html($btn_title_2); ?></span>
              <span class="spv-newshead__btnIcon" aria-hidden="true">
                <img src="<?php echo esc_url($arrow_icon, $allowed_protocols); ?>" alt="" loading="lazy" decoding="async"
                  class="btn-icon">
              </span>
            </a>
          <?php endif; ?>
        </section>
      <?php endif; ?>

      <?php
      // ===== 3 bài mới nhất: CPT thong_cao_bao_chi =====
      $cpt_key2 = 'thong_cao_bao_chi';
      $q2 = new WP_Query([
        'post_type' => $cpt_key2,
        'post_status' => 'publish',
        'posts_per_page' => 3,
        'orderby' => 'date',
        'order' => 'DESC',
        'ignore_sticky_posts' => true,
        'no_found_rows' => true,
      ]);

      if ($q2->have_posts()): ?>
        <div class="news3">
          <?php while ($q2->have_posts()):
            $q2->the_post(); ?>
            <article <?php post_class('news3__item'); ?>>
              <div class="news3__content">
                <h3 class="news3__title">
                  <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
                </h3>
                <div class="news3__desc">
                  <?php echo esc_html(get_the_excerpt()); ?>
                </div>
              </div>
              <div class="news3__meta">
                <span class="news-card__date">
                  <?php echo esc_html(get_the_date(get_option('date_format'))); ?>
                </span>
              </div>
            </article>
          <?php endwhile;
          wp_reset_postdata(); ?>
        </div>
      <?php else: ?>
        <p class="spv-newslist__empty"><?php echo esc_html__('Chưa có bài viết.', 'pepsico-theme'); ?></p>
      <?php endif; ?>

    </div>
  </div>
<?php endif; ?>

<?php get_footer(); ?>