<?php
if ( !defined( 'ABSPATH' ) ) exit;

// Đăng ký CSS & JS
function mytheme_enqueue_scripts() {
    // Bootstrap CSS (CDN)
    wp_enqueue_style( 'bootstrap-css', 'https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css' );

    // CSS mặc định của theme (style.css)
    wp_enqueue_style( 'mytheme-style', get_stylesheet_uri() );

    // Custom CSS
    wp_enqueue_style( 'mytheme-custom', get_template_directory_uri() . '/assets/css/custom.css', array('bootstrap-css', 'mytheme-style') );

    // Bootstrap JS (CDN, kèm Popper)
    wp_enqueue_script( 'bootstrap-js', 'https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js', array('jquery'), null, true );

    // Custom JS
    wp_enqueue_script( 'mytheme-script', get_template_directory_uri() . '/assets/js/main.js', array('jquery'), null, true );
}
add_action( 'wp_enqueue_scripts', 'mytheme_enqueue_scripts' );

// Hỗ trợ các tính năng cơ bản
function mytheme_setup() {
    add_theme_support( 'title-tag' );
    add_theme_support( 'post-thumbnails' );
    add_theme_support( 'custom-logo' );
    add_theme_support( 'automatic-feed-links' );
    add_theme_support( 'html5', array( 'search-form', 'comment-form', 'comment-list', 'gallery', 'caption' ) );
    register_nav_menus( array(
        'primary' => __( 'Primary Menu', 'mytheme' ),
    ));
}
add_action( 'after_setup_theme', 'mytheme_setup' );
