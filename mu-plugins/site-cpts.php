<?php
/**
 * Plugin Name: Site CPTs & Taxonomies (MU)
 * Description: Đăng ký các CPT và taxonomy bằng code (theo JSON ACF).
 * Version: 1.2.0
 */

if (!defined('ABSPATH')) exit;

/* =========================================================
 * 1) Custom Post Types
 * =======================================================*/
add_action('init', function () {
    // --- pepsico ---
    register_post_type('pepsico', array(
        'labels' => array(
            'name'                          => 'Drinks',
            'singular_name'                 => 'Drink',
            'menu_name'                     => 'Drinks',
            'all_items'                     => 'All Drinks',
            'edit_item'                     => 'Edit pepsico',
            'view_item'                     => 'View pepsico',
            'view_items'                    => 'View Drinks',
            'add_new_item'                  => 'Add New pepsico',
            'add_new'                       => 'Add New pepsico',
            'new_item'                      => 'New pepsico',
            'parent_item_colon'             => 'Parent pepsico:',
            'search_items'                   => 'Search Drinks',
            'not_found'                     => 'No drinks found',
            'not_found_in_trash'            => 'No drinks found in Trash',
            'archives'                      => 'pepsico Archives',
            'attributes'                    => 'pepsico Attributes',
            'insert_into_item'              => 'Insert into pepsico',
            'uploaded_to_this_item'         => 'Uploaded to this pepsico',
            'filter_items_list'             => 'Filter drinks list',
            'filter_by_date'                => 'Filter drinks by date',
            'items_list_navigation'         => 'Drinks list navigation',
            'items_list'                    => 'Drinks list',
            'item_published'                => 'pepsico published.',
            'item_published_privately'      => 'pepsico published privately.',
            'item_reverted_to_draft'        => 'pepsico reverted to draft.',
            'item_scheduled'                => 'pepsico scheduled.',
            'item_updated'                  => 'pepsico updated.',
            'item_link'                     => 'pepsico Link',
            'item_link_description'         => 'A link to a pepsico.',
        ),
        'public'           => true,
        'show_in_rest'     => true,
        'menu_icon'        => 'dashicons-admin-post',
        'supports'         => array('title','editor','thumbnail','custom-fields'),
        'has_archive'      => false, // theo JSON
        'rewrite'          => array(
            'with_front' => true,
            'feeds'      => false,
            'pages'      => true,
        ),
        'delete_with_user' => false,
    ));

    // --- thong_cao_bao_chi ---
    register_post_type('thong_cao_bao_chi', array(
        'labels' => array(
            'name'                          => 'Thông cáo báo chí',
            'singular_name'                 => 'Bài viết thông cáo',
            'menu_name'                     => 'Thông cáo báo chí',
            'all_items'                     => 'All Thông cáo báo chí',
            'edit_item'                     => 'Edit Bài viết thông cáo',
            'view_item'                     => 'View Bài viết thông cáo',
            'view_items'                    => 'View Thông cáo báo chí',
            'add_new_item'                  => 'Add New Bài viết thông cáo',
            'add_new'                       => 'Add New Bài viết thông cáo',
            'new_item'                      => 'New Bài viết thông cáo',
            'parent_item_colon'             => 'Parent Bài viết thông cáo:',
            'search_items'                   => 'Search Thông cáo báo chí',
            'not_found'                     => 'No thông cáo báo chí found',
            'not_found_in_trash'            => 'No thông cáo báo chí found in Trash',
            'archives'                      => 'Bài viết thông cáo Archives',
            'attributes'                    => 'Bài viết thông cáo Attributes',
            'insert_into_item'              => 'Insert into bài viết thông cáo',
            'uploaded_to_this_item'         => 'Uploaded to this bài viết thông cáo',
            'filter_items_list'             => 'Filter thông cáo báo chí list',
            'filter_by_date'                => 'Filter thông cáo báo chí by date',
            'items_list_navigation'         => 'Thông cáo báo chí list navigation',
            'items_list'                    => 'Thông cáo báo chí list',
            'item_published'                => 'Bài viết thông cáo published.',
            'item_published_privately'      => 'Bài viết thông cáo published privately.',
            'item_reverted_to_draft'        => 'Bài viết thông cáo reverted to draft.',
            'item_scheduled'                => 'Bài viết thông cáo scheduled.',
            'item_updated'                  => 'Bài viết thông cáo updated.',
            'item_link'                     => 'Bài viết thông cáo Link',
            'item_link_description'         => 'A link to a bài viết thông cáo.',
        ),
        'public'           => true,
        'show_in_rest'     => true,
        'menu_icon'        => 'dashicons-admin-post',
        'supports'         => array('title','editor','excerpt','thumbnail','custom-fields'),
        'has_archive'      => true, // theo JSON
        'rewrite'          => array(
            'with_front' => true,
            'feeds'      => false,
            'pages'      => true,
        ),
        'delete_with_user' => false,
    ));

    // --- tin_tuc_ve_cong_ty ---
    register_post_type('tin_tuc_ve_cong_ty', array(
        'labels' => array(
            'name'                          => 'Tin tức về công ty',
            'singular_name'                 => 'Bài viết tin tức',
            'menu_name'                     => 'Tin tức về công ty',
            'all_items'                     => 'All Tin tức về công ty',
            'edit_item'                     => 'Edit Bài viết tin tức',
            'view_item'                     => 'View Bài viết tin tức',
            'view_items'                    => 'View Tin tức về công ty',
            'add_new_item'                  => 'Add New Bài viết tin tức',
            'add_new'                       => 'Add New Bài viết tin tức',
            'new_item'                      => 'New Bài viết tin tức',
            'parent_item_colon'             => 'Parent Bài viết tin tức:',
            'search_items'                   => 'Search Tin tức về công ty',
            'not_found'                     => 'No tin tức về công ty found',
            'not_found_in_trash'            => 'No tin tức về công ty found in Trash',
            'archives'                      => 'Bài viết tin tức Archives',
            'attributes'                    => 'Bài viết tin tức Attributes',
            'insert_into_item'              => 'Insert into bài viết tin tức',
            'uploaded_to_this_item'         => 'Uploaded to this bài viết tin tức',
            'filter_items_list'             => 'Filter tin tức về công ty list',
            'filter_by_date'                => 'Filter tin tức về công ty by date',
            'items_list_navigation'         => 'Tin tức về công ty list navigation',
            'items_list'                    => 'Tin tức về công ty list',
            'item_published'                => 'Bài viết tin tức published.',
            'item_published_privately'      => 'Bài viết tin tức published privately.',
            'item_reverted_to_draft'        => 'Bài viết tin tức reverted to draft.',
            'item_scheduled'                => 'Bài viết tin tức scheduled.',
            'item_updated'                  => 'Bài viết tin tức updated.',
            'item_link'                     => 'Bài viết tin tức Link',
            'item_link_description'         => 'A link to a bài viết tin tức.',
        ),
        'public'           => true,
        'show_in_rest'     => true,
        'menu_icon'        => 'dashicons-admin-post',
        'supports'         => array('title','editor','excerpt','thumbnail','custom-fields'),
        // 'taxonomies'    => array('news_topic'), // JSON có tham chiếu; bạn CHƯA tạo taxonomy này nên để trống
        'has_archive'      => true, // theo JSON
        'rewrite'          => array(
            'with_front' => true,
            'feeds'      => false,
            'pages'      => true,
        ),
        'delete_with_user' => false,
    ));
}, 5); // CPT trước

/* =========================================================
 * 2) Taxonomies
 * =======================================================*/
add_action('init', function () {
    // drink_line (gắn với pepsico)
    register_taxonomy('drink_line', array('pepsico'), array(
        'labels' => array(
            'name'                          => 'Drink Lines',
            'singular_name'                 => 'Drink Line',
            'menu_name'                     => 'Drink Lines',
            'all_items'                     => 'All Drink Lines',
            'edit_item'                     => 'Edit Drink Line',
            'view_item'                     => 'View Drink Line',
            'update_item'                   => 'Update Drink Line',
            'add_new_item'                  => 'Add New Drink Line',
            'new_item_name'                 => 'New Drink Line Name',
            'search_items'                  => 'Search Drink Lines',
            'not_found'                     => 'No drink lines found',
            'no_terms'                      => 'No drink lines',
            'items_list_navigation'         => 'Drink Lines list navigation',
            'items_list'                    => 'Drink Lines list',
            'back_to_items'                 => '← Go to drink lines',
            'item_link'                     => 'Drink Line Link',
            'item_link_description'         => 'A link to a drink line',
        ),
        'public'                => true,
        'publicly_queryable'    => true,
        'hierarchical'          => true,
        'show_ui'               => true,
        'show_in_menu'          => true,
        'show_in_nav_menus'     => true,
        'show_in_rest'          => true,
        'show_tagcloud'         => true,
        'show_in_quick_edit'    => true,
        'show_admin_column'     => false,
        'rewrite'               => array(
            'slug'          => 'san-pham',
            'with_front'    => true,
            'hierarchical'  => true,
        ),
        'query_var'             => true,
    ));

    // đảm bảo dù load thứ tự thế nào vẫn gắn taxonomy vào CPT
    register_taxonomy_for_object_type('drink_line', 'pepsico');
}, 6); // taxonomy sau CPT

/* =========================================================
 * 3) Flush rewrite 1 lần
 * =======================================================*/
add_action('init', function () {
    $flag = 'site_cpts_tax_mu_flushed_v4';
    if (!get_option($flag)) {
        flush_rewrite_rules(false);
        update_option($flag, 1);
    }
}, 99);
