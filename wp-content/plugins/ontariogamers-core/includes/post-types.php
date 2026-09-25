<?php
/**
 * Custom Post Types Registration
 * Creates: Casino Reviews, Slot Reviews
 */

if (!defined('ABSPATH')) {
    exit;
}

function ontariogamers_register_post_types() {

    // Casino Reviews
    register_post_type('casino_review', array(
        'labels' => array(
            'name'               => 'Casino Reviews',
            'singular_name'      => 'Casino Review',
            'add_new'            => 'Add New Casino',
            'add_new_item'       => 'Add New Casino Review',
            'edit_item'          => 'Edit Casino Review',
            'view_item'          => 'View Casino Review',
            'all_items'          => 'All Casino Reviews',
            'search_items'       => 'Search Casino Reviews',
            'not_found'          => 'No casino reviews found',
        ),
        'public'             => true,
        'has_archive'        => true,
        'rewrite'            => array('slug' => 'online-casinos'),
        'supports'           => array('title', 'editor', 'author', 'thumbnail', 'excerpt', 'page-attributes'),
        'menu_icon'          => 'dashicons-games',
        'menu_position'      => 5,
        'show_in_rest'       => true, // Enable Gutenberg editor
    ));

    // Slot Reviews
    register_post_type('slot_review', array(
        'labels' => array(
            'name'               => 'Slot Reviews',
            'singular_name'      => 'Slot Review',
            'add_new'            => 'Add New Slot',
            'add_new_item'       => 'Add New Slot Review',
            'edit_item'          => 'Edit Slot Review',
            'view_item'          => 'View Slot Review',
            'all_items'          => 'All Slot Reviews',
            'search_items'       => 'Search Slot Reviews',
            'not_found'          => 'No slot reviews found',
        ),
        'public'             => true,
        'has_archive'        => true,
        'rewrite'            => array('slug' => 'online-slots'),
        'supports'           => array('title', 'editor', 'author', 'thumbnail', 'excerpt', 'page-attributes'),
        'menu_icon'          => 'dashicons-screenoptions',
        'menu_position'      => 6,
        'show_in_rest'       => true,
    ));

    // Casino Comparisons (head-to-head)
    register_post_type('comparison', array(
        'labels' => array(
            'name'          => 'Comparisons',
            'singular_name' => 'Comparison',
            'add_new'       => 'Add New Comparison',
            'add_new_item'  => 'Add New Comparison',
            'edit_item'     => 'Edit Comparison',
            'view_item'     => 'View Comparison',
            'all_items'     => 'All Comparisons',
            'search_items'  => 'Search Comparisons',
            'not_found'     => 'No comparisons found',
        ),
        'public'        => true,
        'has_archive'   => true,
        'rewrite'       => array('slug' => 'comparisons'),
        'supports'      => array('title', 'editor', 'author', 'thumbnail', 'excerpt', 'page-attributes'),
        'menu_icon'     => 'dashicons-columns',
        'menu_position' => 8,
        'show_in_rest'  => true,
    ));

    // Casino Categories (e.g., Ontario, Alberta, Live Casino)
    register_taxonomy('casino_category', 'casino_review', array(
        'labels' => array(
            'name'          => 'Casino Categories',
            'singular_name' => 'Casino Category',
            'add_new_item'  => 'Add New Category',
        ),
        'hierarchical' => true,
        'rewrite'      => array('slug' => 'casino-category'),
        'show_in_rest' => true,
    ));

    // Slot Categories (e.g., Megaways, Cluster Pays, Progressive)
    register_taxonomy('slot_category', 'slot_review', array(
        'labels' => array(
            'name'          => 'Slot Categories',
            'singular_name' => 'Slot Category',
            'add_new_item'  => 'Add New Category',
        ),
        'hierarchical' => true,
        'rewrite'      => array('slug' => 'slot-category'),
        'show_in_rest' => true,
    ));

    // Game Providers (shared taxonomy — Pragmatic Play, NetEnt, etc.)
    register_taxonomy('game_provider', array('slot_review', 'casino_review'), array(
        'labels' => array(
            'name'          => 'Game Providers',
            'singular_name' => 'Game Provider',
            'add_new_item'  => 'Add New Provider',
        ),
        'hierarchical' => false,
        'rewrite'      => array('slug' => 'provider'),
        'show_in_rest' => true,
    ));

    // Sports Picks
    register_post_type('sports_pick', array(
        'labels' => array(
            'name'          => 'Sports Picks',
            'singular_name' => 'Sports Pick',
            'add_new'       => 'Add New Pick',
            'add_new_item'  => 'Add New Sports Pick',
            'edit_item'     => 'Edit Sports Pick',
            'view_item'     => 'View Sports Pick',
            'all_items'     => 'All Sports Picks',
            'search_items'  => 'Search Sports Picks',
            'not_found'     => 'No sports picks found',
        ),
        'public'        => true,
        'has_archive'   => true,
        'rewrite'       => array('slug' => 'sports-picks'),
        'supports'      => array('title', 'editor', 'author', 'thumbnail', 'excerpt', 'page-attributes'),
        'menu_icon'     => 'dashicons-chart-line',
        'menu_position' => 7,
        'show_in_rest'  => true,
    ));

    // Sport / League (NHL, NBA, NFL…) — powers the footer league links at /sport/<league>/
    register_taxonomy('pick_sport', 'sports_pick', array(
        'labels' => array(
            'name'          => 'Sports / Leagues',
            'singular_name' => 'Sport / League',
            'add_new_item'  => 'Add New Sport / League',
        ),
        'hierarchical' => true,
        'rewrite'      => array('slug' => 'sport'),
        'show_in_rest' => true,
    ));
}
add_action('init', 'ontariogamers_register_post_types');

/**
 * "Last Modified" column in wp-admin lists — the core Date column only ever
 * shows the publish date, so edits were invisible there.
 */
function ontariogamers_last_modified_post_types() {
    return array('casino_review', 'slot_review', 'comparison', 'sports_pick', 'post', 'page');
}

function ontariogamers_add_last_modified_column($columns) {
    $columns['og_last_modified'] = 'Last Modified';
    return $columns;
}

function ontariogamers_render_last_modified_column($column, $post_id) {
    if ($column !== 'og_last_modified') {
        return;
    }
    $format = get_option('date_format') . ' \a\t ' . get_option('time_format');
    echo esc_html(get_post_modified_time($format, false, $post_id, true));
    $editor_id = get_post_meta($post_id, '_edit_last', true);
    if ($editor_id && ($editor = get_userdata($editor_id))) {
        echo '<br><span class="description">by ' . esc_html($editor->display_name) . '</span>';
    }
}

function ontariogamers_sortable_last_modified_column($columns) {
    $columns['og_last_modified'] = 'modified';
    return $columns;
}

function ontariogamers_register_last_modified_columns() {
    foreach (ontariogamers_last_modified_post_types() as $post_type) {
        add_filter("manage_{$post_type}_posts_columns", 'ontariogamers_add_last_modified_column');
        add_action("manage_{$post_type}_posts_custom_column", 'ontariogamers_render_last_modified_column', 10, 2);
        add_filter("manage_edit-{$post_type}_sortable_columns", 'ontariogamers_sortable_last_modified_column');
    }
}
add_action('admin_init', 'ontariogamers_register_last_modified_columns');
