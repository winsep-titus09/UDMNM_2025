<?php
// 12 bài / trang cho archive Tin tức công ty (và tiện thể cho Thông cáo)
add_action('pre_get_posts', function ($q) {
  if (!is_admin() && $q->is_main_query() && $q->is_post_type_archive('tin_tuc_ve_cong_ty')) {
    $q->set('posts_per_page', 12);
  }
  if (!is_admin() && $q->is_main_query() && $q->is_post_type_archive('thong-cao-bao-chi')) {
    $q->set('posts_per_page', 12);
  }
});
