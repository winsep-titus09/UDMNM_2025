<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
  <meta charset="<?php bloginfo('charset'); ?>">
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <!-- Font (tuỳ chọn) -->
  <link href="https://fonts.googleapis.com/css?family=Montserrat:400,500,700&display=swap" rel="stylesheet">

  <?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>

<?php
// Hook cho plugin/analytics, bắt đầu từ WP 5.2
if (function_exists('wp_body_open')) {
  wp_body_open();
}
?>

<header class="container-fluid bg-white" role="banner" aria-label="<?php echo esc_attr__('Đầu trang', 'pepsico-theme'); ?>">
  <nav class="navbar navbar-expand-lg navbar-light" role="navigation" aria-label="<?php echo esc_attr__('Điều hướng chính', 'pepsico-theme'); ?>">
    <div class="container-fluid">

      <!-- Logo / Site name -->
      <div class="navbar-brand">
        <?php if (has_custom_logo()) : ?>
          <?php the_custom_logo(); ?>
        <?php else : ?>
          <a href="<?php echo esc_url(home_url('/')); ?>" rel="home" aria-label="<?php echo esc_attr__('Trang chủ', 'pepsico-theme'); ?>">
            <?php bloginfo('name'); ?>
          </a>
        <?php endif; ?>
      </div>

      <!-- Toggle button (mobile) -->
      <button class="navbar-toggler"
              type="button"
              data-bs-toggle="collapse"
              data-bs-target="#mainMenu"
              aria-controls="mainMenu"
              aria-expanded="false"
              aria-label="<?php echo esc_attr__('Mở/đóng menu', 'pepsico-theme'); ?>">
        <span class="navbar-toggler-icon"></span>
      </button>

      <!-- Primary Menu -->
      <div class="collapse navbar-collapse justify-content-end" id="mainMenu">
        <?php
        wp_nav_menu([
          'theme_location' => 'primary',
          'container'      => false,
          'menu_class'     => 'navbar-nav ms-auto mb-2 mb-lg-0',
          'fallback_cb'    => '__return_false',
          'depth'          => 2,
        ]);
        ?>
      </div>
    </div>
  </nav>
</header>
