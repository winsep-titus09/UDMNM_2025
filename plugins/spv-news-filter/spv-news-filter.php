<?php
/**
 * Plugin Name: SPV News Filter (Widget)
 * Description: Widget sắp xếp theo ngày và lọc theo khoảng ngày đăng, áp dụng vào WP_Query.
 * Version: 1.1
 * Author: winsep
 * Text Domain: spv-news-filter
 * Domain Path: /languages
 */

// ====== I18N: nạp textdomain ======
add_action('plugins_loaded', function () {
    load_plugin_textdomain(
        'spv-news-filter',
        false,
        dirname(plugin_basename(__FILE__)) . '/languages'
    );
});

// ====== ENQUEUE (CSS + JS nhẹ) ======
add_action('wp_enqueue_scripts', function () {
    // CSS nhẹ cho form (bạn có thể đưa sang theme nếu muốn)
    $css = "
    .spv-news-filterCard{background:#F2F9F9;padding:16px}
    .spv-news-filterTitle{font-size:20px;font-weight:600;margin:6px 0 10px}
    .spv-news-filterForm hr{margin:14px 0}
    .spv-filter-dates{display:grid;}
    .spv-filter-dates p{margin:0}
    .spv-news-filterForm select,
    .spv-news-filterForm input[type=date]{width:100%;box-sizing:border-box;padding:12px 14px;border:1px solid #d1d5db;border-radius:12px;line-height:1.25;background:#fff;min-width:0}
    .spv-news-filterForm input[type=date]:focus,
    .spv-news-filterForm select:focus{outline:none;border-color:#3b82f6;box-shadow:0 0 0 3px rgba(59,130,246,.15)}
    .spv-news-filterForm .button.button-primary{background:#2563eb;color:#fff;padding:10px 14px;font-weight:700;box-shadow:0 1px 0 rgba(0,0,0,.04);cursor:pointer}
    .spv-news-filterForm .button.button-primary:hover{filter:brightness(.95)}
    .spv-news-filterForm .spv-filter-reset{color:#124B96;font-weight:700;text-decoration:none}
    .spv-news-filterForm .spv-filter-reset:hover{color:#26AAE1}
    ";
    wp_register_style('spv-news-filter-inline', false);
    wp_enqueue_style('spv-news-filter-inline');
    wp_add_inline_style('spv-news-filter-inline', $css);

    // JS: click/focus vào input date sẽ mở lịch (nếu trình duyệt hỗ trợ)
    $js = "
    document.addEventListener('DOMContentLoaded', function(){
      document.querySelectorAll('.spv-news-filterForm input[type=\"date\"]').forEach(function(el){
        function openPicker(){ if (typeof el.showPicker === 'function') el.showPicker(); }
        el.addEventListener('focus', openPicker);
        el.addEventListener('click', openPicker);
        el.addEventListener('keydown', function(e){ if (e.key === 'Enter'){ e.preventDefault(); openPicker(); }});
      });
    });
    ";
    wp_register_script('spv-news-filter-inline', '', [], null, true);
    wp_enqueue_script('spv-news-filter-inline');
    wp_add_inline_script('spv-news-filter-inline', $js);
});

// ====== WIDGET ======
class News_Filter_Widget extends WP_Widget {
    public function __construct() {
        parent::__construct(
            'news_filter_widget',
            __('Bộ lọc bài viết (Ngày & Sắp xếp)', 'spv-news-filter'),
            ['description' => __('Sắp xếp theo ngày và lọc theo khoảng ngày đăng.', 'spv-news-filter')]
        );
    }

    // ------- Admin form: cho phép tự gõ nhãn/label -------
    public function form($instance) {
        $d = [
            'title_sort'   => __('Sắp xếp theo', 'spv-news-filter'),
            'opt_newest'   => __('Ngày phát hành (Mới nhất)', 'spv-news-filter'),
            'opt_oldest'   => __('Ngày phát hành (Cũ nhất)', 'spv-news-filter'),
            'title_filter' => __('Lọc kết quả', 'spv-news-filter'),
            'label_from'   => __('Từ ngày', 'spv-news-filter'),
            'label_to'     => __('Đến ngày', 'spv-news-filter'),
            'btn_apply'    => __('Áp dụng', 'spv-news-filter'),
            'link_reset'   => __('Xóa tất cả bộ lọc', 'spv-news-filter'),
        ];
        $v = wp_parse_args($instance, $d);

        $f = function($key, $label) use ($v){
            $id = esc_attr($this->get_field_id($key));
            $name = esc_attr($this->get_field_name($key));
            $val = esc_attr($v[$key]);
            echo "<p><label for='{$id}'>{$label}</label><br>
                  <input class='widefat' id='{$id}' name='{$name}' type='text' value='{$val}'></p>";
        };

        $f('title_sort',   __('Tiêu đề khu vực sắp xếp', 'spv-news-filter'));
        $f('opt_newest',   __('Nhãn tuỳ chọn: Mới nhất', 'spv-news-filter'));
        $f('opt_oldest',   __('Nhãn tuỳ chọn: Cũ nhất', 'spv-news-filter'));
        $f('title_filter', __('Tiêu đề khu vực lọc', 'spv-news-filter'));
        $f('label_from',   __('Nhãn “Từ ngày”', 'spv-news-filter'));
        $f('label_to',     __('Nhãn “Đến ngày”', 'spv-news-filter'));
        $f('btn_apply',    __('Nút Áp dụng', 'spv-news-filter'));
        $f('link_reset',   __('Link Xoá lọc', 'spv-news-filter'));
    }

    public function update($new_instance, $old_instance) {
        $out = $old_instance;
        foreach (['title_sort','opt_newest','opt_oldest','title_filter','label_from','label_to','btn_apply','link_reset'] as $k) {
            $out[$k] = isset($new_instance[$k]) ? sanitize_text_field($new_instance[$k]) : '';
        }
        return $out;
    }

    // ------- Frontend render -------
    public function widget($args, $instance) {
        $defaults = [
            'title_sort'   => __('Sắp xếp theo', 'spv-news-filter'),
            'opt_newest'   => __('Ngày phát hành (Mới nhất)', 'spv-news-filter'),
            'opt_oldest'   => __('Ngày phát hành (Cũ nhất)', 'spv-news-filter'),
            'title_filter' => __('Lọc kết quả', 'spv-news-filter'),
            'label_from'   => __('Từ ngày', 'spv-news-filter'),
            'label_to'     => __('Đến ngày', 'spv-news-filter'),
            'btn_apply'    => __('Áp dụng', 'spv-news-filter'),
            'link_reset'   => __('Xóa tất cả bộ lọc', 'spv-news-filter'),
        ];
        $txt = wp_parse_args($instance, $defaults);

        $sort = isset($_GET['sort']) ? sanitize_text_field(wp_unslash($_GET['sort'])) : 'date_desc';
        $from = isset($_GET['from']) ? sanitize_text_field(wp_unslash($_GET['from'])) : '';
        $to   = isset($_GET['to'])   ? sanitize_text_field(wp_unslash($_GET['to']))   : '';

        // Action: giữ nguyên đường dẫn hiện tại
        $req_uri = isset($_SERVER['REQUEST_URI']) ? $_SERVER['REQUEST_URI'] : '';
        $action  = esc_url( remove_query_arg( ['sort','from','to'], $req_uri ) );

        echo $args['before_widget']; ?>
        <div class="spv-news-filterCard">
            <h3 class="spv-news-filterTitle"><?php echo esc_html($txt['title_sort']); ?></h3>

            <form class="spv-news-filterForm" action="<?php echo $action; ?>" method="get">
                <?php
                // Giữ lại các query khác khi submit
                foreach ($_GET as $k => $v) {
                    if (in_array($k, ['sort','from','to'], true)) continue;
                    if (is_array($v)) continue;
                    printf('<input type="hidden" name="%s" value="%s">', esc_attr($k), esc_attr($v));
                } ?>

                <p>
                    <label class="screen-reader-text" for="spv-sort"><?php echo esc_html($txt['title_sort']); ?></label>
                    <select id="spv-sort" name="sort" onchange="this.form.submit()">
                        <option value="date_desc" <?php selected($sort, 'date_desc'); ?>>
                            <?php echo esc_html($txt['opt_newest']); ?>
                        </option>
                        <option value="date_asc" <?php selected($sort, 'date_asc'); ?>>
                            <?php echo esc_html($txt['opt_oldest']); ?>
                        </option>
                    </select>
                </p>

                <hr>

                <h3 class="spv-news-filterTitle"><?php echo esc_html($txt['title_filter']); ?></h3>

                <div class="spv-filter-dates">
                    <p>
                        <label for="spv-from"><?php echo esc_html($txt['label_from']); ?></label>
                        <input id="spv-from" name="from" type="date" value="<?php echo esc_attr($from); ?>">
                    </p>
                    <p>
                        <label for="spv-to"><?php echo esc_html($txt['label_to']); ?></label>
                        <input id="spv-to" name="to" type="date" value="<?php echo esc_attr($to); ?>">
                    </p>
                </div>

                <p style="margin-top:12px;display:flex;gap:12px;align-items:center;">
                    <button type="submit" class="button button-primary"><?php echo esc_html($txt['btn_apply']); ?></button>
                    <a class="spv-filter-reset" href="<?php echo esc_url( remove_query_arg(['sort','from','to']) ); ?>">
                        <?php echo esc_html($txt['link_reset']); ?>
                    </a>
                </p>
            </form>
        </div>
        <?php
        echo $args['after_widget'];
    }
}

add_action('widgets_init', function () {
    register_widget('News_Filter_Widget');
});

// ====== ÁP DỤNG VÀO WP_Query ======
function spv_nf_normalize_date($s) {
    $s = trim((string)$s);
    if (!$s) return '';
    if ($d = DateTime::createFromFormat('Y-m-d', $s)) return $d->format('Y-m-d');
    if ($d = DateTime::createFromFormat('d/m/Y', $s)) return $d->format('Y-m-d');
    return '';
}

add_action('pre_get_posts', function(\WP_Query $q){
    if (is_admin() || !$q->is_main_query()) return;

    // Chỉ chạy khi có tham số lọc/sắp xếp hoặc đang ở trang archive/home/search
    $has_params = isset($_GET['sort']) || isset($_GET['from']) || isset($_GET['to']);
    if (!$has_params && !($q->is_archive() || $q->is_home() || $q->is_search())) return;

    // Sắp xếp
    $sort = isset($_GET['sort']) ? sanitize_text_field(wp_unslash($_GET['sort'])) : '';
    if ($sort === 'date_asc')  { $q->set('orderby','date'); $q->set('order','ASC'); }
    if ($sort === 'date_desc'){ $q->set('orderby','date'); $q->set('order','DESC'); }

    // Lọc theo khoảng ngày
    $from = isset($_GET['from']) ? spv_nf_normalize_date(sanitize_text_field(wp_unslash($_GET['from']))) : '';
    $to   = isset($_GET['to'])   ? spv_nf_normalize_date(sanitize_text_field(wp_unslash($_GET['to'])))   : '';

    if ($from && $to && strtotime($from) > strtotime($to)) { $t=$from; $from=$to; $to=$t; }

    if ($from || $to) {
        $dq = ['inclusive'=>true];
        if ($from) $dq['after']  = $from;
        if ($to)   $dq['before'] = $to . ' 23:59:59';
        $q->set('date_query', [$dq]);
    }
});
