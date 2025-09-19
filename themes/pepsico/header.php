<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
  <meta charset="<?php bloginfo('charset'); ?>">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <!-- Font (tuỳ chọn) -->
  <link href="https://fonts.googleapis.com/css?family=Montserrat:400,500,700&display=swap" rel="stylesheet">
  <?php if ( ! current_theme_supports('title-tag') ) : ?>
    <title><?php echo esc_html( wp_get_document_title() ); ?></title>
  <?php endif; ?>
  <?php wp_head(); ?>
  <style>
    body,
    html {
      background-color: #f2f9f9;
      overflow-x: hidden;
      font-family: "Montserrat", Arial, sans-serif;
      scroll-behavior: smooth;
    }
    /* header */

    header.container.py-3,
    header.container-fluid.bg-white {
      position: fixed;
      top: 0;
      z-index: 9999;
      background: #fff;
      box-shadow: 0 4px 16px rgba(38, 38, 38, 0.28);
    }

    header.container.py-3 {
      height: 50px;
      position: relative;
      box-shadow: 0 4px 16px rgba(38, 170, 225, 0.15);
    }

    header.container-fluid.bg-white.w-auto {
      height: 71px;
    }

    .row.align-items-center {
      margin: 0 100px;
      padding: 15px 0;
    }

    img.custom-logo {
      width: 110px;
      height: 45px;
    }

    ul#menu-pepsico_menu {
      display: flex;
      justify-content: space-between;
      align-items: center;
      flex-wrap: nowrap;
      list-style: none;
      margin: 0;
      padding: 0;
      white-space: nowrap;
    }

    nav.navbar.navbar-expand-lg.navbar-light {
      margin: 0 100px;
    }

    #mainMenu > ul.navbar-nav {
      margin: 0 auto !important;
      display: flex !important;
      justify-content: center !important;
      align-items: center !important;
      width: auto;
      font-weight: 500;
      gap: 10px;
      font-size: 16px;
      letter-spacing: 0.02em;
      list-style: none;
      padding: 0;
      -webkit-text-stroke: 0.5px #000;
    }

    a {
      text-decoration: none;
    }

    /* Menu item */
    .navbar-nav li,
    .menu-item-has-children {
      position: relative;
    }

    /* Màu chữ, hiệu ứng hover */
    .navbar-nav > li > a,
    .menu-item > a,
    .navbar-collapse .navbar-nav .nav-link {
      color: #000;
      transition: color 0.25s;
    }
    .navbar-nav > li > a:hover,
    .menu-item > a:hover,
    .menu-item.current-menu-item > a,
    .menu-item.current_page_item > a,
    .navbar-collapse .navbar-nav .nav-link:hover {
      color: #26aae1;
      -webkit-text-stroke: 0.5px #26aae1;
    }

    /* Dropdown */
    .menu-item-has-children .sub-menu,
    .navbar-nav .sub-menu {
      position: absolute;
      left: 0;
      top: 100%;
      margin-top: 23px;
      min-width: 200px;
      padding: 10px 0;
      background: #fff;
      border-bottom-left-radius: 12px;
      border-bottom-right-radius: 12px;
      box-shadow: 0 8px 24px -8px rgba(0, 0, 0, 0.28),
        -4px 0 12px -8px rgba(0, 0, 0, 0.18), 4px 0 12px -8px rgba(0, 0, 0, 0.18);
      z-index: 1000;
      opacity: 0;
      pointer-events: none;
      transform: translateY(20px);
      transition: opacity 0.35s cubic-bezier(0.4, 0, 0.2, 1),
        transform 0.35s cubic-bezier(0.4, 0, 0.2, 1);
    }

    .menu-item-has-children:hover .sub-menu,
    .menu-item-has-children:focus-within .sub-menu,
    .menu-item-has-children.dropdown-open .sub-menu,
    .navbar-nav li:hover > .sub-menu {
      opacity: 1;
      pointer-events: auto;
      transform: translateY(0);
    }

    .menu-item-has-children .sub-menu li,
    .navbar-nav .sub-menu li {
      display: block;
      padding: 20px 0px;
      border-bottom: 1px solid #e6eaf0;
    }

    .menu-item-has-children .sub-menu li a,
    .navbar-nav .sub-menu li a {
      color: #333;
      display: block;
      text-decoration: none;
    }
    .menu-item-has-children .sub-menu li a:hover,
    .navbar-nav .sub-menu li a:hover {
      background: #f5f5f5;
      color: #007bff;
    }

    /* Icon mũi tên */
    .menu-item-has-children > a::after {
      content: "";
      display: inline-block;
      width: 24px;
      height: 24px;
      margin-left: 6px;
      vertical-align: middle;
      background: url('data:image/svg+xml;utf8,<svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M7 10L12 15L17 10" stroke="%2300a0e9" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"/></svg>')
        no-repeat center center;
      background-size: 24px 24px;
      transition: transform 0.3s cubic-bezier(0.4, 0, 0.2, 1);
      transform: rotate(0deg);
    }
    .menu-item-has-children:hover > a::after,
    .menu-item-has-children:focus-within > a::after {
      transform: rotate(180deg);
    }

    /* Mobile */
    .navbar-collapse {
      background-color: #fff;
    }

    @media (max-width: 991px) {
      .navbar-nav {
        margin: 0;
        padding: 0;
      }
      .navbar-nav > li {
        border-bottom: 1px solid #e6eaf0;
        list-style: none;
      }
      .navbar-nav > li > a {
        display: inline-block;
        width: calc(100% - 32px);
        padding: 20px 0;
        color: #212121;
        font-size: 21px;
        font-weight: 500;
      }
      .mobile-menu-arrow {
        display: inline-block;
        width: 22px;
        height: 22px;
        margin-left: 8px;
        cursor: pointer;
        vertical-align: middle;
        background: url('data:image/svg+xml;utf8,<svg width="22" height="22" viewBox="0 0 22 22" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M8 6L14 11L8 16" stroke="%2326AAE1" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"/></svg>')
          no-repeat center center;
        background-size: 22px 22px;
        transition: transform 0.3s;
      }
      .mobile-menu-arrow.open {
        transform: rotate(180deg);
      }
      .navbar-nav .sub-menu {
        display: none;
        background: #fff;
        border-radius: 12px;
        box-shadow: 0 6px 24px -8px rgba(0, 0, 0, 0.12);
        margin: 0 0 14px 0;
        animation: dropDownFadeIn 0.22s;
        position: static;
      }
      .navbar-nav .sub-menu.active {
        display: block;
      }
      .navbar-nav .sub-menu li {
        border: none;
      }
      .navbar-nav .sub-menu li a {
        font-size: 18px;
        color: #222;
        font-weight: 500;
        display: block;
        border-radius: 8px;
      }
      .navbar-nav .sub-menu li a:hover {
        background: #f5f5f5;
        color: #26aae1;
      }
      @keyframes dropDownFadeIn {
        from {
          opacity: 0;
          transform: translateY(-12px);
        }
        to {
          opacity: 1;
          transform: translateY(0);
        }
      }
      .menu-item-has-children > a::after {
        content: none !important;
      }
      .navbar-toggler {
        border: none !important;
        background: transparent !important;
        box-shadow: none !important;
        outline: none !important;
        padding: 0.375rem 0.75rem;
      }
      .navbar-toggler-icon {
        background-image: url("data:image/svg+xml;utf8,<svg viewBox='0 0 30 30' xmlns='http://www.w3.org/2000/svg'><path stroke='black' stroke-width='2' stroke-linecap='round' stroke-miterlimit='10' d='M4 7h22M4 15h22M4 23h22'/></svg>");
      }
      .navbar .container-fluid {
        display: flex;
        justify-content: space-between;
        align-items: center;
        padding-left: 0 !important;
        padding-right: 0 !important;
      }
      nav.navbar.navbar-expand-lg.navbar-light {
        margin: 0;
      }
      .menu-item-has-children .sub-menu li,
      .navbar-nav .sub-menu li {
        display: block;
        border-bottom: 1px solid #e6eaf0;
      }
    }

    @media (max-width: 1200px) and (min-width: 992px) {
      #mainMenu > ul.navbar-nav {
        font-size: 14px;
        gap: 16px;
      }
      .navbar-nav > li > a {
        font-size: 15px;
        padding: 10px 0;
      }
    }

    /* --- FIX 1: bỏ chiều cao cố định để menu có thể bung --- */
    header.container.py-3,
    header.container-fluid.bg-white,
    header.container-fluid.bg-white.w-auto {
      height: auto !important; /* thay vì 50px/71px */
    }

    /* Giữ header trên cùng, nhưng thống nhất position */
    header.container.py-3,
    header.container-fluid.bg-white {
      position: fixed; /* hoặc sticky nếu bạn muốn */
      top: 0;
      left: 0;
      right: 0;
      z-index: 9999;
    }

    /* Khoảng đệm nội dung để không bị header che (tuỳ chỉnh min-height header) */
    body {
      padding-top: 72px;
    } /* điều chỉnh đúng chiều cao thực tế header của bạn */

    /* --- FIX 2: đảm bảo collapse của Bootstrap hoạt động --- */
    .navbar-collapse.collapse {
      display: none;
    }
    .navbar-collapse.collapse.show {
      display: block;
    }

    /* Trên mobile, để khối menu chiếm full width bên dưới thanh header */
    @media (max-width: 991px) {
      header .navbar-collapse {
        position: fixed;
        top: 71px; /* đúng chiều cao thanh top của bạn */
        left: 0;
        right: 0;
        max-height: calc(100dvh - 71px);
        overflow: auto;
        background: #fff;
      }
    }

    @media (max-width: 991px) {
      .menu-item-has-children .sub-menu,
      .menu-item-has-children:focus-within .sub-menu {
        opacity: 1 !important;
        pointer-events: auto !important;
        transform: none !important;
        /* Nhưng không nên dùng hover trên mobile */
      }

      #mainMenu > ul.navbar-nav {
        float: left;
        align-items: start !important;
        justify-content: start !important;
        margin: 10px 10px !important;
      }
    }
    /* ========= MOBILE: flatten submenu & hide carets ========= */
@media (max-width: 991.98px) {

  /* 1) Ẩn mọi mũi tên/caret */
  .menu-item-has-children > a::after,
  .dropdown-toggle::after,
  .mobile-menu-arrow,
  .menu-item-has-children > a > .menu-caret,
  .menu-item-has-children > a > .arrow,
  .menu-item-has-children > a > svg {
    display: none !important;
    content: none !important;
  }

  /* 2) Submenu luôn hiện & đặt tĩnh (không box, không bóng) */
  .navbar-nav .menu-item-has-children > .sub-menu {
    display: block !important;
    position: static !important;
    opacity: 1 !important;
    transform: none !important;
    pointer-events: auto !important;
    margin: 0 !important;
    padding: 0 !important;
    background: transparent !important;
    box-shadow: none !important;
    border-radius: 0 !important;
  }

  .navbar-nav > li > a,
  .navbar-nav .sub-menu > li > a {
    display: block;
    width: 100%;
    font-size: 18px;     /* cùng cỡ với mục cha */
    font-weight: 500;
    color: #212121;
    text-decoration: none;
  }

  /* Bỏ mọi thụt lề/định dạng cấp sâu */
  .navbar-nav .sub-menu > li > a,
  .navbar-nav .sub-menu .sub-menu > li > a {
    padding-left: 0 !important;
  }
  .navbar-nav .sub-menu .sub-menu {
    margin: 0 !important;
    padding: 0 !important;
  }
}

    .banner-slider {
      position: relative;
      width: 100%;
      height: 900px; /* chỉnh theo ý bạn */
      overflow: hidden;
    }
    .banner-slider .slide {
      position: absolute;
      top: 0;
      left: 100%;
      width: 100%;
      height: 100%;
      opacity: 0;
      transition: all 1s ease-in-out; /* hiệu ứng mượt */
      display: flex;
      justify-content: center;
      align-items: flex-start; /* 👈 thay vì center */
    }
    .banner-slider .slide.active {
      left: 0;
      opacity: 1;
      z-index: 1;
    }
    .banner-slider img {
      width: 100%;
      height: auto;
    }

    @media (max-width: 1110px) {
      .slide img {
        width: 100%;
      }
      .banner-slider {
        height: 55vw; /* chiều cao bằng 55% chiều rộng */
      }
      .slide.active {
        height: 55vw;
      }
    }

    @media (max-width: 900px) {
      .slide img {
        width: 100%;
      }
      .banner-slider {
        height: 55vw; /* chiều cao bằng 55% chiều rộng */
      }
      .slide.active {
        height: 55vw;
      }
    }
    @media (max-width: 600px) {
      .slide img {
        width: 140%;
        height: 70vw;
      }
    }

  </style>
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
