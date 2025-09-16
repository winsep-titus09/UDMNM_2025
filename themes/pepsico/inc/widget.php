<?php
// ==============================
// FOOTER WIDGET-ONLY SETUP
// - Tất cả nội dung footer cấu hình bằng Widgets
// - Không dùng Customizer cho footer nữa
// ==============================

add_action('widgets_init', function () {
  // --- 5 cột nội dung chính ---
  $cols = 5;
  for ($i = 1; $i <= $cols; $i++) {
    register_sidebar([
      'name'          => "Footer cột {$i}",
      'id'            => "footer-{$i}",
      'description'   => "Kéo thả widget hiển thị ở cột {$i} của footer",
      'before_widget' => '<div class="footer-widget footer-widget-'.$i.'">',
      'after_widget'  => '</div>',
      'before_title'  => '<h4 class="footer-title">',
      'after_title'   => '</h4>',
    ]);
  }

  // --- Bottom bar: chia 3 vùng để linh hoạt ---
  register_sidebar([
    'name'          => 'Footer Bottom Left',
    'id'            => 'footer-bottom-left',
    'description'   => 'Thường dùng cho Copyright. Kéo thả Text/HTML.',
    'before_widget' => '<div class="footer-bottom-widget footer-bottom-left">',
    'after_widget'  => '</div>',
    'before_title'  => '<h5 class="footer-bottom-title">',
    'after_title'   => '</h5>',
  ]);

  register_sidebar([
    'name'          => 'Footer Bottom Center',
    'id'            => 'footer-bottom-center',
    'description'   => 'Thường dùng cho Menu legal. Kéo thả Navigation Menu hoặc List.',
    'before_widget' => '<div class="footer-bottom-widget footer-bottom-center">',
    'after_widget'  => '</div>',
    'before_title'  => '<h5 class="footer-bottom-title">',
    'after_title'   => '</h5>',
  ]);

  register_sidebar([
    'name'          => 'Footer Bottom Right',
    'id'            => 'footer-bottom-right',
    'description'   => 'Thường dùng cho Social Icons (block) hoặc HTML icon.',
    'before_widget' => '<div class="footer-bottom-widget footer-bottom-right">',
    'after_widget'  => '</div>',
    'before_title'  => '<h5 class="footer-bottom-title">',
    'after_title'   => '</h5>',
  ]);
});


// Sidebar dành cho bộ lọc tin tức (cột phải)
add_action('widgets_init', function () {
    register_sidebar([
        'name'          => __('Bộ lọc tin tức (cột phải)', 'td'),
        'id'            => 'news-filter',
        'description'   => __('Kéo widget bộ lọc vào đây để hiển thị ở trang tin tức.', 'td'),
        'before_widget' => '<section id="%1$s" class="widget %2$s spv-news-filterCard">',
        'after_widget'  => '</section>',
        'before_title'  => '<h3 class="spv-news-filterTitle">',
        'after_title'   => '</h3>',
    ]);
});
