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
