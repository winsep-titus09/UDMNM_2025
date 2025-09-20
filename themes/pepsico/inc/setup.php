<?php
// Kích hoạt các tính năng theme
function pepsico_theme_setup()
{
	add_theme_support('title-tag');
	add_theme_support('post-thumbnails');
	add_theme_support('custom-logo');
	register_nav_menus([
		'primary' => __('Primary Menu', 'pepsico'),
		've_chung_toi' => __('Về chúng tôi', 'pepsico'),
		'san_pham' => __('Sản phẩm', 'pepsico'),
		'phat_trien_ben_vung' => __('Phát triển bền vững', 'pepsico'),
		'tin_tuc' => __('Tin tức', 'pepsico'),
		'khac' => __('Khác', 'pepsico'),
	]);
}
add_action('after_setup_theme', 'pepsico_theme_setup');