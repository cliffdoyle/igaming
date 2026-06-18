<?php
/**
 * Plugin Name: OntarioGamers Core
 * Description: Custom post types, taxonomies, and fields for OntarioGamers.com
 * Version: 1.0.0
 * Author: OntarioGamers
 * Text Domain: ontariogamers-core
 */

if (!defined('ABSPATH')) {
    exit;
}

// Load includes
require_once plugin_dir_path(__FILE__) . 'includes/post-types.php';
require_once plugin_dir_path(__FILE__) . 'includes/custom-fields.php';

// Activation hook — flush rewrite rules
function ontariogamers_core_activate() {
    ontariogamers_register_post_types();
    flush_rewrite_rules();
}
register_activation_hook(__FILE__, 'ontariogamers_core_activate');

// Deactivation hook
function ontariogamers_core_deactivate() {
    flush_rewrite_rules();
}
register_deactivation_hook(__FILE__, 'ontariogamers_core_deactivate');
