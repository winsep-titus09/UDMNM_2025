<?php
/**
 * Template Name: Home
 */
get_header();

// Cho phép nhúng icon data: SVG
$allowed_protocols = array_merge(wp_allowed_protocols(), ['data']);

// Icon SVG tái sử dụng (data URI)
$arrow_icon = "data:image/svg+xml;utf8,%3Csvg display='inline-block' color='inherit' width='1em' height='1em' xmlns='http://www.w3.org/2000/svg' fill='none' viewBox='0 0 24 24'%3E%3Cg clip-path='url(%23a)'%3E%3Cpath fill='url(%23b)' d='M10.673 16.328c2.514 0 4.571-1.966 4.571-4.367s-2.057-4.367-4.57-4.367c-1.65 0-3.099.86-3.894 2.122l4.302 2.2-4.302 2.29a4.618 4.618 0 0 0 3.893 2.122Z'/%3E%3Cpath fill='url(%23c)' d='M1.73 7.114c.082.056.164.123.257.168l1.473.748C4.898 5.64 7.6 4.02 10.673 4.02c4.571 0 8.312 3.574 8.312 7.941s-3.741 7.94-8.312 7.94c-3.051 0-5.716-1.597-7.166-3.953l-1.59.849s-.082.056-.128.09c1.59 2.612 4.395 4.466 7.68 4.835l10.545-5.662a9.286 9.286 0 0 0 .947-4.088c0-1.608-.41-3.127-1.134-4.467L9.48 2.2C6.16 2.57 3.32 4.456 1.74 7.114h-.01Z'/%3E%3Cpath fill='url(%23d)' d='M10.673 19.153c4.115 0 7.529-3.227 7.529-7.192 0-3.965-3.379-7.192-7.529-7.192-2.794 0-5.225 1.452-6.523 3.618l1.929.983c.935-1.508 2.619-2.513 4.594-2.513 2.958 0 5.354 2.278 5.354 5.115s-2.385 5.115-5.354 5.115c-1.964 0-3.647-1.005-4.582-2.502l-1.918 1.017c1.31 2.133 3.73 3.562 6.489 3.562l.011-.01Z'/%3E%3Cpath fill='url(%23e)' d='M21.744 11.96c0 1.24-.234 2.413-.643 3.519.935-.335 1.777-.96 2.256-1.754l.082-.122c1.192-2.01.41-4.088-1.403-4.993l-1.075-.547c.502 1.206.795 2.524.795 3.898h-.012Z'/%3E%3Cpath fill='url(%23f)' d='M1.169 17.333c-1.216 1.105-1.555 2.859-.655 4.255l.41.67c1.028 1.686 3.378 2.245 5.19 1.262l2.268-1.218c-3.063-.625-5.647-2.468-7.213-4.958v-.011Z'/%3E%3Cpath fill='url(%23g)' d='m.877 1.82-.374.67c-.83 1.374-.503 3.06.63 4.155 1.544-2.513 4.151-4.378 7.214-5.014L6.032.447C4.22-.503 1.905.123.877 1.82Z'/%3E%3C/g%3E%3Cdefs%3E%3ClinearGradient id='b' x1='14.882' x2='5.356' y1='9.024' y2='16.318' gradientUnits='userSpaceOnUse'%3E%3Cstop stop-color='%23A1CC95'/%3E%3Cstop offset='1' stop-color='%2326AAE1'/%3E%3C/linearGradient%3E%3ClinearGradient id='c' x1='19.651' x2='-1.719' y1='4.903' y2='21.268' gradientUnits='userSpaceOnUse'%3E%3Cstop stop-color='%23A1CC95'/%3E%3Cstop offset='1' stop-color='%2326AAE1'/%3E%3C/linearGradient%3E%3ClinearGradient id='d' x1='17.617' x2='1.87' y1='7.103' y2='19.158' gradientUnits='userSpaceOnUse'%3E%3Cstop stop-color='%23A1CC95'/%3E%3Cstop offset='1' stop-color='%2326AAE1'/%3E%3C/linearGradient%3E%3ClinearGradient id='e' x1='23.93' x2='18.297' y1='9.839' y2='14.161' gradientUnits='userSpaceOnUse'%3E%3Cstop stop-color='%23A1CC95'/%3E%3Cstop offset='1' stop-color='%2326AAE1'/%3E%3C/linearGradient%3E%3ClinearGradient id='f' x1='6.219' x2='-.059' y1='18.796' y2='23.615' gradientUnits='userSpaceOnUse'%3E%3Cstop stop-color='%23A1CC95'/%3E%3Cstop offset='1' stop-color='%2326AAE1'/%3E%3C/linearGradient%3E%3ClinearGradient id='g' x1='7.517' x2='-1.874' y1='-.491' y2='6.685' gradientUnits='userSpaceOnUse'%3E%3Cstop stop-color='%23A1CC95'/%3E%3Cstop offset='1' stop-color='%2326AAE1'/%3E%3C/linearGradient%3E%3CclipPath id='a'%3E%3Cpath fill='%23fff' d='M0 0h24v24H0z'/%3E%3C/clipPath%3E%3C/defs%3E%3C/svg%3E";
?>

<!-- banner đầu trang -->
<?php if ($banner = get_field('banner_slide')): ?>
  <div class="banner-slider" role="region" aria-label="<?php echo esc_attr__('Trình chiếu banner', 'pepsico-theme'); ?>">
    <div class="slides-wrapper">
      <?php foreach (['image1', 'image2'] as $i => $key):
        if (empty($banner[$key]['url']))
          continue;
        $loading = $i === 0 ? 'eager' : 'lazy';
        $fetch = $i === 0 ? ' fetchpriority="high"' : '';
        ?>
        <div class="slide <?php echo $i === 0 ? 'active' : ''; ?>">
          <img src="<?php echo esc_url($banner[$key]['url']); ?>" alt="" decoding="async" sizes="100vw"
            loading="<?php echo $loading; ?>" <?php echo $fetch; ?>>
        </div>
      <?php endforeach; ?>
    </div>
  </div>
<?php endif; ?>

<!-- phần content 1 -->
<?php if ($content1 = get_field('content1')): ?>
  <div class="content1-group">
    <?php if (!empty($content1['title'])): ?>
      <h2><?php echo esc_html($content1['title']); ?></h2>
    <?php endif; ?>

    <?php if (!empty($content1['title_content1'])): ?>
      <div class="content1-desc"><?php echo wp_kses_post($content1['title_content1']); ?></div>
    <?php endif; ?>

    <?php if (!empty($content1['button_info'])):
      $button = (array) $content1['button_info']; ?>
      <a class="custom-btn" href="<?php echo esc_url($button['button_link'] ?? ''); ?>">
        <span><?php echo esc_html($button['button_text'] ?? ''); ?></span>
        <img src="<?php echo esc_url($arrow_icon, $allowed_protocols); ?>" alt="" class="btn-icon" loading="lazy"
          decoding="async">
      </a>
    <?php endif; ?>
  </div>
<?php endif; ?>

<!-- phần lưới 7 ô -->
<?php if ($stats = get_field('stats_grid')): ?>
  <div class="stats7-grid">
    <?php for ($i = 1; $i <= 7; $i++): ?>
      <?php if ($i === 3 || $i === 6): // ô chỉ có ảnh ?>
        <?php if (!empty($stats["box{$i}_image"])): ?>
          <div class="stats7-item stats7-item--image box<?php echo (int) $i; ?>">
            <img class="stats7-photo" src="<?php echo esc_url($stats["box{$i}_image"]['url']); ?>" alt="" loading="lazy"
              decoding="async" sizes="(min-width:1200px) 25vw, (min-width:768px) 33vw, 50vw">
          </div>
        <?php endif; ?>
      <?php elseif ($i === 4 || $i === 7): // số + tiêu đề + mô tả ?>
        <div
          class="stats7-item <?php echo $i === 7 ? 'stats7-item--large' : 'stats7-item--number'; ?> box<?php echo (int) $i; ?>">
          <div class="stats7-number"><?php echo esc_html($stats["box{$i}_number"] ?? ''); ?></div>
          <div class="stats7-title"><?php echo esc_html($stats["box{$i}_title"] ?? ''); ?></div>
          <div class="stats7-desc"><?php echo esc_html($stats["box{$i}_desc"] ?? ''); ?></div>
        </div>
      <?php else: // có icon + nội dung ?>
        <div
          class="stats7-item <?php echo $i === 5 ? 'stats7-item--iconnumber' : 'stats7-item--icon'; ?> box<?php echo (int) $i; ?>">
          <?php if (!empty($stats["box{$i}_icon"])): ?>
            <img class="stats7-icon" src="<?php echo esc_url($stats["box{$i}_icon"]['url']); ?>" alt="" loading="lazy"
              decoding="async" sizes="48px">
          <?php endif; ?>
          <div class="content">
            <div class="stats7-number"><?php echo esc_html($stats["box{$i}_number"] ?? ''); ?></div>
            <div class="stats7-title"><?php echo esc_html($stats["box{$i}_title"] ?? ''); ?></div>
            <div class="stats7-desc"><?php echo esc_html($stats["box{$i}_desc"] ?? ''); ?></div>
          </div>
        </div>
      <?php endif; ?>
    <?php endfor; ?>
  </div>
<?php endif; ?>

<!-- phần content 2 -->
<?php if ($content2 = get_field('content2')): ?>
  <?php if (!empty($content2['content2_img'])): ?>
    <div class="acf-img-fog" aria-hidden="true">
      <img src="<?php echo esc_url($content2['content2_img']['url']); ?>" alt="" class="acf-img-main" loading="lazy"
        decoding="async" sizes="100vw">
      <div class="acf-fog-gradient"></div>
    </div>
  <?php endif; ?>

  <div class="content2-group">
    <?php if (!empty($content2['title2'])): ?>
      <h2><?php echo esc_html($content2['title2']); ?></h2><?php endif; ?>
    <?php if (!empty($content2['title_content2'])): ?>
      <div class="content2-desc"><?php echo wp_kses_post($content2['title_content2']); ?></div>
    <?php endif; ?>

    <?php if (!empty($content2['button_info2'])): ?>
      <a class="custom-btn" href="<?php echo esc_url($content2['button_info2']['button_link2'] ?? ''); ?>">
        <span><?php echo esc_html($content2['button_info2']['button_text2'] ?? ''); ?></span>
        <img src="<?php echo esc_url($arrow_icon, $allowed_protocols); ?>" alt="" class="btn-icon" loading="lazy"
          decoding="async">
      </a>
    <?php endif; ?>
  </div>
<?php endif; ?>

<!-- phần bài viết và sản phẩm -->
<?php if (is_front_page() || is_home()): ?>
  <?php
  $posts_query = new WP_Query([
    'post_type' => 'post',
    'posts_per_page' => 3,
    'orderby' => 'date',
    'order' => 'DESC', // thường lấy mới nhất
    'no_found_rows' => true,
    'ignore_sticky_posts' => true,
  ]);

  if ($posts_query->have_posts()): ?>
    <div class="post-tabs-row">
      <?php while ($posts_query->have_posts()):
        $posts_query->the_post();
        $meta = (array) get_field('post_box_meta'); ?>
        <div class="post-tab-card">
          <div class="post-tab-thumb">
            <?php
            if (has_post_thumbnail()) {
              static $first_post_thumb = false;
              $attrs = [
                'class' => 'post-tab-img',
                'decoding' => 'async',
                'sizes' => '(min-width:992px) 33vw, (min-width:768px) 50vw, 100vw',
              ];
              if (!$first_post_thumb) {
                $attrs['loading'] = 'eager';
                $attrs['fetchpriority'] = 'high';
                $first_post_thumb = true;
              } else {
                $attrs['loading'] = 'lazy';
              }
              echo get_the_post_thumbnail(get_the_ID(), 'large', $attrs);
            } else {
              echo '<span class="thumb-placeholder" aria-hidden="true"></span>';
            }
            ?>
          </div>
          <div class="post-tab-content">
            <h3 class="post-tab-title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
            <ul class="post-tab-supplement">
              <?php foreach ([1, 2, 3] as $j):
                if (!empty($meta["sub_item_$j"])): ?>
                  <li><?php echo esc_html($meta["sub_item_$j"]); ?></li>
                <?php endif; endforeach; ?>
            </ul>
            <?php $more = trim((string) ($meta['more_title'] ?? '')); ?>
            <a class="post-tab-more" href="<?php the_permalink(); ?>">
              <?php echo esc_html($more ?: __('XEM THÊM', 'pepsico-theme')); ?>
            </a>
          </div>
        </div>
      <?php endwhile;
      wp_reset_postdata(); ?>
    </div>
  <?php endif; ?>

  <?php
  // Lấy ID trang Home (đúng với field group "home")
  $pid = is_front_page() ? (int) get_option('page_on_front') : get_queried_object_id();

  // Lấy field text 'our_product'
  $our_product = trim((string) get_field('our_product', $pid));
  ?>
  <div class="drink-section-title">
    <img class="title-icon" src="<?php echo esc_url($arrow_icon, $allowed_protocols); ?>" alt="" aria-hidden="true">
    <h2><?php echo esc_html($our_product ?: __('SẢN PHẨM CỦA CHÚNG TÔI', 'pepsico-theme')); ?></h2>
  </div>

  <?php
  $query = new WP_Query([
    'post_type' => 'pepsico',
    'posts_per_page' => -1,
    'orderby' => 'date',
    'order' => 'ASC',
    'no_found_rows' => true,
  ]);
  if ($query->have_posts()): ?>
    <div class="drink-list" id="drinkCarousel" role="region"
      aria-label="<?php echo esc_attr__('Sản phẩm', 'pepsico-theme'); ?>">
      <?php while ($query->have_posts()):
        $query->the_post(); ?>
        <div class="drink-item">
          <a href="<?php the_permalink(); ?>" aria-label="<?=
              esc_attr(sprintf(__('Xem “%s”', 'pepsico-theme'), get_the_title()))
              ?>">
            <?php
            if (has_post_thumbnail()) {
              the_post_thumbnail('medium', ['loading' => 'lazy', 'decoding' => 'async']);
            } else {
              echo '<span class="drink-ph" aria-hidden="true"></span>';
            }
            ?>
          </a>
        </div>
      <?php endwhile;
      wp_reset_postdata(); ?>
    </div>
  <?php endif; ?>
<?php endif; ?>

<?php get_footer(); ?>