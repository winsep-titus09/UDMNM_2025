<?php
/**
 * Template Name: Về Chúng Tôi
 * Description: Trang Về Chúng Tôi hiển thị nội dung "Giới thiệu về công ty"
 */

get_header();

$pid = get_queried_object_id();

// Cho phép 'data:' protocol cho các icon SVG nhúng
$allowed_protocols = array_merge(wp_allowed_protocols(), ['data']);

// Icon mũi tên dạng data URI (giữ nguyên chuỗi của bạn)
$arrow_icon = "data:image/svg+xml;utf8,%3Csvg display='inline-block' color='inherit' width='1em' height='1em' xmlns='http://www.w3.org/2000/svg' fill='none' viewBox='0 0 24 24'%3E%3Cg clip-path='url(%23a)'%3E%3Cpath fill='url(%23b)' d='M10.673 16.328c2.514 0 4.571-1.966 4.571-4.367s-2.057-4.367-4.57-4.367c-1.65 0-3.099.86-3.894 2.122l4.302 2.2-4.302 2.29a4.618 4.618 0 0 0 3.893 2.122Z'/%3E%3Cpath fill='url(%23c)' d='M1.73 7.114c.082.056.164.123.257.168l1.473.748C4.898 5.64 7.6 4.02 10.673 4.02c4.571 0 8.312 3.574 8.312 7.941s-3.741 7.94-8.312 7.94c-3.051 0-5.716-1.597-7.166-3.953l-1.59.849s-.082.056-.128.09c1.59 2.612 4.395 4.466 7.68 4.835l10.545-5.662a9.286 9.286 0 0 0 .947-4.088c0-1.608-.41-3.127-1.134-4.467L9.48 2.2C6.16 2.57 3.32 4.456 1.74 7.114h-.01Z'/%3E%3Cpath fill='url(%23d)' d='M10.673 19.153c4.115 0 7.529-3.227 7.529-7.192 0-3.965-3.379-7.192-7.529-7.192-2.794 0-5.225 1.452-6.523 3.618l1.929.983c.935-1.508 2.619-2.513 4.594-2.513 2.958 0 5.354 2.278 5.354 5.115s-2.385 5.115-5.354 5.115c-1.964 0-3.647-1.005-4.582-2.502l-1.918 1.017c1.31 2.133 3.73 3.562 6.489 3.562l.011-.01Z'/%3E%3Cpath fill='url(%23e)' d='M21.744 11.96c0 1.24-.234 2.413-.643 3.519.935-.335 1.777-.96 2.256-1.754l.082-.122c1.192-2.01.41-4.088-1.403-4.993l-1.075-.547c.502 1.206.795 2.524.795 3.898h-.012Z'/%3E%3Cpath fill='url(%23f)' d='M1.169 17.333c-1.216 1.105-1.555 2.859-.655 4.255l.41.67c1.028 1.686 3.378 2.245 5.19 1.262l2.268-1.218c-3.063-.625-5.647-2.468-7.213-4.958v-.011Z'/%3E%3Cpath fill='url(%23g)' d='m.877 1.82-.374.67c-.83 1.374-.503 3.06.63 4.155 1.544-2.513 4.151-4.378 7.214-5.014L6.032.447C4.22-.503 1.905.123.877 1.82Z'/%3E%3C/g%3E%3Cdefs%3E%3ClinearGradient id='b' x1='14.882' x2='5.356' y1='9.024' y2='16.318' gradientUnits='userSpaceOnUse'%3E%3Cstop stop-color='%23A1CC95'/%3E%3Cstop offset='1' stop-color='%2326AAE1'/%3E%3C/linearGradient%3E%3ClinearGradient id='c' x1='19.651' x2='-1.719' y1='4.903' y2='21.268' gradientUnits='userSpaceOnUse'%3E%3Cstop stop-color='%23A1CC95'/%3E%3Cstop offset='1' stop-color='%2326AAE1'/%3E%3C/linearGradient%3E%3ClinearGradient id='d' x1='17.617' x2='1.87' y1='7.103' y2='19.158' gradientUnits='userSpaceOnUse'%3E%3Cstop stop-color='%23A1CC95'/%3E%3Cstop offset='1' stop-color='%2326AAE1'/%3E%3C/linearGradient%3E%3ClinearGradient id='e' x1='23.93' x2='18.297' y1='9.839' y2='14.161' gradientUnits='userSpaceOnUse'%3E%3Cstop stop-color='%23A1CC95'/%3E%3Cstop offset='1' stop-color='%2326AAE1'/%3E%3C/linearGradient%3E%3ClinearGradient id='f' x1='6.219' x2='-.059' y1='18.796' y2='23.615' gradientUnits='userSpaceOnUse'%3E%3Cstop stop-color='%23A1CC95'/%3E%3Cstop offset='1' stop-color='%2326AAE1'/%3E%3C/linearGradient%3E%3ClinearGradient id='g' x1='7.517' x2='-1.874' y1='-.491' y2='6.685' gradientUnits='userSpaceOnUse'%3E%3Cstop stop-color='%23A1CC95'/%3E%3Cstop offset='1' stop-color='%2326AAE1'/%3E%3C/linearGradient%3E%3CclipPath id='a'%3E%3Cpath fill='%23fff' d='M0 0h24v24H0z'/%3E%3C/clipPath%3E%3C/defs%3E%3C/svg%3E";

// Banner ACF
if ($bg_image = get_field('about_us_banner_bg')): ?>
  <section class="about-us-hero" style="background-image:url('<?php echo esc_url($bg_image['url']); ?>')">
    <div class="overlay" aria-hidden="true"></div>
    <div class="hero-content">
      <h1 class="hero-title"><?php the_title(); ?></h1>
    </div>
  </section>
<?php endif; ?>

<main id="primary" class="site-main">
  <div class="about-us-wrapper">

    <?php if ($about = get_field('about_feature_section')): ?>
      <!-- Cột trái -->
      <div class="about-us-content">
        <div class="about-us-icon">
          <!-- Icon SVG -->
          <img
            src="<?php echo esc_url("data:image/svg+xml,%3csvg%20width='31'%20height='25'%20viewBox='0%200%2031%2025'%20fill='none'%20xmlns='http://www.w3.org/2000/svg'%3e%3cpath%20d='M2.07813%2024.1328C0.973557%2024.1328%200.078125%2023.2374%200.078125%2022.1328V16.1034C0.078125%2013.1034%200.609098%2010.3387%201.67105%207.80928C2.55342%205.7076%203.94493%203.58561%205.84557%201.44331C6.52268%200.680122%207.67663%200.610277%208.47871%201.24082L9.92388%202.37694C10.8576%203.11097%2010.9416%204.48655%2010.1762%205.39476C9.06347%206.71519%208.23431%207.96121%207.68874%209.13282C7.16824%2010.2506%206.82436%2011.4226%206.6571%2012.6487C6.56548%2013.3204%205.72978%2013.6728%205.23409%2013.2105C4.71939%2012.7304%205.0591%2011.8681%205.76295%2011.8681H10.4675C11.5721%2011.8681%2012.4675%2012.7635%2012.4675%2013.8681V22.1328C12.4675%2023.2374%2011.5721%2024.1328%2010.4675%2024.1328H2.07813ZM19.6887%2024.1328C18.5842%2024.1328%2017.6887%2023.2374%2017.6887%2022.1328V16.1034C17.6887%2013.1034%2018.2197%2010.3387%2019.2817%207.80928C20.164%205.7076%2021.5555%203.58561%2023.4562%201.44331C24.1333%200.680122%2025.2872%200.610277%2026.0893%201.24083L27.5345%202.37694C28.4682%203.11097%2028.5522%204.48654%2027.7868%205.39475C26.6741%206.71519%2025.8449%207.96121%2025.2994%209.13282C24.7789%2010.2506%2024.435%2011.4226%2024.2677%2012.6487C24.1761%2013.3204%2023.3404%2013.6728%2022.8447%2013.2105C22.33%2012.7304%2022.6697%2011.8681%2023.3736%2011.8681H28.0781C29.1827%2011.8681%2030.0781%2012.7635%2030.0781%2013.8681V22.1328C30.0781%2023.2374%2029.1827%2024.1328%2028.0781%2024.1328H19.6887Z'%20fill='url(%23paint0_linear_720_14439)'/%3e%3cdefs%3e%3clinearGradient%20id='paint0_linear_720_14439'%20x1='0.078125'%20y1='0.132812'%20x2='27.7249'%20y2='26.5917'%20gradientUnits='userSpaceOnUse'%3e%3cstop%20stop-color='%23A1CC95'/%3e%3cstop%20offset='1'%20stop-color='%2326AAE1'/%3e%3c/linearGradient%3e%3c/defs%3e%3c/svg%3e", $allowed_protocols); ?>"
            alt="<?php echo esc_attr__('Biểu tượng giới thiệu', 'pepsico-theme'); ?>" />
        </div>
        <div class="about-us-text"><?php echo wp_kses_post($about['about_short_text']); ?></div>
      </div>

      <!-- Cột phải -->
      <div class="about-us-buttons">
        <a href="https://link-to-suntory.com" class="btn-about-us suntory-btn" target="_blank" rel="noopener"
          aria-label="<?php echo esc_attr__('Xem Suntory', 'pepsico-theme'); ?>">
          <img src="https://api.suntorypepsico.vn/assets/166272db-1730-40ae-9ac9-7dda13faf7db?width=360" alt="Suntory"
            loading="lazy" decoding="async" />
        </a>
        <a href="https://link-to-pepsico.com" class="btn-about-us pepsico-btn" target="_blank" rel="noopener"
          aria-label="<?php echo esc_attr__('Xem PepsiCo', 'pepsico-theme'); ?>">
          <img src="https://api.suntorypepsico.vn/assets/492c0d27-79ea-491b-bae8-254849b581fc?width=360" alt="PepsiCo"
            loading="lazy" decoding="async" />
        </a>
        <?php if (!empty($about['button_3_text'])): ?>
          <a href="#" class="btn-about-us book-btn" aria-label="<?php echo esc_attr__('Xem thêm', 'pepsico-theme'); ?>">
            <span><?php echo esc_html($about['button_3_text']); ?></span>
            <img src="<?php echo esc_url($arrow_icon, $allowed_protocols); ?>" alt="" class="small-icon" loading="lazy"
              decoding="async" />
          </a>
        <?php endif; ?>
      </div>
    <?php endif; ?>
  </div>
  <?php    // -------- Timeline --------
  if ($tl_group = get_field('timeline')):
    $timelines = [];
    for ($i = 1; $i <= 10; $i++) {
      $year = $tl_group["timeline_year_$i"] ?? '';
      if ($year) {
        $timelines[] = [
          'year' => $year,
          'desc' => $tl_group["timeline_desc_$i"] ?? '',
          'img' => $tl_group["timeline_img_$i"] ?? '',
        ];
      }
    }
    if ($timelines): ?>
      <?php
      $pid = get_queried_object_id() ?: get_the_ID();
      $group = (array) get_field('timeline', $pid);
      $history_title = trim((string) ($group['history_title'] ?? ''));
      ?>
      <div class="drink-section-title">
        <img class="title-icon" src="<?php echo esc_url($arrow_icon, $allowed_protocols); ?>" alt="" aria-hidden="true">
        <h2><?php echo esc_html($history_title ?: __('LỊCH SỬ HÌNH THÀNH', 'pepsico-theme')); ?></h2>
      </div>

      <div class="container">
        <div class="timeline-container px-5">
          <div class="timeline-left" aria-label="<?php echo esc_attr__('Mốc thời gian', 'pepsico-theme'); ?>">
            <ul class="timeline-years">
              <?php foreach ($timelines as $i => $t): ?>
                <li class="timeline-year <?php echo $i === 0 ? 'active' : ''; ?>" data-index="<?php echo (int) $i; ?>">
                  <span class="dot" aria-hidden="true"></span><?php echo esc_html($t['year']); ?>
                </li>
              <?php endforeach; ?>
            </ul>
            <div class="line" aria-hidden="true"></div>
          </div>

          <div class="timeline-content">
            <?php foreach ($timelines as $i => $t): ?>
              <div class="timeline-detail <?php echo $i === 0 ? 'active' : ''; ?>" data-index="<?php echo (int) $i; ?>">
                <div class="timeline-desc"><?php echo wp_kses_post($t['desc']); ?></div>
                <?php if ($t['img']): ?>
                  <div class="timeline-img">
                    <img src="<?php echo esc_url($t['img']); ?>" alt="">
                  </div>
                <?php endif; ?>
              </div>
            <?php endforeach; ?>
          </div>
        </div>
      </div>
    <?php endif;
  endif; ?>

  <?php
  // -------- Two Column Highlight title --------
  $pid = get_queried_object_id() ?: get_the_ID();
  $group = (array) get_field('two_column_highlight', $pid);
  $quality_title = trim((string) ($group['quality_title'] ?? ''));
  ?>
  <div class="drink-section-title">
    <img class="title-icon" src="<?php echo esc_url($arrow_icon, $allowed_protocols); ?>" alt="" aria-hidden="true">
    <h2><?php echo esc_html($quality_title ?: __('SỨ MỆNH & GIÁ TRỊ CỐT LÕI', 'pepsico-theme')); ?></h2>
  </div>

  <?php
  // -------- Two Column Highlight --------
  if ($tcb = get_field('two_column_highlight')):
    if (!function_exists('tcb_render')) {
      function tcb_render($tcb, $i)
      {
        $img = $tcb["tcb_image_$i"] ?? '';
        $title = $tcb["tcb_title_$i"] ?? '';
        $desc = $tcb["tcb_excerpt_$i"] ?? '';
        if (!$img && !$title && !$desc)
          return;
        ?>
        <section class="tcb-wrap" id="tcb-<?php echo (int) $i; ?>">
          <div class="tcb-grid">
            <div class="tcb-text">
              <?php if ($title): ?>
                <h2 class="tcb-title"><?php echo esc_html($title); ?></h2><?php endif; ?>
              <?php if ($desc): ?>
                <div class="tcb-desc"><?php echo apply_filters('the_content', $desc); ?></div><?php endif; ?>
            </div>
            <?php if ($img): ?>
              <div class="tcb-image">
                <img src="<?php echo esc_url($img); ?>" alt="<?php echo esc_attr($title); ?>">
              </div>
            <?php endif; ?>
          </div>
        </section>
        <?php
      }
    }
    tcb_render($tcb, 1);
    tcb_render($tcb, 2);
  endif;

  // -------- Achievements --------
  if ($achv = get_field('achievements_tabs')):
    $tab1_label = $achv['tab1_label'] ?? __('Tab 1', 'pepsico-theme');
    $tab2_label = $achv['tab2_label'] ?? __('Tab 2', 'pepsico-theme');

    $t1_items = $t2_items = [];
    foreach (range(1, 6) as $i) {
      if ($achv["t1_item{$i}_img_url"] || $achv["t1_item{$i}_title"] || $achv["t1_item{$i}_note"]) {
        $t1_items[] = [
          'img' => $achv["t1_item{$i}_img_url"] ?? '',
          'title' => $achv["t1_item{$i}_title"] ?? '',
          'note' => $achv["t1_item{$i}_note"] ?? '',
        ];
      }
    }
    foreach (range(1, 4) as $i) {
      if ($achv["t2_item{$i}_img_url"] || $achv["t2_item{$i}_title"] || $achv["t2_item{$i}_note"]) {
        $t2_items[] = [
          'img' => $achv["t2_item{$i}_img_url"] ?? '',
          'title' => $achv["t2_item{$i}_title"] ?? '',
          'note' => $achv["t2_item{$i}_note"] ?? '',
        ];
      }
    }

    $archivement_title = trim((string) ($achv['achievements_title'] ?? ''));
    ?>
    <div class="drink-section-title">
      <img class="title-icon" src="<?php echo esc_url($arrow_icon, $allowed_protocols); ?>" alt="" aria-hidden="true">
      <h2><?php echo esc_html($archivement_title ?: __('THÀNH TỰU', 'pepsico-theme')); ?></h2>
    </div>

    <div class="container">
      <div id="achievementsTabs" class="achv-section" data-items-per-view="4"
        aria-label="<?php echo esc_attr__('Thành tựu', 'pepsico-theme'); ?>">
        <div class="achv-tabs" role="tablist"
          aria-label="<?php echo esc_attr__('Chuyển tab thành tựu', 'pepsico-theme'); ?>">
          <button class="achv-tab is-active" data-tab="t1" role="tab" aria-selected="true"
            aria-controls="pane-t1"><?php echo esc_html($tab1_label); ?></button>
          <button class="achv-tab" data-tab="t2" role="tab" aria-selected="false"
            aria-controls="pane-t2"><?php echo esc_html($tab2_label); ?></button>
        </div>

        <div class="achv-hero">
          <div id="pane-t1" class="achv-hero-pane" data-pane="t1"
            style="background-image:url('<?php echo esc_url($achv['t1_hero_bg_url'] ?? ''); ?>')">
            <?php if ($achv['t1_hero_title']): ?>
              <div class="achv-hero-text"><?php echo esc_html($achv['t1_hero_title']); ?></div><?php endif; ?>
            <div class="achv-hero-overlay" aria-hidden="true"></div>
          </div>
          <div id="pane-t2" class="achv-hero-pane is-hidden" data-pane="t2"
            style="background-image:url('<?php echo esc_url($achv['t2_hero_bg_url'] ?? ''); ?>')">
            <?php if ($achv['t2_hero_title']): ?>
              <div class="achv-hero-text"><?php echo esc_html($achv['t2_hero_title']); ?></div><?php endif; ?>
            <div class="achv-hero-overlay" aria-hidden="true"></div>
          </div>
        </div>

        <div class="achv-strip">
          <div class="achv-track achv-loop" data-pane="t1">
            <?php foreach ($t1_items as $it): ?>
              <div class="achv-card">
                <?php if ($it['img']): ?>
                  <div class="achv-card-logo"><img src="<?php echo esc_url($it['img']); ?>" alt=""></div><?php endif; ?>
                <?php if ($it['title']): ?>
                  <div class="achv-card-title"><?php echo esc_html($it['title']); ?></div><?php endif; ?>
                <?php if ($it['note']): ?>
                  <div class="achv-card-note">
                    <?php echo nl2br(esc_html(wp_strip_all_tags($it['note']))); ?>
                  </div>
                <?php endif; ?>
              </div>
            <?php endforeach; ?>
          </div>

          <div class="achv-track is-hidden" data-pane="t2">
            <?php foreach ($t2_items as $it): ?>
              <div class="achv-card">
                <?php if ($it['img']): ?>
                  <div class="achv-card-logo"><img src="<?php echo esc_url($it['img']); ?>" alt=""></div><?php endif; ?>
                <?php if ($it['title']): ?>
                  <div class="achv-card-title"><?php echo esc_html($it['title']); ?></div><?php endif; ?>
                <?php if ($it['note']): ?>
                  <div class="achv-card-note">
                    <?php echo nl2br(esc_html(wp_strip_all_tags($it['note']))); ?>
                  </div>
                <?php endif; ?>
              </div>
            <?php endforeach; ?>
          </div>
        </div>

      </div>
    </div>
  <?php endif; // achievements ?>
</main>

<?php get_footer(); ?>