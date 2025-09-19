<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
  <meta charset="<?php bloginfo('charset'); ?>">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link href="https://fonts.googleapis.com/css?family=Montserrat:400,500,700&display=swap" rel="stylesheet">
  <?php if (!current_theme_supports('title-tag')): ?>
    <title><?php echo esc_html(wp_get_document_title()); ?></title>
  <?php endif; ?>
  <?php wp_head(); ?>

  <style>
    /* ====== BASE ====== */
    
  </style>
</head>
<body <?php body_class(); ?>>

  <?php if (function_exists('wp_body_open')) { wp_body_open(); } ?>

  <header class="container-fluid bg-white" role="banner" aria-label="<?php echo esc_attr__('Đầu trang', 'pepsico-theme'); ?>">
    <nav class="navbar navbar-expand-lg navbar-light" role="navigation" aria-label="<?php echo esc_attr__('Điều hướng chính', 'pepsico-theme'); ?>">
      <div class="container-fluid">

        <!-- Logo / Site name -->
        <div class="navbar-brand">
          <?php if (has_custom_logo()): ?>
            <?php the_custom_logo(); ?>
          <?php else: ?>
            <a href="<?php echo esc_url(home_url('/')); ?>" rel="home" aria-label="<?php echo esc_attr__('Trang chủ', 'pepsico-theme'); ?>">
              <?php bloginfo('name'); ?>
            </a>
          <?php endif; ?>
        </div>

        <!-- Toggle button (mobile) -->
        <button class="navbar-toggler d-lg-none"
                type="button"
                data-bs-toggle="offcanvas"
                data-bs-target="#mobileMenu"
                aria-controls="mobileMenu"
                aria-label="<?php echo esc_attr__('Mở/đóng menu', 'pepsico-theme'); ?>">
          <span class="navbar-toggler-icon"></span>
        </button>

        <!-- Primary Menu (DESKTOP) -->
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

        <!-- Offcanvas Mobile Menu -->
        <div class="offcanvas offcanvas-end d-lg-none" tabindex="-1" id="mobileMenu" aria-labelledby="mobileMenuLabel">
          <div class="offcanvas-header">
            <button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas" aria-label="<?php echo esc_attr__('Đóng', 'pepsico-theme'); ?>"></button>
          </div>
          <div class="offcanvas-body">
            <?php
            wp_nav_menu([
              'theme_location' => 'primary',
              'container'      => false,
              'menu_class'     => 'navbar-nav mobile-nav',
              'fallback_cb'    => '__return_false',
              'depth'          => 2,
            ]);
            ?>
          </div>
        </div>

      </div>
    </nav>
  </header>

  <!-- JS: chỉ gắn mũi tên cho MỤC CHA CẤP 1 & toggle submenu -->
  <script>
    document.addEventListener('DOMContentLoaded', function () {
      var offcanvas = document.getElementById('mobileMenu');
      if (!offcanvas) return;

      var nav = offcanvas.querySelector('.offcanvas-body .navbar-nav');
      if (!nav) return;

      // Chỉ chọn mục cha cấp 1 (trực tiếp dưới .navbar-nav)
      nav.querySelectorAll(':scope > li.menu-item-has-children').forEach(function (li) {
        // Tạo nút toggle ở bên phải
        var toggleBtn = document.createElement('button');
        toggleBtn.className = 'submenu-toggle';
        toggleBtn.type = 'button';
        toggleBtn.setAttribute('aria-label', '<?php echo esc_attr__('Mở/đóng menu con', 'pepsico-theme'); ?>');
        toggleBtn.setAttribute('aria-expanded', 'false');

        // Chèn nút
        li.appendChild(toggleBtn);

        toggleBtn.addEventListener('click', function (e) {
          e.preventDefault();
          e.stopPropagation();
          var isOpen = li.classList.toggle('is-open');
          toggleBtn.setAttribute('aria-expanded', isOpen ? 'true' : 'false');
        });
      });

      // Khi offcanvas đóng, thu gọn tất cả submenu
      offcanvas.addEventListener('hidden.bs.offcanvas', function () {
        offcanvas.querySelectorAll('li.menu-item-has-children.is-open').forEach(function (li) {
          li.classList.remove('is-open');
        });
        offcanvas.querySelectorAll('.submenu-toggle[aria-expanded="true"]').forEach(function (btn) {
          btn.setAttribute('aria-expanded', 'false');
        });
      });
    });
  </script>

  <?php wp_footer(); ?>
</body>
</html>
