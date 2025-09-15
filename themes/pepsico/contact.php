<?php
/**
 * Template Name: Liên hệ
 */
get_header();?>

<?php
// Ở đầu template trang Liên hệ (ví dụ: page-contact.php)
$pid = get_queried_object_id();
$bg  = get_field('contact_top_bg', $pid); // field dạng URL
?>

<?php if ($bg): ?>
<section class="contact-hero" aria-label="Contact hero">
  <div class="contact-hero__bg">
    <img src="<?php echo esc_url($bg); ?>" alt="" loading="lazy" decoding="async">
  </div>
  <div class="contact-hero__overlay"></div>

</section>
<?php endif; ?>

<?php
$office = get_field('office_main'); // group
if ($office):
  $title = $office['office_title'] ?? '';
  $icon  = $office['office_icon_url'] ?? '';
  $desc  = $office['office_desc'] ?? '';
?>
<div class="container my-5">
    <section class="office-card mt-5" aria-label="Main office">
        <div class="office-card__header">
            <?php if ($title): ?>
            <h2 class="office-card__title"><?php echo esc_html($title); ?></h2>
            <?php endif; ?>
        </div>

        <div class="office-card__body">
            <?php if ($icon): 
                $allowed = array_merge( wp_allowed_protocols(), ['data'] ); ?>
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
// --- LẤY ĐÚNG NGUỒN DỮ LIỆU ---
$GROUP = 'offices_region_1';
$pid   = get_queried_object_id();
if (!$pid) { $pid = get_the_ID(); }                  // phòng khi gọi trong file include
$group = get_field($GROUP, $pid);
if (!$group) { $group = get_field($GROUP, 'option'); } // fallback nếu bạn lưu ở Options Page

// --- LẤY CÁC FIELD ---
$region_icon  = $group['region_icon_url'] ?? '';
$region_title = $group['region_title'] ?? '';
$marker       = trim($group['office_marker_icon_url'] ?? '');

$MAX = 8; // số văn phòng bạn tạo
$items = [];
for ($i = 1; $i <= $MAX; $i++) {
  $t = trim($group["office_title_{$i}"] ?? '');
  $d = $group["office_desc_{$i}"] ?? '';
  if ($t || $d) $items[] = ['title'=>$t, 'desc'=>$d];
}

// Cho phép data: protocol nếu icon là data:image/svg+xml;...
$allowed_protocols = array_merge( wp_allowed_protocols(), ['data'] );
?>

<?php if ($region_icon || $region_title || $items): ?>
    <div class="container">
        <section class="spv-region">
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
<?php endif; ?>

<?php
// --- LẤY ĐÚNG NGUỒN DỮ LIỆU ---
$GROUP = 'offices_region_2';
$pid   = get_queried_object_id();
if (!$pid) { $pid = get_the_ID(); }                  // phòng khi gọi trong file include
$group = get_field($GROUP, $pid);
if (!$group) { $group = get_field($GROUP, 'option'); } // fallback nếu bạn lưu ở Options Page

// --- LẤY CÁC FIELD ---
$region_icon  = $group['region_icon_url'] ?? '';
$region_title = $group['region_title'] ?? '';
$marker       = trim($group['office_marker_icon_url'] ?? '');

$MAX = 8; // số văn phòng bạn tạo
$items = [];
for ($i = 1; $i <= $MAX; $i++) {
  $t = trim($group["office_title_{$i}"] ?? '');
  $d = $group["office_desc_{$i}"] ?? '';
  if ($t || $d) $items[] = ['title'=>$t, 'desc'=>$d];
}

// Cho phép data: protocol nếu icon là data:image/svg+xml;...
$allowed_protocols = array_merge( wp_allowed_protocols(), ['data'] );
?>

<?php if ($region_icon || $region_title || $items): ?>
    <div class="container">
        <section class="spv-region">
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
<?php endif; ?>

<?php
// --- LẤY ĐÚNG NGUỒN DỮ LIỆU ---
$GROUP = 'offices_region_3';
$pid   = get_queried_object_id();
if (!$pid) { $pid = get_the_ID(); }                  // phòng khi gọi trong file include
$group = get_field($GROUP, $pid);
if (!$group) { $group = get_field($GROUP, 'option'); } // fallback nếu bạn lưu ở Options Page

// --- LẤY CÁC FIELD ---
$region_icon  = $group['region_icon_url'] ?? '';
$region_title = $group['region_title'] ?? '';
$marker       = trim($group['office_marker_icon_url'] ?? '');

$MAX = 8; // số văn phòng bạn tạo
$items = [];
for ($i = 1; $i <= $MAX; $i++) {
  $t = trim($group["office_title_{$i}"] ?? '');
  $d = $group["office_desc_{$i}"] ?? '';
  if ($t || $d) $items[] = ['title'=>$t, 'desc'=>$d];
}

// Cho phép data: protocol nếu icon là data:image/svg+xml;...
$allowed_protocols = array_merge( wp_allowed_protocols(), ['data'] );
?>

<?php if ($region_icon || $region_title || $items): ?>
    <div class="container">
        <section class="spv-region">
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
<?php endif; ?>

<?php
$GROUP = 'contact_cards';
$pid   = get_queried_object_id() ?: get_the_ID();
$g     = get_field($GROUP, $pid) ?: get_field($GROUP, 'option'); // fallback Options

$MAX = 4; // số card bạn tạo trong ACF
$cards = [];
for ($i=1; $i<=$MAX; $i++){
  $icon = trim($g["contact_icon_url_{$i}"] ?? '');
  $tit  = trim($g["contact_title_{$i}"] ?? '');
  $desc = trim($g["contact_desc_{$i}"] ?? '');
  if ($icon || $tit || $desc) $cards[] = ['icon'=>$icon,'title'=>$tit,'desc'=>$desc];
}

// LẤY HEADING (icon + title)
$head_icon  = trim($g['contact_arrow_icon'] ?? '');
$head_title = trim($g['contact_text_title'] ?? '');

// helper: tự link mail/phone (nhẹ nhàng)
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

// nếu icon là data:image/svg+xml
$allowed_protocols = array_merge( wp_allowed_protocols(), ['data'] );

// Chỉ render section khi có heading hoặc có ít nhất 1 card
if ($head_icon || $head_title || !empty($cards)): ?>
  <div class="container">
    <section class="spv-contacts">

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