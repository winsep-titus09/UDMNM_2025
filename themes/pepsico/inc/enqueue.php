<?php
// Nạp CSS và JS
function pepsico_enqueue_scripts() {
	wp_enqueue_style('bootstrap', 'https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css');
	wp_enqueue_style('pepsico-style', get_stylesheet_uri());
	wp_enqueue_style('pepsico-custom', get_template_directory_uri() . '/custom.css');
	
	wp_enqueue_script('bootstrap', 'https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js', [], null, true);
	wp_enqueue_script('pepsico-custom', get_template_directory_uri() . '/custom.js', [], null, true);
}
add_action('wp_enqueue_scripts', 'pepsico_enqueue_scripts');

// Biến <link rel="stylesheet"> -> preload+onload cho các handle chỉ định
add_filter('style_loader_tag', function ($html, $handle, $href, $media) {
  // Chỉ đổi khi đang đăng nhập (vì 2 file này chỉ xuất hiện lúc login)
  if ( ! is_user_logged_in() ) return $html;

  $defer_handles = [
    'dashicons',
    'admin-bar',
    // thêm nữa nếu muốn: 'bootstrap', 'pepsico-style', 'pepsico-custom'
  ];

  if (!in_array($handle, $defer_handles, true)) return $html;

  $preload  = sprintf(
    '<link rel="preload" as="style" href="%s" onload="this.onload=null;this.rel=\'stylesheet\'">',
    esc_url($href)
  );
  $fallback = sprintf(
    '<noscript><link rel="stylesheet" href="%s" media="%s"></noscript>',
    esc_url($href),
    esc_attr($media ?: 'all')
  );
  return $preload . "\n" . $fallback . "\n";
}, 999, 4); // priority cao để chắc chắn override

/* ========== HARD MODE: dequeue + preload (không chặn render) ========== */

/* 1) Gỡ 3 stylesheet ra khỏi hàng đợi (tránh WP in <link rel="stylesheet">) */
add_action('wp_enqueue_scripts', function () {
  // đúng handle theo code của bạn
  wp_dequeue_style('pepsico-style');
  wp_dequeue_style('pepsico-custom');
  wp_dequeue_style('bootstrap');
}, 100);

/* 2) In lại theo dạng preload + onload + noscript trong <head> */
add_action('wp_head', function () {
  $style_css  = get_stylesheet_uri();                                  // /pepsico/style.css
  $custom_css = get_template_directory_uri() . '/custom.css';          // /pepsico/custom.css
  $bootstrap  = 'https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css';

  // style.css
  echo '<link rel="preload" as="style" href="' . esc_url($style_css) . '" onload="this.onload=null;this.rel=\'stylesheet\'">' . "\n";
  echo '<noscript><link rel="stylesheet" href="' . esc_url($style_css) . '"></noscript>' . "\n";

  // custom.css
  echo '<link rel="preload" as="style" href="' . esc_url($custom_css) . '" onload="this.onload=null;this.rel=\'stylesheet\'">' . "\n";
  echo '<noscript><link rel="stylesheet" href="' . esc_url($custom_css) . '"></noscript>' . "\n";

  // bootstrap.css (chỉ để nếu thật sự cần)
  echo '<link rel="preload" as="style" href="' . esc_url($bootstrap) . '" onload="this.onload=null;this.rel=\'stylesheet\'">' . "\n";
  echo '<noscript><link rel="stylesheet" href="' . esc_url($bootstrap) . '"></noscript>' . "\n";
}, 1);

/* 3) (khuyên dùng) Tối ưu Google Fonts không chặn render – đưa vào <head> */
add_action('wp_head', function () {
  ?>
  <link rel="preconnect" href="https://fonts.googleapis.com" crossorigin>
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link rel="preload" as="style"
        href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;500;700&display=swap"
        onload="this.onload=null;this.rel='stylesheet'">
  <noscript>
    <link rel="stylesheet"
          href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;500;700&display=swap">
  </noscript>
  <?php
}, 0);

// Gỡ CSS của Gutenberg/Block Library ở frontend (nếu không dùng)
add_action('wp_enqueue_scripts', function () {
  if (!is_admin()) {
    wp_dequeue_style('wp-block-library');
    wp_dequeue_style('wp-block-library-theme');
    wp_dequeue_style('global-styles'); // WP 6.x (theme.json)
    wp_dequeue_style('classic-theme-styles'); // WP 6.x
    wp_dequeue_style('wc-block-style'); // Woo Blocks (nếu dùng WooCommerce Blocks thì KHÔNG gỡ)
  }
}, 100);
