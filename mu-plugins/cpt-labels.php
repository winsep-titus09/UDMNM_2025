<?php
/**
 * Plugin Name: Pepsico CPT Labels i18n
 * Description: Override label CPT để dịch.
 */

// Đổi nhãn SAU khi CPT UI đăng ký xong
add_action('init', function () {
  $map = [
    'tin_tuc_ve_cong_ty' => [
      'name'          => __('Tin tức về công ty', 'pepsico-theme'),
      'singular_name' => __('Bài viết tin tức', 'pepsico-theme'),
    ],
    'thong_cao_bao_chi' => [
      'name'          => __('Thông cáo báo chí', 'pepsico-theme'),
      'singular_name' => __('Bài viết thông cáo', 'pepsico-theme'),
    ],
  ];

  foreach ($map as $pt => $pairs) {
    add_filter("post_type_labels_{$pt}", function ($labels_obj) use ($pairs) {
      foreach ($pairs as $k => $v) {
        $labels_obj->$k = $v;
      }
      return $labels_obj;
    });
  }
}, 20); // chạy sau CPT UI (10)
