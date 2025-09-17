<?php
/**
 * Template Name: Liên hệ
 */
get_header();
?>

<?php
// 1) ẢNH NỀN
$pid = get_queried_object_id();
$bg  = function_exists('get_field') ? get_field('contact_top_bg', $pid) : '';
?>

<?php if ($bg): ?>
<section class="contact-hero" aria-label="<?php echo esc_attr__('Ảnh nền trang liên hệ', 'pepsico-theme'); ?>">
  <div class="contact-hero__bg">
    <img src="<?php echo esc_url($bg); ?>" alt="" loading="lazy" decoding="async">
  </div>
  <div class="contact-hero__overlay" aria-hidden="true"></div>
</section>
<?php endif; ?>

<?php
// 2) THẺ “Văn phòng chính” (group: office_main)
$office = function_exists('get_field') ? get_field('office_main') : null;
if ($office):
  $title = $office['office_title'] ?? '';
  $icon  = $office['office_icon_url'] ?? '';
  $desc  = $office['office_desc'] ?? '';
  $allowed = array_merge( wp_allowed_protocols(), ['data'] );
?>
<div class="container my-5">
  <section class="office-card mt-5" aria-label="<?php echo esc_attr__('Văn phòng chính', 'pepsico-theme'); ?>">
    <div class="office-card__header">
      <?php if ($title): ?>
        <h2 class="office-card__title"><?php echo esc_html($title); ?></h2>
      <?php endif; ?>
    </div>

    <div class="office-card__body">
      <?php if ($icon): ?>
        <span class="office-card__icon">
          <img src="<?php echo esc_url($icon, $allowed); ?>" alt="" loading="lazy" decoding="async">
        </span>
      <?php endif; ?>
      <?php if ($desc): ?>
        <p class="office-card__desc"><?php echo nl2br(esc_html($desc)); ?></p>
      <?php endif; ?>
    </div>
  </section>
</div>
<?php endif; ?>

<?php
/**
 * Helper vẽ 1 “khu vực/vùng” văn phòng (offices_region_X)
 */
function pepsico_render_office_region($group_key) {
  $pid   = get_queried_object_id() ?: get_the_ID();
  $group = get_field($group_key, $pid) ?: get_field($group_key, 'option');

  if (!$group) return;

  $region_icon  = $group['region_icon_url'] ?? '';
  $region_title = $group['region_title'] ?? '';
  $marker       = trim($group['office_marker_icon_url'] ?? '');

  $items = [];
  for ($i = 1; $i <= 8; $i++) {
    $t = trim($group["office_title_{$i}"] ?? '');
    $d = $group["office_desc_{$i}"] ?? '';
    if ($t || $d) $items[] = ['title'=>$t, 'desc'=>$d];
  }

  if (!$region_icon && !$region_title && empty($items)) return;

  $allowed_protocols = array_merge( wp_allowed_protocols(), ['data'] );
  ?>
  <div class="container">
    <section class="spv-region" aria-label="<?php echo esc_attr__('Khu vực văn phòng', 'pepsico-theme'); ?>">
      <div class="spv-region__heading">
        <?php if ($region_icon): ?>
          <img class="spv-region__icon"
               src="<?php echo esc_url($region_icon, $allowed_protocols); ?>"
               alt="" loading="lazy" decoding="async">
        <?php endif; ?>
        <?php if ($region_title): ?>
          <h2 class="spv-region__title"><?php echo nl2br(esc_html($region_title)); ?></h2>
        <?php endif; ?>
      </div>

      <?php if ($items): ?>
        <div class="spv-office-grid">
          <?php foreach ($items as $it): ?>
            <article class="spv-office">
              <?php if (!empty($it['title'])): ?>
                <header class="spv-office__head">
                  <h3 class="spv-office__title"><?php echo esc_html($it['title']); ?></h3>
                </header>
              <?php endif; ?>

              <div class="spv-office__body">
                <?php if ($marker): ?>
                  <span class="spv-office__bullet">
                    <img src="<?php echo esc_url($marker, $allowed_protocols); ?>" alt="" loading="lazy" decoding="async">
                  </span>
                <?php endif; ?>
                <?php if (!empty($it['desc'])): ?>
                  <p class="spv-office__desc"><?php echo nl2br(esc_html($it['desc'])); ?></p>
                <?php endif; ?>
              </div>
            </article>
          <?php endforeach; ?>
        </div>
      <?php endif; ?>
    </section>
  </div>
  <?php
}

// Render 3 vùng (offices_region_1..3)
pepsico_render_office_region('offices_region_1');
pepsico_render_office_region('offices_region_2');
pepsico_render_office_region('offices_region_3');
?>

<?php
// 3) THẺ LIÊN HỆ (contact_cards)
$GROUP = 'contact_cards';
$pid   = get_queried_object_id() ?: get_the_ID();
$g     = function_exists('get_field') ? ( get_field($GROUP, $pid) ?: get_field($GROUP, 'option') ) : [];

$cards = [];
for ($i=1; $i<=4; $i++){
  $icon = trim($g["contact_icon_url_{$i}"] ?? '');
  $tit  = trim($g["contact_title_{$i}"] ?? '');
  $desc = trim($g["contact_desc_{$i}"] ?? '');
  if ($icon || $tit || $desc) $cards[] = ['icon'=>$icon,'title'=>$tit,'desc'=>$desc];
}
$head_icon  = trim($g['contact_arrow_icon'] ?? '');
$head_title = trim($g['contact_text_title'] ?? '');

if (!function_exists('spv_autolink_contact')) {
  function spv_autolink_contact($s){
    $s = trim((string)$s);
    if (function_exists('is_email') && is_email($s)) {
      return '<a href="mailto:'.esc_attr($s).'">'.esc_html($s).'</a>';
    }
    $digits = preg_replace('/\D+/', '', $s);
    if (strlen($digits) >= 8) {
      return '<a href="tel:'.$digits.'">'.esc_html($s).'</a>';
    }
    return esc_html($s);
  }
}
$allowed_protocols = array_merge( wp_allowed_protocols(), ['data'] );
?>

<?php if ($head_icon || $head_title || !empty($cards)): ?>
  <div class="container">
    <section class="spv-contacts" aria-label="<?php echo esc_attr__('Liên hệ', 'pepsico-theme'); ?>">

      <?php if ($head_icon || $head_title): ?>
        <div class="spv-contacts__head">
          <?php if ($head_icon): ?>
            <img class="spv-contacts__head-icon"
                 src="<?php echo esc_url($head_icon, $allowed_protocols); ?>"
                 alt="" loading="lazy" decoding="async">
          <?php endif; ?>

          <?php if ($head_title): ?>
            <h2 class="spv-contacts__head-title">
              <?php echo nl2br(esc_html($head_title)); ?>
            </h2>
          <?php endif; ?>
        </div>
      <?php endif; ?>

      <?php if (!empty($cards)): ?>
        <div class="spv-contacts__grid">
          <?php foreach ($cards as $c): ?>
            <article class="spv-ct">
              <?php if (!empty($c['icon'])): ?>
                <div class="spv-ct__icon">
                  <img src="<?php echo esc_url($c['icon'], $allowed_protocols); ?>" alt="" loading="lazy" decoding="async">
                </div>
              <?php endif; ?>

              <?php if (!empty($c['title'])): ?>
                <h3 class="spv-ct__title"><?php echo esc_html($c['title']); ?></h3>
              <?php endif; ?>

              <?php if (!empty($c['desc'])): ?>
                <p class="spv-ct__desc"><?php echo spv_autolink_contact($c['desc']); ?></p>
              <?php endif; ?>
            </article>
          <?php endforeach; ?>
        </div>
      <?php endif; ?>

    </section>
  </div>
<?php endif; ?>

<?php get_footer(); ?>
