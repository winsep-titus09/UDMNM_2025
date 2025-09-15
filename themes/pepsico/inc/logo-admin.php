<?php
add_filter('jpeg_quality', fn() => 80);
add_action('login_enqueue_scripts', function () {
  echo '<style>.login h1 a{background-image:url("'.esc_url(get_template_directory_uri().'/images/logo-pepsico.svg').'")!important;background-size:contain!important;width:200px!important;height:80px!important;display:block!important}</style>';
});