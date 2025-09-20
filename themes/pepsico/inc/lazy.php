<?php
// BẬT lazy-load mặc định của WP
add_filter('wp_lazy_loading_enabled', function ($default, $tag_name, $context) {
  return true;
}, 10, 3);

// Không lazy ảnh thumbnail đầu ở trang blog/archive => cải thiện LCP
add_filter('wp_get_attachment_image_attributes', function ($attr, $attachment, $size) {
  static $printed_first_thumb = false;

  if (is_home() || is_archive()) {
    if (!$printed_first_thumb) {
      $attr['loading'] = 'eager';
      $attr['decoding'] = 'async';
      $attr['fetchpriority'] = 'high';
      $printed_first_thumb = true;
    } else {
      $attr['loading'] = 'lazy';
    }
  }
  return $attr;
}, 10, 3);

// Không lazy ảnh hero có class .hero-img ở trang đơn
add_filter('wp_get_attachment_image_attributes', function ($attr) {
  if (!empty($attr['class']) && strpos($attr['class'], 'hero-img') !== false) {
    $attr['loading'] = 'eager';
    $attr['decoding'] = 'async';
    $attr['fetchpriority'] = 'high';
  }
  return $attr;
}, 10, 1);