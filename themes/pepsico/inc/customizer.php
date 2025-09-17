<?php
// Footer Logo Customizer
function pepsico_customize_footer_logo($wp_customize) {
    $wp_customize->add_section('footer_logo_section', [
        'title'    => __('Footer Logo', 'pepsico'),
        'priority' => 30,
    ]);

    $wp_customize->add_setting('footer_logo');
    $wp_customize->add_control(new WP_Customize_Image_Control(
        $wp_customize,
        'footer_logo',
        [
            'label'    => __('Footer Logo', 'pepsico'),
            'section'  => 'footer_logo_section',
            'settings' => 'footer_logo',
        ]
    ));
}
add_action('customize_register', 'pepsico_customize_footer_logo');

// loco tanslation  
add_action('after_setup_theme', function () {
  load_theme_textdomain('pepsico-theme', get_template_directory() . '/languages');
});

// polylang
// Floating Polylang language switcher (right-center)
add_action('wp_footer', function () {
    if (is_admin() || wp_doing_ajax()) return;
    if (!function_exists('pll_the_languages')) return;

    // Lấy dữ liệu ngôn ngữ thô để tự build HTML
    $langs = pll_the_languages([
        'raw'                     => 1,
        'hide_if_no_translation'  => 0,  // đổi thành 1 nếu muốn ẩn khi không có bản dịch
        'hide_current'            => 0,  // đổi thành 1 nếu muốn ẩn ngôn ngữ hiện tại
    ]);

    if (empty($langs) || !is_array($langs)) return;

    echo '<nav class="float-lang" aria-label="Language switcher">';
    foreach ($langs as $l) {
        $is_current = !empty($l['current_lang']);
        $classes = 'float-lang__item' . ($is_current ? ' is-active' : '');
        // Dùng mã slug (vi / en) làm nhãn. Bạn có thể đổi thành $l['name'] nếu muốn tên đầy đủ.
        $label = strtoupper($l['slug']);
        printf(
            '<a href="%s" class="%s" lang="%s" hreflang="%s" rel="nofollow">%s</a>',
            esc_url($l['url']),
            esc_attr($classes),
            esc_attr($l['slug']),
            esc_attr($l['slug']),
            esc_html($label)
        );
    }
    echo '</nav>';
}, 20);
