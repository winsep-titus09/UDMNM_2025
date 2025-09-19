<?php
/* single-drink.php */
get_header();
the_post();

/* Term brand */
$terms = wp_get_post_terms(get_the_ID(), 'drink_line');
$term = $terms ? $terms[0] : null;

/* ACF term (field type = URL) */
$small_bg_url = ($term) ? (get_field('global_small_bg_url', 'term_' . $term->term_id) ?: '') : '';

/* DEBUG: in ra HTML comment để xem có URL không */
if (is_user_logged_in()) {
  echo "\n<!-- small_bg_url: " . esc_html($small_bg_url ?: '[EMPTY]') . " for term ID " .
    ($term->term_id ?? 'null') . " -->\n";
}



/* ACF post */
$hero_bg_url = (string) get_field('hero_drink_bg');
$bottle_url = (string) get_field('bottle_url'); // nếu rỗng sẽ fallback featured image
$title_show = (string) (get_field('title_drink_override') ?: get_the_title());
$desc = (string) get_field('desc_drink');

/* Socials 1..5 */
$socials = [];
for ($i = 1; $i <= 5; $i++) {
  $icon = (string) get_field("social_drink_icon_url_$i");
  $link = (string) get_field("social_drink_link_url_$i");
  if ($link)
    $socials[] = ['icon' => $icon, 'link' => $link];
}

/* === Slides 1..12: đọc theo tên drink_slide_* === */
$slides = [];
for ($i = 1; $i <= 12; $i++) {
  $img = (string) get_field("drink_slide_image_url_{$i}");
  $cap = (string) get_field("drink_slide_caption_{$i}");
  if ($img) {
    $slides[] = ['img' => $img, 'cap' => $cap];
  }
}

/* Fallback nếu bạn đặt trong 1 group (ví dụ 'drink_slides' hoặc 'slides') */
if (!$slides) {
  foreach (['drink_slides', 'slides'] as $grp_name) {
    $grp = get_field($grp_name); // array|null
    if (is_array($grp)) {
      for ($i = 1; $i <= 12; $i++) {
        $img = (string) ($grp["drink_slide_image_url_{$i}"] ?? $grp["slide_image_url_{$i}"] ?? '');
        $cap = (string) ($grp["drink_slide_caption_{$i}"] ?? $grp["slide_caption_{$i}"] ?? '');
        if ($img) {
          $slides[] = ['img' => $img, 'cap' => $cap];
        }
      }
      if ($slides)
        break;
    }
  }
}

/* Debug: xem có bao nhiêu slide (chỉ hiện khi đã đăng nhập) */
if (is_user_logged_in()) {
  echo "\n<!-- slides_count: " . count($slides) . " -->\n";
}

/* Debug nhẹ để biết có mấy slide (chỉ hiện khi đang đăng nhập) */
if (is_user_logged_in()) {
  echo "\n<!-- slides_count: " . count($slides) . " -->\n";
}
?>

<?php
$bottle_html = $bottle_url
  ? '<img class="drink-hero__bottle" src="' . esc_url($bottle_url) . '" alt="">'
  : get_the_post_thumbnail(null, 'full', ['class' => 'drink-hero__bottle', 'loading' => 'eager', 'decoding' => 'async']);
?>

<main class="drink-page">
  <section class="drink-hero" aria-label="Giới thiệu sản phẩm">
    <?php if ($hero_bg_url): ?>
      <span class="drink-hero__bgMain" aria-hidden="true"
        style="background-image:url('<?= esc_url($hero_bg_url) ?>');"></span>
    <?php endif; ?>

    <?php if ($small_bg_url): ?>
      <span class="drink-hero__bgSmall" aria-hidden="true"
        style="background-image:url('<?= esc_url($small_bg_url) ?>');"></span>
    <?php endif; ?>

    <div class="drink-hero__left">
      <h1 class="drink-hero__title">
        <?= wp_kses($title_show, ['br' => []]) ?>
      </h1>
      <?php if ($desc): ?>
        <p class="drink-hero__desc"><?= wp_kses_post($desc) ?></p><?php endif; ?>

      <?php if ($socials): ?>
        <nav class="drink-hero__socials icons-only" aria-label="Nền tảng">
          <div class="social-card">
            <?php foreach ($socials as $s):
              $host = parse_url($s['link'], PHP_URL_HOST) ?: '';
              // đoán tên mạng để alt/aria chuẩn hơn
              $brand = 'Social';
              if (stripos($host, 'youtube') !== false)
                $brand = 'YouTube';
              elseif (stripos($host, 'facebook') !== false)
                $brand = 'Facebook';
              elseif (stripos($host, 'instagram') !== false)
                $brand = 'Instagram';
              elseif (stripos($host, 'tiktok') !== false)
                $brand = 'TikTok';
              ?>
              <a class="social-icon" href="<?= esc_url($s['link']) ?>" target="_blank" rel="noopener"
                aria-label="<?= esc_attr($brand) ?>">
                <?php if ($s['icon']): ?>
                  <img src="<?= esc_url($s['icon']) ?>" alt="<?= esc_attr($brand) ?>">
                <?php endif; ?>
              </a>
            <?php endforeach; ?>
          </div>
        </nav>
      <?php endif; ?>
    </div>

    <div class="drink-hero__bottleWrap"><?= $bottle_html ?></div>

    <?php if ($slides): ?>
      <section class="drink-variants" aria-label="Các phiên bản / hương vị">
        <button class="dv-nav prev" type="button" aria-label="Trước">
          &lsaquo;
        </button>

        <ul class="dv-stage" id="dvStage">
          <?php foreach ($slides as $k => $it): ?>
            <li class="dv-item" data-idx="<?= $k ?>">
              <img src="<?= esc_url($it['img']) ?>" alt="<?= esc_attr(wp_strip_all_tags($it['cap'] ?: 'Variant')) ?>">
              <?php if (!empty($it['cap'])): ?>
                <div class="dv-cap">
                  <?= wp_kses($it['cap'], ['br' => []]) /* cho phép <br> nếu bạn gõ trong ACF */ ?>
                </div>
              <?php endif; ?>
            </li>
          <?php endforeach; ?>
        </ul>

        <button class="dv-nav next" type="button" aria-label="Sau">
          &rsaquo;
        </button>
      </section>
    <?php endif; ?>
  </section>
</main>

<?php get_footer(); ?>