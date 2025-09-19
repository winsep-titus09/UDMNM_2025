<?php
/**
 * Walker chuyển wp_nav_menu() -> markup Bootstrap 5
 */
class Bootstrap_5_WP_Nav_Menu_Walker extends Walker_Nav_Menu
{

    // <ul> cấp con
    public function start_lvl(&$output, $depth = 0, $args = null)
    {
        $indent = str_repeat("\t", $depth);
        $submenu = ($depth > 0) ? ' sub-menu' : '';
        $output .= "\n$indent<ul class=\"dropdown-menu$submenu\" role=\"menu\">\n";
    }

    // <li> + <a>
    public function start_el(&$output, $item, $depth = 0, $args = null, $id = 0)
    {
        $indent = ($depth) ? str_repeat("\t", $depth) : '';
        $classes = empty($item->classes) ? [] : (array) $item->classes;

        // Có submenu?
        $has_children = in_array('menu-item-has-children', $classes, true);

        // Li classes
        $li_classes = ['menu-item', 'nav-item'];
        if ($has_children && $depth === 0) {
            $li_classes[] = 'dropdown';
        }
        if (in_array('current-menu-item', $classes, true) || in_array('current-menu-ancestor', $classes, true)) {
            $li_classes[] = 'active';
        }

        $li_class_str = ' class="' . esc_attr(implode(' ', array_filter($li_classes))) . '"';
        $output .= $indent . '<li' . $li_class_str . '>';

        // Link attributes
        $atts = [];
        $atts['href'] = !empty($item->url) ? $item->url : '';
        $atts['title'] = !empty($item->attr_title) ? $item->attr_title : '';
        $atts['target'] = !empty($item->target) ? $item->target : '';
        $atts['rel'] = !empty($item->xfn) ? $item->xfn : '';

        // Class cho <a>
        $link_classes = [];
        if ($depth === 0) {
            $link_classes[] = 'nav-link';
            if ($has_children) {
                $link_classes[] = 'dropdown-toggle';
                $atts['data-bs-toggle'] = 'dropdown';
                $atts['aria-expanded'] = 'false';
                $atts['role'] = 'button';
            }
        } else {
            $link_classes[] = 'dropdown-item';
            if ($has_children) {
                // Trường hợp hiếm: submenu nhiều cấp (Bootstrap 5 không hỗ trợ chính thức)
                $link_classes[] = 'dropdown-toggle';
                $atts['data-bs-toggle'] = 'dropdown';
            }
        }

        // Thêm .active vào <a> thay vì <li> (hợp Bootstrap hơn)
        if (in_array('current-menu-item', $classes, true) || in_array('current-menu-ancestor', $classes, true)) {
            $link_classes[] = 'active';
        }

        $atts['class'] = implode(' ', array_filter($link_classes));

        // Build <a>
        $attributes = '';
        foreach ($atts as $attr => $value) {
            if (!empty($value)) {
                $value = ('href' === $attr) ? esc_url($value) : esc_attr($value);
                $attributes .= ' ' . $attr . '="' . $value . '"';
            }
        }

        $title = apply_filters('the_title', $item->title, $item->ID);

        $item_output = $args->before;
        $item_output .= '<a' . $attributes . '>';
        $item_output .= $args->link_before . $title . $args->link_after;
        $item_output .= '</a>';
        $item_output .= $args->after;

        $output .= $item_output;
    }

    // Đóng </li>
    public function end_el(&$output, $item, $depth = 0, $args = null)
    {
        $output .= "</li>\n";
    }
}
