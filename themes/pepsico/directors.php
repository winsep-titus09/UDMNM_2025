<?php
/**
 * Template Name: ĐỘI NGŨ LÃNH ĐẠO
 */
get_header();?>

<?php
$dev = get_field('directors'); // group
$bg  = is_array($dev) ? ($dev['director_banner_url'] ?? '') : '';
$ttl = is_array($dev) ? ($dev['director_title'] ?? '') : '';
?>

<?php if ($bg || $ttl): ?>
<section class="spv-hero" style="--spv-hero-bg: url('<?php echo esc_url($bg); ?>')">
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
// LẤY NHÓM leadership 1 lần
$grp = get_field('leadership');             // -> array hoặc null

$leaders = [];
if (is_array($grp)) {
  for ($i = 1; $i <= 12; $i++) {
    $img   = (string) ($grp["leader_image_url_{$i}"]    ?? '');
    $name  = (string) ($grp["leader_name_{$i}"]         ?? '');
    $title = (string) ($grp["leader_title_{$i}"]        ?? '');
    $ln    = (string) ($grp["leader_linkedin_url_{$i}"] ?? '');

    if ($img || $name || $title || $ln) {
      $leaders[] = compact('img','name','title','ln');
    }
  }
}

// (tuỳ chọn) debug – chỉ hiện khi đang đăng nhập
if (is_user_logged_in()) {
  echo "\n<!-- leadership count: ".count($leaders)." -->\n";
}
?>

<?php if (!empty($leaders)): ?>
<div class="container mt-5">
<section class="leaders">
  <div class="leaders__grid">
    <?php foreach ($leaders as $ld): ?>
      <article class="leader">
        <?php if ($ld['img']): ?>
          <div class="leader__thumb">
            <img src="<?= esc_url($ld['img']) ?>" alt="<?= esc_attr($ld['name'] ?: 'Leader') ?>">
          </div>
        <?php endif; ?>

        <div class="leader__info">
          <div class="leader__head">
            <?php if ($ld['name']): ?>
              <h3 class="leader__name"><?= esc_html($ld['name']) ?></h3>
            <?php endif; ?>

            <?php if ($ld['ln']): ?>
              <a class="leader__ln" href="<?= esc_url($ld['ln']) ?>" target="_blank" rel="noopener" aria-label="LinkedIn">
                <img src="data:image/svg+xml;utf8,%3Csvg display='inline-block' color='inherit' width='1em' height='1em' viewBox='0 0 29 29' fill='none' xmlns='http://www.w3.org/2000/svg'%3E%3Cpath d='M26.6735 0.970825H2.35603C1.51664 0.970825 0.836182 1.65128 0.836182 2.49067V26.8082C0.836182 27.6476 1.51664 28.328 2.35603 28.328H26.6735C27.5129 28.328 28.1934 27.6476 28.1934 26.8082V2.49067C28.1934 1.65128 27.5129 0.970825 26.6735 0.970825Z' fill='%23117EB8'/%3E%3Cpath fill-rule='evenodd' clip-rule='evenodd' d='M5.82864 11.552H9.485V23.3163H5.82864V11.552ZM7.65739 5.70399C8.82653 5.70399 9.77643 6.6539 9.77643 7.82304C9.77643 8.99332 8.82653 9.9436 7.65739 9.9436C7.37564 9.94893 7.09565 9.89805 6.83379 9.79391C6.57193 9.68978 6.33346 9.53449 6.13232 9.33712C5.93117 9.13975 5.77139 8.90426 5.66232 8.64442C5.55325 8.38458 5.49707 8.1056 5.49707 7.8238C5.49707 7.54199 5.55325 7.26302 5.66232 7.00318C5.77139 6.74334 5.93117 6.50785 6.13232 6.31048C6.33346 6.11311 6.57193 5.95781 6.83379 5.85368C7.09565 5.74955 7.37564 5.69866 7.65739 5.70399ZM11.7784 11.5516H15.2855V13.1592H15.3341C15.8224 12.2344 17.0151 11.2594 18.7937 11.2594C22.496 11.2594 23.1799 13.6961 23.1799 16.8638V23.3163H19.5259V17.5953C19.5259 16.2312 19.5008 14.4762 17.6261 14.4762C15.7236 14.4762 15.4314 15.9622 15.4314 17.4968V23.3163H11.7781V11.552L11.7784 11.5516Z' fill='white'/%3E%3C/svg%3E" alt="">
              </a>
            <?php endif; ?>
          </div>

          <div class="leader__title">
            <?= wp_kses($ld['title'], ['br'=>[], 'strong'=>[], 'em'=>[]]) ?>
        </div>
        </div>
      </article>
    <?php endforeach; ?>
  </div>
</section>
</div>
<?php endif; ?>





<?php get_footer(); ?>