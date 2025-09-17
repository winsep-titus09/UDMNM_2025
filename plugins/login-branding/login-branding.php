<?php
/**
 * Plugin Name: Login Branding
 * Description: Cho phép đổi logo trang đăng nhập, kích thước, link, title và JPEG quality qua trang cài đặt (không cần sửa code).
 * Version:     1.0.0
 * Author:      Your Name
 * Text Domain: login-branding
 */

if (!defined('ABSPATH')) exit;

final class LB_Login_Branding {
    const OPTION = 'lb_login_branding_opts';

    public function __construct() {
        // Hook hiển thị ngoài trang login
        add_action('login_enqueue_scripts', [$this, 'output_login_css']);
        add_filter('login_headerurl',       [$this, 'login_header_url']);
        add_filter('login_headertext',      [$this, 'login_header_text']);
        add_filter('jpeg_quality',          [$this, 'jpeg_quality']);

        // Admin settings UI
        add_action('admin_menu',            [$this, 'add_settings_page']);
        add_action('admin_init',            [$this, 'register_settings']);
        add_action('admin_enqueue_scripts', [$this, 'enqueue_admin_assets']);
    }

    /** ========== Helpers ========== */

    public static function defaults() : array {
        return [
            'logo_url'     => '',                 // đường dẫn ảnh logo (Media)
            'logo_width'   => 200,               // px
            'logo_height'  => 80,                // px
            'link_url'     => home_url('/'),     // khi bấm vào logo
            'title_text'   => get_bloginfo('name'),
            'jpeg_quality' => 80,                // 10..100
        ];
    }

    public static function opts() : array {
        $opts = get_option(self::OPTION, []);
        return wp_parse_args((array) $opts, self::defaults());
    }

    /** ========== FRONT: apply branding on login page ========== */

    public function output_login_css() {
        $o = self::opts();

        $logo = esc_url($o['logo_url']);
        $w    = max(1, (int) $o['logo_width']);
        $h    = max(1, (int) $o['logo_height']);

        // Nếu chưa chọn logo, không chèn CSS (trang login dùng logo WP mặc định)
        if (!$logo) return;

        $css = sprintf(
            '.login h1 a{background-image:url("%1$s")!important;background-size:contain!important;background-repeat:no-repeat;background-position:center center;width:%2$dpx!important;height:%3$dpx!important;display:block!important}
             .login form{border-radius:8px}',
            $logo, $w, $h
        );

        // WordPress có handle 'login' sẵn, ta thêm inline CSS vào
        wp_add_inline_style('login', $css);
    }

    public function login_header_url($url) {
        $o = self::opts();
        return $o['link_url'] ? esc_url($o['link_url']) : home_url('/');
    }

    public function login_header_text($text) {
        $o = self::opts();
        return $o['title_text'] ? wp_kses_post($o['title_text']) : get_bloginfo('name');
    }

    public function jpeg_quality($q) {
        $o = self::opts();
        $val = (int) $o['jpeg_quality'];
        if ($val >= 10 && $val <= 100) return $val;
        return 80;
    }

    /** ========== ADMIN: settings page ========== */

    public function add_settings_page() {
        add_options_page(
            __('Login Branding', 'login-branding'),
            __('Login Branding', 'login-branding'),
            'manage_options',
            'login-branding',
            [$this, 'render_settings_page']
        );
    }

    public function register_settings() {
        register_setting(
            'lb_login_branding_group',
            self::OPTION,
            ['sanitize_callback' => [$this, 'sanitize_options']]
        );

        add_settings_section(
            'lb_section_main',
            __('Login Page Logo & Behavior', 'login-branding'),
            function () {
                echo '<p>'.esc_html__('Chọn logo, kích thước, link và title cho trang đăng nhập. Bạn cũng có thể chỉnh JPEG quality toàn site.', 'login-branding').'</p>';
            },
            'login-branding'
        );

        // Logo URL
        add_settings_field('logo_url', __('Logo image', 'login-branding'), function () {
            $o = self::opts();
            ?>
            <div style="display:flex; gap:12px; align-items:center;">
                <input id="lb_logo_url" name="<?php echo esc_attr(self::OPTION); ?>[logo_url]" type="text" value="<?php echo esc_attr($o['logo_url']); ?>" class="regular-text" placeholder="https://.../logo.svg or .png">
                <button type="button" class="button" id="lb_pick_logo"><?php esc_html_e('Choose from Media', 'login-branding'); ?></button>
            </div>
            <p class="description"><?php esc_html_e('Nên dùng SVG hoặc PNG nền trong suốt.', 'login-branding'); ?></p>
            <div id="lb_logo_preview" style="margin-top:8px;">
                <?php if (!empty($o['logo_url'])): ?>
                    <img src="<?php echo esc_url($o['logo_url']); ?>" alt="" style="max-width:260px;height:auto;border:1px solid #ddd;padding:6px;background:#fff;border-radius:4px">
                <?php endif; ?>
            </div>
            <?php
        }, 'login-branding', 'lb_section_main');

        // Width
        add_settings_field('logo_width', __('Logo width (px)', 'login-branding'), function () {
            $o = self::opts();
            printf(
                '<input name="%1$s[logo_width]" type="number" min="1" step="1" value="%2$d" class="small-text"> px',
                esc_attr(self::OPTION),
                (int) $o['logo_width']
            );
        }, 'login-branding', 'lb_section_main');

        // Height
        add_settings_field('logo_height', __('Logo height (px)', 'login-branding'), function () {
            $o = self::opts();
            printf(
                '<input name="%1$s[logo_height]" type="number" min="1" step="1" value="%2$d" class="small-text"> px',
                esc_attr(self::OPTION),
                (int) $o['logo_height']
            );
        }, 'login-branding', 'lb_section_main');

        // Link URL
        add_settings_field('link_url', __('Logo link URL', 'login-branding'), function () {
            $o = self::opts();
            printf(
                '<input name="%1$s[link_url]" type="url" value="%2$s" class="regular-text" placeholder="%3$s">',
                esc_attr(self::OPTION),
                esc_attr($o['link_url']),
                esc_attr(home_url('/'))
            );
        }, 'login-branding', 'lb_section_main');

        // Title text
        add_settings_field('title_text', __('Logo title (tooltip)', 'login-branding'), function () {
            $o = self::opts();
            printf(
                '<input name="%1$s[title_text]" type="text" value="%2$s" class="regular-text" placeholder="%3$s">',
                esc_attr(self::OPTION),
                esc_attr($o['title_text']),
                esc_attr(get_bloginfo('name'))
            );
        }, 'login-branding', 'lb_section_main');

        // JPEG quality
        add_settings_field('jpeg_quality', __('JPEG quality (10–100)', 'login-branding'), function () {
            $o = self::opts();
            printf(
                '<input name="%1$s[jpeg_quality]" type="number" min="10" max="100" step="1" value="%2$d" class="small-text"> %%', // percent sign escaped later by HTML
                esc_attr(self::OPTION),
                (int) $o['jpeg_quality']
            );
            echo '<p class="description">'.esc_html__('Áp dụng khi WordPress nén ảnh JPEG (ảnh tải lên sau khi đổi).', 'login-branding').'</p>';
        }, 'login-branding', 'lb_section_main');
    }

    public function sanitize_options($input) {
        $out = self::defaults();

        $out['logo_url']     = isset($input['logo_url']) ? esc_url_raw($input['logo_url']) : '';
        $out['logo_width']   = isset($input['logo_width']) ? max(1, (int) $input['logo_width']) : $out['logo_width'];
        $out['logo_height']  = isset($input['logo_height']) ? max(1, (int) $input['logo_height']) : $out['logo_height'];
        $out['link_url']     = isset($input['link_url']) ? esc_url_raw($input['link_url']) : $out['link_url'];
        $out['title_text']   = isset($input['title_text']) ? wp_kses_post($input['title_text']) : $out['title_text'];
        $out['jpeg_quality'] = isset($input['jpeg_quality']) ? (int) $input['jpeg_quality'] : $out['jpeg_quality'];
        if ($out['jpeg_quality'] < 10 || $out['jpeg_quality'] > 100) $out['jpeg_quality'] = 80;

        return $out;
    }

    public function render_settings_page() {
        if (!current_user_can('manage_options')) return;

        echo '<div class="wrap"><h1>'.esc_html__('Login Branding', 'login-branding').'</h1>';
        echo '<form method="post" action="options.php">';
        settings_fields('lb_login_branding_group');
        do_settings_sections('login-branding');
        submit_button();
        echo '</form></div>';
    }

    public function enqueue_admin_assets($hook) {
        if ($hook !== 'settings_page_login-branding') return;

        // Media uploader
        wp_enqueue_media();

        // Inline JS nhỏ để mở Media Frame, set input & preview
        $js = <<<JS
(function(){
  document.addEventListener('DOMContentLoaded', function(){
    var pickBtn = document.getElementById('lb_pick_logo');
    var input   = document.getElementById('lb_logo_url');
    var preview = document.getElementById('lb_logo_preview');

    if(!pickBtn || !input) return;

    pickBtn.addEventListener('click', function(e){
      e.preventDefault();
      var frame = wp.media({
        title: 'Choose Logo',
        button: { text: 'Use this logo' },
        multiple: false
      });
      frame.on('select', function(){
        var att = frame.state().get('selection').first().toJSON();
        input.value = att.url || '';
        if (preview) {
          preview.innerHTML = input.value ? '<img src="'+ input.value +'" alt="" style="max-width:260px;height:auto;border:1px solid #ddd;padding:6px;background:#fff;border-radius:4px">' : '';
        }
      });
      frame.open();
    });
  });
})();
JS;
        wp_add_inline_script('jquery-core', $js); // nương theo handle có sẵn
    }
}

new LB_Login_Branding();
