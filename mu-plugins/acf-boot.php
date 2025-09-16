<?php
/**
 * Plugin Name: ACF Boot (MU)
 * Description: Chỉ định Local JSON & ẩn ACF admin.
 */
if (!defined('ABSPATH')) exit;

// Local JSON: nơi ACF ghi/đọc Field Groups
add_filter('acf/settings/save_json', function ($path) {
  $dir = WP_CONTENT_DIR . '/mu-plugins/acf-json';
  if (!is_dir($dir)) {
    if (function_exists('wp_mkdir_p')) wp_mkdir_p($dir);
    else @mkdir($dir, 0755, true);
  }
  return $dir;
});
add_filter('acf/settings/load_json', function ($paths) {
  $paths[] = WP_CONTENT_DIR . '/mu-plugins/acf-json';
  return $paths;
});

// Nếu CPT/Tax đã chuyển sang code, có thể ẩn các mục CPT/Tax trong ACF UI
add_filter('acf/settings/enable_post_types', '__return_false');
add_filter('acf/settings/enable_taxonomies', '__return_false');

// Ẩn toàn bộ ACF admin (Field Groups, Tools, Sync...) ở môi trường non-dev
add_action('init', function () {
  if (wp_get_environment_type() !== 'development') {
    add_filter('acf/settings/show_admin', '__return_false');
  }
});
