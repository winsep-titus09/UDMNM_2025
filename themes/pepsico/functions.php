<?php
// Kích hoạt các tính năng theme
function pepsico_theme_setup() {
	add_theme_support('title-tag');
	add_theme_support('post-thumbnails');
	add_theme_support('custom-logo');
	register_nav_menus([
		'primary'                => __('Primary Menu', 'pepsico'),
		've_chung_toi'           => __('Về chúng tôi', 'pepsico'),
		'san_pham'               => __('Sản phẩm', 'pepsico'),
		'phat_trien_ben_vung'    => __('Phát triển bền vững', 'pepsico'),
		'tin_tuc'                => __('Tin tức', 'pepsico'),
		'khac'                   => __('Khác', 'pepsico'),
	]);
}
add_action('after_setup_theme', 'pepsico_theme_setup');

// Nạp CSS và JS
function pepsico_enqueue_scripts() {
	wp_enqueue_style('bootstrap', 'https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css');
	wp_enqueue_style('pepsico-style', get_stylesheet_uri());
	wp_enqueue_style('pepsico-custom', get_template_directory_uri() . '/custom.css');
	wp_enqueue_script('bootstrap', 'https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js', [], null, true);
	wp_enqueue_script('pepsico-custom', get_template_directory_uri() . '/custom.js', [], null, true);
}
add_action('wp_enqueue_scripts', 'pepsico_enqueue_scripts');

function register_navwalker(){
	require_once get_template_directory() . '/inc/class-wp-bootstrap-navwalker.php';
}
add_action( 'after_setup_theme', 'register_navwalker' );

function pepsico_customize_footer_logo($wp_customize) {
    $wp_customize->add_section('footer_logo_section', array(
        'title' => __('Footer Logo', 'pepsico'),
        'priority' => 30,
    ));
    $wp_customize->add_setting('footer_logo');
    $wp_customize->add_control(new WP_Customize_Image_Control($wp_customize, 'footer_logo', array(
        'label' => __('Footer Logo', 'pepsico'),
        'section' => 'footer_logo_section',
        'settings' => 'footer_logo',
    )));
}
add_action('customize_register', 'pepsico_customize_footer_logo');

// Tắt Gutenberg, bật Classic Editor
add_filter('use_block_editor_for_post', '__return_false', 10);

// Tắt trình soạn thảo khối trong widget (WP 5.8+)
add_filter('use_widgets_block_editor', '__return_false');
