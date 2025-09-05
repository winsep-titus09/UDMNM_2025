<?php
// Theme setup
function myshop_mobile_setup() {
  add_theme_support('title-tag');
  add_theme_support('woocommerce');
  add_theme_support('post-thumbnails');
  add_theme_support('custom-logo');
}
add_action('after_setup_theme', 'myshop_mobile_setup');

// Enqueue styles and scripts
function myshop_mobile_enqueue_scripts() {
  wp_enqueue_style('myshop-mobile-style', get_stylesheet_uri());
  wp_enqueue_style('myshop-mobile-woocommerce', get_template_directory_uri() . '/woocommerce.css', array('myshop-mobile-style'), '1.0');
}
add_action('wp_enqueue_scripts', 'myshop_mobile_enqueue_scripts');
