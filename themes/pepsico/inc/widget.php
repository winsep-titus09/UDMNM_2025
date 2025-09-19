<?php
// ==============================
// FOOTER & NEWS FILTER WIDGET AREAS (i18n-ready)
// ==============================
add_action('widgets_init', function () {

  // --- 5 cột nội dung chính ---
  $cols = 5;
  for ($i = 1; $i <= $cols; $i++) {
    register_sidebar([
      'name' => sprintf(__('Footer cột %d', 'pepsico-theme'), $i),
      'id' => "footer-{$i}",
      'description' => sprintf(__('Kéo thả widget hiển thị ở cột %d của footer', 'pepsico-theme'), $i),
      'before_widget' => '<div class="footer-widget footer-widget-' . $i . '">',
      'after_widget' => '</div>',
      'before_title' => '<h4 class="footer-title">',
      'after_title' => '</h4>',
    ]);
  }

  // --- Bottom bar: chia 3 vùng để linh hoạt ---
  register_sidebar([
    'name' => __('Footer Bottom Left', 'pepsico-theme'),
    'id' => 'footer-bottom-left',
    'description' => __('Thường dùng cho Copyright. Kéo thả Text/HTML.', 'pepsico-theme'),
    'before_widget' => '<div class="footer-bottom-widget footer-bottom-left">',
    'after_widget' => '</div>',
    'before_title' => '<h5 class="footer-bottom-title">',
    'after_title' => '</h5>',
  ]);

  register_sidebar([
    'name' => __('Footer Bottom Center', 'pepsico-theme'),
    'id' => 'footer-bottom-center',
    'description' => __('Thường dùng cho Menu legal. Kéo thả Navigation Menu hoặc List.', 'pepsico-theme'),
    'before_widget' => '<div class="footer-bottom-widget footer-bottom-center">',
    'after_widget' => '</div>',
    'before_title' => '<h5 class="footer-bottom-title">',
    'after_title' => '</h5>',
  ]);

  register_sidebar([
    'name' => __('Footer Bottom Right', 'pepsico-theme'),
    'id' => 'footer-bottom-right',
    'description' => __('Thường dùng cho Social Icons (block) hoặc HTML icon.', 'pepsico-theme'),
    'before_widget' => '<div class="footer-bottom-widget footer-bottom-right">',
    'after_widget' => '</div>',
    'before_title' => '<h5 class="footer-bottom-title">',
    'after_title' => '</h5>',
  ]);

  // --- Sidebar dành cho bộ lọc tin tức (cột phải) ---
  register_sidebar([
    'name' => __('Bộ lọc tin tức (cột phải)', 'pepsico-theme'),
    'id' => 'news-filter',
    'description' => __('Kéo widget bộ lọc vào đây để hiển thị ở trang tin tức.', 'pepsico-theme'),
    'before_widget' => '<section id="%1$s" class="widget %2$s spv-news-filterCard">',
    'after_widget' => '</section>',
    'before_title' => '<h3 class="spv-news-filterTitle">',
    'after_title' => '</h3>',
  ]);

});
