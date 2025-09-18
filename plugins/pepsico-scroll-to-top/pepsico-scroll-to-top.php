<?php
/**
 * Plugin Name: Pepsico Scroll To Top
 * Description: Nút tròn “lên đầu trang” có hiệu ứng mượt, tối ưu accessibility, tùy chỉnh màu/sizes/vị trí. Hợp Loco/Polylang.
 * Version: 1.0.0
 * Author: Your Name
 * Text Domain: pepsico-scroll-top
 * Domain Path: /languages
 */

if (!defined('ABSPATH')) { exit; }

// ===== i18n =====
add_action('plugins_loaded', function(){
  load_plugin_textdomain('pepsico-scroll-top', false, dirname(plugin_basename(__FILE__)) . '/languages');
});

// ===== Defaults & Options =====
function pstt_defaults(){
  return [
    'bg'          => '#26AAE1',   // màu nền nút
    'icon'        => '#ffffff',   // màu mũi tên
    'size'        => 56,          // px, đường kính
    'bottom'      => 24,          // khoảng cách đáy px
    'right'       => 24,          // khoảng cách phải px
    'radius'      => 9999,        // bo tròn
    'shadow'      => 1,           // 0/1 đổ bóng
    'show_after'  => 300,         // px cuộn sẽ hiện
    'hide_mobile' => 0,           // 0/1 ẩn trên mobile (<576px)
  ];
}

register_activation_hook(__FILE__, function(){
  if (!is_array(get_option('pstt_options'))) update_option('pstt_options', pstt_defaults());
});

function pstt_get_option($key){
  $opt = get_option('pstt_options');
  $def = pstt_defaults();
  return is_array($opt) && array_key_exists($key, $opt) ? $opt[$key] : ($def[$key] ?? '');
}

// ===== Settings Page =====
add_action('admin_menu', function(){
  add_options_page(
    __('Scroll To Top', 'pepsico-scroll-top'),
    __('Scroll To Top', 'pepsico-scroll-top'),
    'manage_options',
    'pstt-settings',
    'pstt_render_settings_page'
  );
});

add_action('admin_init', function(){
  register_setting('pstt_settings_group', 'pstt_options', [
    'type' => 'array',
    'sanitize_callback' => 'pstt_sanitize',
    'default' => pstt_defaults(),
  ]);
});

function pstt_sanitize($in){
  $d = pstt_defaults();
  $out = $d;
  $out['bg']         = sanitize_hex_color($in['bg'] ?? $d['bg']);
  $out['icon']       = sanitize_hex_color($in['icon'] ?? $d['icon']);
  $out['size']       = max(36, intval($in['size'] ?? $d['size']));
  $out['bottom']     = max(0, intval($in['bottom'] ?? $d['bottom']));
  $out['right']      = max(0, intval($in['right'] ?? $d['right']));
  $out['radius']     = max(0, intval($in['radius'] ?? $d['radius']));
  $out['shadow']     = !empty($in['shadow']) ? 1 : 0;
  $out['show_after'] = max(0, intval($in['show_after'] ?? $d['show_after']));
  $out['hide_mobile']= !empty($in['hide_mobile']) ? 1 : 0;
  return $out;
}

function pstt_render_settings_page(){
  if (!current_user_can('manage_options')) return;
  $o = get_option('pstt_options', pstt_defaults());
  ?>
  <div class="wrap">
    <h1><?php echo esc_html__('Scroll To Top', 'pepsico-scroll-top'); ?></h1>
    <form method="post" action="options.php">
      <?php settings_fields('pstt_settings_group'); ?>
      <table class="form-table" role="presentation">
        <tbody>
          <tr>
            <th scope="row"><?php _e('Màu nền', 'pepsico-scroll-top'); ?></th>
            <td>
              <input type="text" name="pstt_options[bg]" value="<?php echo esc_attr($o['bg']); ?>" class="regular-text" />
              <p class="description">HEX, ví dụ: #26AAE1</p>
            </td>
          </tr>
          <tr>
            <th scope="row"><?php _e('Màu biểu tượng', 'pepsico-scroll-top'); ?></th>
            <td>
              <input type="text" name="pstt_options[icon]" value="<?php echo esc_attr($o['icon']); ?>" class="regular-text" />
              <p class="description">HEX, ví dụ: #ffffff</p>
            </td>
          </tr>
          <tr>
            <th scope="row"><?php _e('Kích thước nút (px)', 'pepsico-scroll-top'); ?></th>
            <td>
              <input type="number" name="pstt_options[size]" value="<?php echo esc_attr($o['size']); ?>" min="36" step="1" />
            </td>
          </tr>
          <tr>
            <th scope="row"><?php _e('Cách đáy (px)', 'pepsico-scroll-top'); ?></th>
            <td><input type="number" name="pstt_options[bottom]" value="<?php echo esc_attr($o['bottom']); ?>" min="0" step="1" /></td>
          </tr>
          <tr>
            <th scope="row"><?php _e('Cách phải (px)', 'pepsico-scroll-top'); ?></th>
            <td><input type="number" name="pstt_options[right]" value="<?php echo esc_attr($o['right']); ?>" min="0" step="1" /></td>
          </tr>
          <tr>
            <th scope="row"><?php _e('Bo góc (px)', 'pepsico-scroll-top'); ?></th>
            <td><input type="number" name="pstt_options[radius]" value="<?php echo esc_attr($o['radius']); ?>" min="0" step="1" /></td>
          </tr>
          <tr>
            <th scope="row"><?php _e('Đổ bóng', 'pepsico-scroll-top'); ?></th>
            <td><label><input type="checkbox" name="pstt_options[shadow]" value="1" <?php checked($o['shadow'],1); ?>> <?php _e('Bật', 'pepsico-scroll-top'); ?></label></td>
          </tr>
          <tr>
            <th scope="row"><?php _e('Hiện sau khi cuộn (px)', 'pepsico-scroll-top'); ?></th>
            <td><input type="number" name="pstt_options[show_after]" value="<?php echo esc_attr($o['show_after']); ?>" min="0" step="50" /></td>
          </tr>
          <tr>
            <th scope="row"><?php _e('Ẩn trên mobile (<576px)', 'pepsico-scroll-top'); ?></th>
            <td><label><input type="checkbox" name="pstt_options[hide_mobile]" value="1" <?php checked($o['hide_mobile'],1); ?>> <?php _e('Ẩn', 'pepsico-scroll-top'); ?></label></td>
          </tr>
        </tbody>
      </table>
      <?php submit_button(); ?>
    </form>
  </div>
  <?php
}

// ===== Frontend output =====
add_action('wp_footer', function(){
  echo "<button class=\"pstt-btn\" aria-label=\"" . esc_attr__('Lên đầu trang','pepsico-scroll-top') . "\" title=\"" . esc_attr__('Lên đầu trang','pepsico-scroll-top') . "\" type=\"button\">".
       "<svg class=\"pstt-icon\" viewBox=\"0 0 24 24\" aria-hidden=\"true\" focusable=\"false\">".
         // Mũi tên hướng lên dạng thân + đầu tên: fill theo currentColor
         "<path fill=\"currentColor\" d=\"M12 6l-5 5h3v6h4v-6h3l-5-5z\"/>".
       "</svg>".
     "</button>";
});

add_action('wp_enqueue_scripts', function(){
  $bg     = pstt_get_option('bg');
  $icon   = pstt_get_option('icon');
  $size   = intval(pstt_get_option('size'));
  $bottom = intval(pstt_get_option('bottom'));
  $right  = intval(pstt_get_option('right'));
  $radius = intval(pstt_get_option('radius'));
  $shadow = intval(pstt_get_option('shadow')) === 1 ? '0 10px 20px rgba(0,0,0,.18), 0 6px 6px rgba(0,0,0,.12)' : 'none';
  $hide_m = intval(pstt_get_option('hide_mobile')) === 1;

  $css = ".pstt-btn{position:fixed;inset:auto {$right}px {$bottom}px auto;width:{$size}px;height:{$size}px;display:flex;align-items:center;justify-content:center;background:{$bg};color:{$icon};border:none;border-radius:{$radius}px;box-shadow:{$shadow};cursor:pointer;opacity:0;transform:translateY(20px) scale(.9);transition:opacity .25s ease, transform .25s ease, box-shadow .2s ease;z-index:9998;outline:none;-webkit-tap-highlight-color:transparent}
.pstt-btn:hover{transform:translateY(16px) scale(.92)}
.pstt-btn:focus-visible{box-shadow:0 0 0 3px rgba(38,170,225,.35), {$shadow}}
.pstt-btn.is-visible{opacity:1;transform:translateY(0) scale(1)}
.pstt-icon{width:40%;height:40%;display:block;fill:{$icon}}
.admin-bar .pstt-btn{bottom:calc({$bottom}px + 32px)}
";
  if ($hide_m) {
    $css .= "@media (max-width:575.98px){.pstt-btn{display:none}}";
  }

  wp_register_style('pstt-style', false);
  wp_enqueue_style('pstt-style');
  wp_add_inline_style('pstt-style', $css);

  // JS
  $show_after = max(0, intval(pstt_get_option('show_after')));
  $i18n_label = esc_js(__('Lên đầu trang', 'pepsico-scroll-top'));
  $js = "(function(){\n  var btn = document.querySelector('.pstt-btn');\n  if(!btn) return;\n  var showAfter = {$show_after};\n  function toggle(){\n    if(window.scrollY > showAfter){ btn.classList.add('is-visible'); } else { btn.classList.remove('is-visible'); }\n  }\n  window.addEventListener('scroll', toggle, {passive:true});\n  window.addEventListener('load', toggle);\n  function goTop(){\n    var prefersNoMotion = window.matchMedia && window.matchMedia('(prefers-reduced-motion: reduce)').matches;\n    if(prefersNoMotion){ window.scrollTo(0,0); return; }\n    try{ window.scrollTo({top:0, behavior:'smooth'}); } catch(e){ var c = document.documentElement.scrollTop || document.body.scrollTop; (function s(){ if(c>0){ window.scrollTo(0, c-=Math.max(10, c/8)); requestAnimationFrame(s);} })(); }\n  }\n  btn.addEventListener('click', goTop);\n  btn.addEventListener('keydown', function(e){ if(e.key==='Enter'||e.key===' '){ e.preventDefault(); goTop(); }});\n  btn.setAttribute('aria-label', '{$i18n_label}');\n})();";

  wp_register_script('pstt-js', '', [], false, true);
  wp_enqueue_script('pstt-js');
  wp_add_inline_script('pstt-js', $js);
});
