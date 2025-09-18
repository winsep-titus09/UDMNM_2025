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
