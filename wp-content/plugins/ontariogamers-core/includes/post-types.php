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
        'supports'           => array('title', 'editor', 'thumbnail', 'excerpt', 'page-attributes'),
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
        'supports'           => array('title', 'editor', 'thumbnail', 'excerpt', 'page-attributes'),
        'menu_icon'          => 'dashicons-screenoptions',
        'menu_position'      => 6,
        'show_in_rest'       => true,
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
}
add_action('init', 'ontariogamers_register_post_types');
