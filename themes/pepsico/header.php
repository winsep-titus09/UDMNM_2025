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
    /* ====== BASE ====== */
      html, body{
        background:#f2f9f9;
        overflow-x:hidden;
        font-family:"Montserrat", Arial, sans-serif;
        scroll-behavior:smooth;
      }

      /* ====== HEADER (fixed) ====== */
      header.container.py-3,
      header.container-fluid.bg-white{
        position:fixed; top:0; left:0; right:0;
        z-index:9999; background:#fff;
        box-shadow:0 4px 16px rgba(38,38,38,.28);
        height:auto !important; /* bỏ mọi height cố định */
      }
      header.container.py-3{ box-shadow:0 4px 16px rgba(38,170,225,.15); }
      body{ padding-top:72px; } /* chỉnh theo chiều cao header thực tế */

      .row.align-items-center{ margin:0 100px; padding:15px 0; }
      nav.navbar.navbar-expand-lg.navbar-light{ margin:0 100px; }
      img.custom-logo{ width:110px; height:45px; }

      /* ====== MAIN MENU (desktop default) ====== */
      #mainMenu > ul.navbar-nav{
        margin:0 auto !important; display:flex !important;
        justify-content:center !important; align-items:center !important;
        gap:10px; width:auto; font-weight:500; font-size:16px; letter-spacing:.02em;
        list-style:none; padding:0; -webkit-text-stroke:.5px #000;
      }
      ul#menu-pepsico_menu{
        display:flex; justify-content:space-between; align-items:center;
        flex-wrap:nowrap; list-style:none; margin:0; padding:0; white-space:nowrap;
      }
      a{ text-decoration:none; }

      .navbar-nav li, .menu-item-has-children{ position:relative; }

      .navbar-nav li { margin:0 8px; }
      /* Link color + hover */
      .navbar-nav > li > a,
      .menu-item > a,
      .navbar-collapse .navbar-nav .nav-link{
        color:#000; transition:color .25s;
      }
      .navbar-nav > li > a:hover,
      .menu-item > a:hover,
      .menu-item.current-menu-item > a,
      .menu-item.current_page_item > a,
      .navbar-collapse .navbar-nav .nav-link:hover{
        color:#26aae1; -webkit-text-stroke:.5px #26aae1;
      }

      /* ====== DROPDOWN (desktop) ====== */
      @media (min-width: 992px){
        .navbar-nav .sub-menu{
          position:absolute; left:0; top:100%; margin-top:23px;
          min-width:200px; padding:10px 0; background:#fff;
          border-radius:0 0 12px 12px;
          box-shadow:0 8px 24px -8px rgba(0,0,0,.28),
                    -4px 0 12px -8px rgba(0,0,0,.18),
                      4px 0 12px -8px rgba(0,0,0,.18);
          z-index:1000; opacity:0; pointer-events:none;
          transform:translateY(20px);
          transition:opacity .35s cubic-bezier(.4,0,.2,1),
                    transform .35s cubic-bezier(.4,0,.2,1);
        }
        .menu-item-has-children:hover > .sub-menu,
        .menu-item-has-children:focus-within > .sub-menu,
        .navbar-nav li:hover > .sub-menu{
          opacity:1; pointer-events:auto; transform:translateY(0);
        }
        .menu-item-has-children > a::after{
          content:""; display:inline-block; width:24px; height:24px; margin-left:6px; vertical-align:middle;
          background:url('data:image/svg+xml;utf8,<svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M7 10L12 15L17 10" stroke="%2300a0e9" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"/></svg>') no-repeat center/24px 24px;
          transition:transform .3s cubic-bezier(.4,0,.2,1);
        }
        .menu-item-has-children:hover > a::after,
        .menu-item-has-children:focus-within > a::after{ transform:rotate(180deg); }

        .navbar-nav .sub-menu li{
          display:block; padding:20px 0; border-bottom:1px solid #e6eaf0;
        }
        .navbar-nav .sub-menu li a{ color:#333; display:block; }
        .navbar-nav .sub-menu li a:hover{ background:#f5f5f5; color:#007bff; }
      }

      /* ====== MOBILE (<=991.98px) ====== */
      @media (max-width: 991.98px){
        .navbar .container-fluid{
          display:flex; justify-content:space-between; align-items:center;
          padding-left:0 !important; padding-right:0 !important;
        }
        nav.navbar.navbar-expand-lg.navbar-light{ margin:0; }

        /* Collapse panel full-width dưới header */
        header .navbar-collapse{
          position:fixed; top:71px; left:0; right:0;
          max-height:calc(100dvh - 71px); overflow:auto; background:#fff;
        }

        /* Item cha */
        .navbar-nav{ margin:0; padding:0; }
        .navbar-nav > li{
          list-style:none; border-bottom:1px solid #e6eaf0; width:100%;
        }
        .navbar-nav > li > a{
          display:block; width:100%; padding:20px 10px;
          color:#212121; font-size:21px; font-weight:500;
        }

        /* Ẩn mọi caret/mũi tên */
        .menu-item-has-children > a::after,
        .dropdown-toggle::after,
        .mobile-menu-arrow,
        .menu-item-has-children > a > .menu-caret,
        .menu-item-has-children > a > .arrow,
        .menu-item-has-children > a > svg{ display:none !important; content:none !important; }

        /* Submenu: phẳng, cùng kích cỡ với cha */
        .navbar-nav .menu-item-has-children > .sub-menu{
          display:block !important; position:static !important;
          opacity:1 !important; transform:none !important; pointer-events:auto !important;
          margin:0 !important; padding:0 !important; background:transparent !important;
          box-shadow:none !important; border-radius:0 !important;
        }
        .navbar-nav .sub-menu > li{ border-bottom:1px solid #e6eaf0; width:100%; }
        .navbar-nav .sub-menu > li > a,
        .navbar-nav .sub-menu .sub-menu > li > a{
          display:block; width:100%; padding:20px 0px; /* giống cha */
          font-size:21px; font-weight:500; color:#212121; border-radius:0;
        }
      }

      /* ====== TWEAK tablet (992–1200) ====== */
      @media (min-width: 992px) and (max-width: 1200px){
        #mainMenu > ul.navbar-nav{ font-size:14px; gap:16px; }
        .navbar-nav > li > a{ font-size:15px; padding:10px 0; }
      }

      /* ====== SLIDER ====== */
      .banner-slider{ position:relative; width:100%; height:900px; overflow:hidden; }
      .banner-slider .slide{
        position:absolute; inset:0 auto auto 100%;
        width:100%; height:100%; opacity:0;
        transition:all 1s ease-in-out;
        display:flex; justify-content:center; align-items:flex-start;
      }
      .banner-slider .slide.active{ left:0; opacity:1; z-index:1; }
      .banner-slider img{ width:100%; height:auto; }

      /* Responsive chiều cao slider */
      @media (max-width:1110px){
        .banner-slider, .banner-slider .slide.active{ height:55vw; }
      }
      @media (max-width:600px){
        .banner-slider .slide img{ width:140%; height:70vw; }
      }

      /* Nút menu (hamburger) không viền ở mọi trạng thái */
      .navbar-toggler,
      .navbar-toggler:hover,
      .navbar-toggler:focus,
      .navbar-toggler:active,
      .navbar-toggler:focus-visible,
      .navbar-toggler[aria-expanded="true"] {
        border: 0 !important;
        outline: 0 !important;
        box-shadow: none !important;
        background: transparent !important;
      }

      /* Icon cũng không bị viền/nháy */
      .navbar-toggler-icon {
        outline: 0 !important;
        box-shadow: none !important;
      }

      /* Trên mobile xoá hiệu ứng chạm xanh của trình duyệt */
      @media (hover: none) {
        .navbar-toggler { -webkit-tap-highlight-color: transparent; }
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
