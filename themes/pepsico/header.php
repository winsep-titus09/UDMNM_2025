<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
  <meta charset="<?php bloginfo('charset'); ?>">
  <meta name="viewport" content="width=device-width, initial-scale=1">
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
      height:auto !important;
    }
    header.container.py-3{ box-shadow:0 4px 16px rgba(38,170,225,.15); }
    body{ padding-top:72px; }

    .row.align-items-center{ margin:0 100px; padding:15px 0; }
    nav.navbar.navbar-expand-lg.navbar-light{ margin:0 100px; }
    img.custom-logo{ width:110px; height:45px; }

    /* ====== MAIN MENU (desktop default) ====== */
    #mainMenu > ul.navbar-nav{
      margin:0 auto !important; display:flex !important;
      justify-content:center !important; align-items:center !important;
      gap:10px; width:auto; font-weight:500; font-size:16px; letter-spacing:.02em;
      list-style:none !important; padding:0; -webkit-text-stroke:.5px #000;
    }
    ul#menu-pepsico_menu{
      display:flex; justify-content:space-between; align-items:center;
      flex-wrap:nowrap; list-style:none; margin:0; padding:0; white-space:nowrap;
    }
    a{ text-decoration:none; }

    .navbar-nav li,
    .menu-item-has-children{ position:relative; overflow:visible; }

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
      #mainMenu{ display:flex !important; }            /* luôn hiện trên desktop */
      .navbar-nav .sub-menu{
        position:absolute; left:0; top:100%;
        margin-top:23px; /* giữ khoảng cách thị giác */
        min-width:200px; padding:10px 0; background:#fff;
        border-radius:0 0 12px 12px;
        box-shadow:0 8px 24px -8px rgba(0,0,0,.28),
                   -4px 0 12px -8px rgba(0,0,0,.18),
                    4px 0 12px -8px rgba(0,0,0,.18);
        z-index:1000; opacity:0; pointer-events:none;
        transform:translateY(10px);
        transition:opacity .35s cubic-bezier(.4,0,.2,1),
                   transform .35s cubic-bezier(.4,0,.2,1);
      }

      /* Cầu nối chống tụt hover: phủ đúng chiều cao margin-top */
      .menu-item-has-children:hover::after{
        content:"";
        position:absolute;
        left:0; right:0;
        top:100%;
        height:23px;         /* = margin-top của .sub-menu */
        background:transparent;
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
      /* Ẩn hoàn toàn menu desktop; dùng offcanvas */
      #mainMenu{ display:none !important; }

      .navbar .container-fluid{
        display:flex; justify-content:space-between; align-items:center;
        padding-left:0 !important; padding-right:0 !important;
      }
      nav.navbar.navbar-expand-lg.navbar-light{ margin:0; }
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
    .navbar-toggler-icon { outline:0 !important; box-shadow:none !important; }
    @media (hover:none){ .navbar-toggler{ -webkit-tap-highlight-color:transparent; } }

    /* ==== OFFCANVAS MOBILE ==== */
    @media (max-width: 991.98px){
      .offcanvas.offcanvas-end{ width:100vw; max-width:100vw; }
      .offcanvas-header{ border-bottom:1px solid #e6eaf0; }
      .offcanvas-body .navbar-nav{ margin:0; padding:0; }
      .offcanvas-body .navbar-nav > li{
        list-style:none !important; border-bottom:1px solid #e6eaf0; width:100%;
      }
      .offcanvas-body .navbar-nav > li > a{
        display:block; width:100%; padding:20px 10px;
        color:#212121; font-size:21px; font-weight:500;
      }
      .offcanvas-body .menu-item-has-children > a::after,
      .offcanvas-body .dropdown-toggle::after,
      .offcanvas-body .menu-item-has-children > a > .menu-caret,
      .offcanvas-body .menu-item-has-children > a > .arrow,
      .offcanvas-body .menu-item-has-children > a > svg{
        display:none !important; content:none !important;
      }
      .offcanvas-body .menu-item-has-children > .sub-menu{
        display:block !important; position:static !important;
        opacity:1 !important; transform:none !important; pointer-events:auto !important;
        margin:0 !important; padding:0 !important; background:transparent !important;
        box-shadow:none !important; border-radius:0 !important;
      }
      .offcanvas-body .sub-menu > li{ border-bottom:1px solid #e6eaf0; width:100%; list-style:none !important; }
      .offcanvas-body .sub-menu > li > a{
        display:block; width:100%; padding:20px 0px; font-size:21px; font-weight:500; color:#212121;
      }
    }
  </style>
</head>
<body <?php body_class(); ?>>

<?php if (function_exists('wp_body_open')) { wp_body_open(); } ?>

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
          <h5 class="offcanvas-title" id="mobileMenuLabel"><?php bloginfo('name'); ?></h5>
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
