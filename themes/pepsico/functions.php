<?php
// Kích hoạt hỗ trợ logo
add_theme_support('custom-logo');

// Kích hoạt hỗ trợ thumbnail ảnh
add_theme_support('post-thumbnails');

// Enqueue Bootstrap, custom.css, và custom.js
function pepsico_enqueue_scripts() {
    // Bootstrap CSS
    wp_enqueue_style('bootstrap', 'https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css');
    wp_enqueue_style('pepsico-style', get_stylesheet_uri());
    wp_enqueue_style('pepsico-custom', get_template_directory_uri() . '/custom.css');

    // Bootstrap JS (nên dùng Popper đi kèm)
    wp_enqueue_script('bootstrap', 'https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js', array('jquery'), '5.3.3', true);

    // custom.js của theme
    wp_enqueue_script('pepsico-customjs', get_template_directory_uri() . '/custom.js', array('jquery'), null, true);
}
add_action('wp_enqueue_scripts', 'pepsico_enqueue_scripts');

// Tối ưu ảnh upload
add_filter('jpeg_quality', function($arg){return 82;});
add_filter('wp_handle_upload_prefilter','pepsico_optimize_image');
function pepsico_optimize_image($file) {
    // Chỉ tối ưu ảnh JPG/JPEG/PNG
    $ext = strtolower(pathinfo($file['name'], PATHINFO_EXTENSION));
    if (in_array($ext, ['jpg','jpeg','png'])) {
        // Có thể dùng plugin hoặc hook thêm để nén ảnh mạnh hơn
    }
    return $file;
}

// Thay logo wp-admin
function pepsico_admin_logo() {
    echo '<style type="text/css">
        #wpadminbar #wp-admin-bar-wp-logo > .ab-item .ab-icon {
            background-image: url(' . get_theme_mod('custom_logo') . ') !important;
            background-position: 0 0;
            background-size: cover;
        }
    </style>';
}
add_action('admin_head', 'pepsico_admin_logo');

// Đổi logo trang đăng nhập
function pepsico_login_logo() {
    $logo = wp_get_attachment_image_url(get_theme_mod('custom_logo'), 'full');
    if ($logo) {
        echo '<style type="text/css">
            .login h1 a {background-image: url('.$logo.') !important; background-size:contain !important;}
        </style>';
    }
}
add_action('login_head', 'pepsico_login_logo');
?>