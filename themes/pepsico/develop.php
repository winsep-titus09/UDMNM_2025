<?php
/**
 * Template Name: Phát triển bền vững
 */

get_header(); ?>

<?php
$dev = get_field('develop_banner'); // group
$bg  = is_array($dev) ? ($dev['develop_banner_bg'] ?? '') : '';
$ttl = is_array($dev) ? ($dev['develop_banner_title'] ?? '') : '';
?>

<?php if ($bg || $ttl): ?>
<?php
  // Lựa chọn:
  // - Lazy background (mặc định): dùng class lazy-bg + data-bg-var để trì hoãn tải nền hero (tiết kiệm băng thông).
  // - Nếu muốn tối ưu LCP: ĐỔI thành style="--spv-hero-bg: url('...')" và bỏ class "lazy-bg" + thuộc tính data-*.
?>
<section
  class="spv-hero lazy-bg"
  <?php if ($bg): ?>data-bg="<?php echo esc_url($bg); ?>" data-bg-var="--spv-hero-bg"<?php endif; ?>
>
  <?php if ($bg): ?>
    <noscript><style>.spv-hero{--spv-hero-bg:url('<?php echo esc_url($bg); ?>')}</style></noscript>
  <?php endif; ?>
  <div class="spv-hero__bg" aria-hidden="true"></div>
  <div class="spv-hero__inner">
    <?php if ($ttl): ?>
      <h1 class="spv-hero__title"><?php echo esc_html($ttl); ?></h1>
      <!-- Muốn xuống dòng theo nội dung: echo nl2br(esc_html($ttl)); -->
    <?php endif; ?>
  </div>
</section>
<?php endif; ?>

<?php
$dm = get_field('develop_message'); // group

$msg   = is_array($dm) ? ($dm['develop_message_text'] ?? '') : '';
$ava   = is_array($dm) ? ($dm['develop_author_avatar'] ?? '') : '';
$name  = is_array($dm) ? ($dm['develop_author_name'] ?? '')  : '';
$title = is_array($dm) ? ($dm['develop_author_title'] ?? '') : '';

$cta        = is_array($dm) ? ($dm['develop_cta'] ?? []) : [];
$cta_text   = is_array($cta) ? ($cta['develop_cta_text'] ?? '') : '';
$cta_url    = is_array($cta) ? ($cta['develop_cta_url'] ?? '') : '';
$cta_target = !empty($cta['develop_cta_target']) ? ' target="_blank" rel="noopener"' : '';
$cta_icon   = is_array($cta) ? ($cta['develop_cta_icon'] ?? '') : '';
?>

<?php if ($msg || $name || $title || $ava || $cta_text): ?>
<section class="ceo-msg mt-5" aria-label="<?php echo esc_attr__('Thông điệp lãnh đạo', 'pepsico-theme'); ?>">
  <?php if ($msg): ?>
    <h2 class="ceo-msg__text"><?php echo esc_html($msg); ?></h2>
  <?php endif; ?>

  <?php if ($name || $title || $ava): ?>
    <div class="ceo-msg__divider" aria-hidden="true"></div>
    <div class="ceo-msg__author">
      <?php if ($ava): ?>
        <img class="ceo-msg__avatar"
             src="<?php echo esc_url($ava); ?>"
             alt="<?php echo esc_attr($name ?: __('Ảnh đại diện', 'pepsico-theme')); ?>"
             loading="lazy" decoding="async" sizes="96px">
      <?php endif; ?>
      <div class="ceo-msg__meta">
        <?php if ($name):  ?><div class="ceo-msg__name"><?php echo esc_html($name); ?></div><?php endif; ?>
        <?php if ($title): ?><div class="ceo-msg__title"><?php echo esc_html($title); ?></div><?php endif; ?>
      </div>
    </div>
  <?php endif; ?>

  <?php if ($cta_text && $cta_url): ?>
    <div class="ceo-msg__cta">
      <a class="btn" href="<?php echo esc_url($cta_url); ?>"<?php echo $cta_target; ?>>
        <span><?php echo esc_html($cta_text); ?></span>
        <?php if ($cta_icon):
          $allowed = array_merge( wp_allowed_protocols(), ['data'] ); ?>
          <img class="icon" src="<?php echo esc_url($cta_icon, $allowed); ?>" alt="" decoding="async">
        <?php endif; ?>
      </a>
    </div>
  <?php endif; ?>
</section>
<?php endif; ?>

<?php
$banner = get_field('develop_banner2');
if ($banner):
  $bg   = $banner['develop_banner_img2'] ?? '';
  $title= $banner['develop_title_2'] ?? '';
  $desc = $banner['develop_desc2'] ?? '';
  $btn  = $banner['develop_btn2'] ?? [];

  $btn_title = $btn['develop_btn2_title'] ?? '';
  $btn_link  = $btn['develop_btn2_link'] ?? '';
  $btn_icon  = $btn['develop_btn2_icon'] ?? '';
?>
<section id="developHero" class="develop-hero mt-5" aria-label="<?php echo esc_attr__('Khối giới thiệu phát triển bền vững', 'pepsico-theme'); ?>">
  <div class="develop-hero__bg">
    <?php if ($bg): ?>
      <img src="<?php echo esc_url($bg); ?>" alt="" loading="lazy" decoding="async" sizes="100vw">
    <?php endif; ?>
    <span class="develop-hero__fog" aria-hidden="true"></span>
  </div>

  <div class="develop-hero__inner">
    <?php if ($title): ?>
      <h1 class="develop-hero__title"><?php echo esc_html($title); ?></h1>
    <?php endif; ?>

    <?php if ($desc): ?>
      <div class="develop-hero__desc">
        <?php echo nl2br(esc_html($desc)); // textarea: giữ xuống dòng ?>
      </div>
    <?php endif; ?>

    <?php if ($btn_title && $btn_link): ?>
      <a class="develop-hero__btn" href="<?php echo esc_url($btn_link); ?>">
        <span><?php echo esc_html($btn_title); ?></span>
        <?php if ($btn_icon):
          $allowed = array_merge( wp_allowed_protocols(), ['data'] ); ?>
          <img class="icon" src="<?php echo esc_url($btn_icon, $allowed); ?>" alt="" loading="lazy" decoding="async" sizes="24px">
        <?php endif; ?>
      </a>
    <?php endif; ?>
  </div>
</section>
<?php endif; ?>

<?php
// ----- CẤU HÌNH -----
$GROUP_NAME = 'sustain_slider'; // <— đổi theo "field name" của GROUP trong ACF
$MAX        = 9;                // số item bạn đã tạo: _1 .. _N

// ----- LẤY DỮ LIỆU TỪ GROUP -----
$pid        = get_queried_object_id();
$group      = get_field($GROUP_NAME, $pid); // array các subfields
$main_title = isset($group['ss_main_title']) ? trim($group['ss_main_title']) : '';

$cards = [];
if (is_array($group)) {
  for ($i = 1; $i <= $MAX; $i++) {
    $img   = $group["ss_image_url_{$i}"] ?? '';
    $title = $group["ss_title_{$i}"]     ?? '';
    $desc  = $group["ss_desc_{$i}"]      ?? '';
    if ($img || $title || $desc) {
      $cards[] = ['img' => $img, 'title' => $title, 'desc' => $desc];
    }
  }
}
?>

<main id="primary" class="site-main mt-5">
  <div class="container">
    <div class="develop-hero__inner">
      <?php if ($main_title): ?>
        <h2 class="develop-hero__title">
          <?php echo nl2br(esc_html($main_title)); // giữ xuống dòng của textarea ?>
        </h2>
      <?php endif; ?>
    </div>

    <?php if (!empty($cards)): ?>
      <section class="sustain" data-gap="28" data-autoplay="5000" aria-label="<?php echo esc_attr__('Danh sách sáng kiến bền vững', 'pepsico-theme'); ?>">
        <div class="sustain-scroller">
          <?php foreach ($cards as $c): ?>
            <article class="s-card">
              <?php if (!empty($c['img'])): ?>
                <div class="s-card__thumb">
                  <img
                    src="<?php echo esc_url($c['img']); ?>"
                    alt=""
                    loading="lazy" decoding="async"
                    sizes="(min-width:1200px) 25vw, (min-width:768px) 33vw, 50vw">
                </div>
              <?php endif; ?>

              <?php if (!empty($c['title'])): ?>
                <h3 class="s-card__title"><?php echo esc_html($c['title']); ?></h3>
              <?php endif; ?>

              <?php if (!empty($c['desc'])): ?>
                <div class="s-card__desc">
                  <?php
                  // Nếu desc là Textarea:
                  echo nl2br(esc_html($c['desc']));
                  // Nếu desc là WYSIWYG thì dùng:
                  // echo wp_kses_post($c['desc']);
                  ?>
                </div>
              <?php endif; ?>
            </article>
          <?php endforeach; ?>
        </div>

        <button class="s-nav prev" type="button" aria-label="<?php echo esc_attr__('Trước', 'pepsico-theme'); ?>">‹</button>
        <button class="s-nav next" type="button" aria-label="<?php echo esc_attr__('Sau', 'pepsico-theme'); ?>">›</button>
      </section>
    <?php else: ?>
      <!-- DEBUG: Không có dữ liệu trong group "<?php echo esc_html($GROUP_NAME); ?>" cho post ID=<?php echo (int) $pid; ?> -->
    <?php endif; ?>
  </div>
</main>

<!-- JS: Lazy-load cho background (hỗ trợ cả CSS variable qua data-bg-var) -->
<script>
(function(){
  const els = document.querySelectorAll('.lazy-bg[data-bg]');
  if (!els.length) return;

  function reveal(el){
    const url = el.getAttribute('data-bg');
    const cssVar = el.getAttribute('data-bg-var');
    if (!url) return;
    if (cssVar) {
      // Lazy cho nền dùng CSS variable: ví dụ --spv-hero-bg
      el.style.setProperty(cssVar, 'url(' + url + ')');
    } else {
      // Lazy cho background-image trực tiếp
      el.style.backgroundImage = 'url(' + url + ')';
    }
    el.removeAttribute('data-bg');
  }

  if (!('IntersectionObserver' in window)) {
    els.forEach(reveal);
    return;
  }

  const io = new IntersectionObserver((entries)=>{
    entries.forEach(entry=>{
      if (entry.isIntersecting) {
        reveal(entry.target);
        io.unobserve(entry.target);
      }
    });
  }, { rootMargin: '300px 0px' });

  els.forEach(el=>io.observe(el));
})();
</script>

<?php get_footer(); ?>
