<?php
/**
 * OntarioGamers Theme Functions
 *
 * @package OntarioGamers
 * @version 1.0.0
 */

if (!defined('ABSPATH')) {
    exit;
}

// Theme setup
function ontariogamers_setup() {
    // Add title tag support
    add_theme_support('title-tag');

    // Featured images
    add_theme_support('post-thumbnails');

    // Custom logo
    add_theme_support('custom-logo', array(
        'width'       => 200,
        'height'      => 50,
        'flex-width'  => true,
        'flex-height' => true,
    ));

    // HTML5 support
    add_theme_support('html5', array(
        'search-form',
        'comment-form',
        'comment-list',
        'gallery',
        'caption',
    ));

    // Register navigation menus
    register_nav_menus(array(
        'primary'  => __('Primary Menu', 'ontariogamers'),
        'footer'   => __('Footer Menu', 'ontariogamers'),
    ));

    // Image sizes for casino/slot cards
    add_image_size('casino-logo', 160, 160, true);
    add_image_size('slot-thumbnail', 400, 250, true);
    add_image_size('card-thumbnail', 600, 360, true);
}
add_action('after_setup_theme', 'ontariogamers_setup');

// Enqueue styles and scripts
function ontariogamers_scripts() {
    // Main stylesheet (style.css)
    wp_enqueue_style(
        'ontariogamers-style',
        get_stylesheet_uri(),
        array(),
        '1.0.0'
    );

    // Custom JS
    wp_enqueue_script(
        'ontariogamers-main',
        get_template_directory_uri() . '/assets/js/main.js',
        array(),
        '1.0.0',
        true
    );
}
add_action('wp_enqueue_scripts', 'ontariogamers_scripts');

// Register sidebar/widget areas
function ontariogamers_widgets() {
    register_sidebar(array(
        'name'          => __('Main Sidebar', 'ontariogamers'),
        'id'            => 'sidebar-main',
        'description'   => 'Sidebar for review pages',
        'before_widget' => '<div class="sidebar-widget">',
        'after_widget'  => '</div>',
        'before_title'  => '<h3>',
        'after_title'   => '</h3>',
    ));

    register_sidebar(array(
        'name'          => __('Footer Column 1', 'ontariogamers'),
        'id'            => 'footer-1',
        'before_widget' => '<div class="footer-col">',
        'after_widget'  => '</div>',
        'before_title'  => '<h4>',
        'after_title'   => '</h4>',
    ));
}
add_action('widgets_init', 'ontariogamers_widgets');

// Helper: Get casino rating display
function ontariogamers_rating_display($rating) {
    if (!$rating) return '';
    $rating = floatval($rating);
    return '<span class="review-rating">' . number_format($rating, 1) . '/10</span>';
}

// Helper: Responsible gambling disclaimer (reusable)
function ontariogamers_disclaimer() {
    ?>
    <div class="disclaimer-box">
        <strong>Responsible Gambling</strong>
        19+ only. Gambling involves financial risk. Only play with money you can afford to lose.
        All operators listed are AGCO-registered for Ontario players.
        Problem gambling help: ConnexOntario 1-866-531-2600 (free, confidential, 24/7).
        <a href="<?php echo esc_url(home_url('/responsible-gambling/')); ?>">Full responsible gambling resources</a>.
    </div>
    <?php
}

// Helper: Affiliate disclosure (reusable)
function ontariogamers_affiliate_disclosure() {
    ?>
    <p class="affiliate-disclosure" style="font-size: 0.8rem; color: #666; font-style: italic; margin-bottom: 1.5rem;">
        <strong>Affiliate Disclosure:</strong> OntarioGamers.com earns commission when you sign up through our links — at no extra cost to you. This does not influence our editorial recommendations.
    </p>
    <?php
}

// Customize excerpt length
function ontariogamers_excerpt_length($length) {
    return 25;
}
add_filter('excerpt_length', 'ontariogamers_excerpt_length');

// Custom excerpt "read more"
function ontariogamers_excerpt_more($more) {
    return '...';
}
add_filter('excerpt_more', 'ontariogamers_excerpt_more');
