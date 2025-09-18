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
