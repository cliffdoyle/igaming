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
        'primary'        => __('Primary Menu (Header + Mobile)', 'ontariogamers'),
        'footer_casinos' => __('Footer Column 1 — Casinos', 'ontariogamers'),
        'footer_slots'   => __('Footer Column 2 — Slots', 'ontariogamers'),
        'footer_sports'  => __('Footer Column 3 — Sports Betting', 'ontariogamers'),
        'footer_company' => __('Footer Column 4 — OntarioGamers', 'ontariogamers'),
    ));

    // Image sizes for casino/slot cards
    add_image_size('casino-logo', 160, 160, true);
    add_image_size('slot-thumbnail', 400, 250, true);
    add_image_size('card-thumbnail', 600, 360, true);
}
add_action('after_setup_theme', 'ontariogamers_setup');

// Enqueue styles and scripts
function ontariogamers_scripts() {
    $theme_dir = get_template_directory();
    $theme_uri = get_template_directory_uri();

    // Main stylesheet (style.css) — version from file mtime busts cache on every change
    $style_path = $theme_dir . '/style.css';
    wp_enqueue_style(
        'ontariogamers-style',
        get_stylesheet_uri(),
        array(),
        file_exists($style_path) ? filemtime($style_path) : '1.0.0'
    );

    // Custom JS
    $js_path = $theme_dir . '/assets/js/main.js';
    wp_enqueue_script(
        'ontariogamers-main',
        $theme_uri . '/assets/js/main.js',
        array(),
        file_exists($js_path) ? filemtime($js_path) : '1.0.0',
        true
    );
}
add_action('wp_enqueue_scripts', 'ontariogamers_scripts');

// Output the gamified gamepad favicon (front-end + admin).
// Only used as a fallback when the admin has NOT uploaded a Site Icon
// via Appearance > Customize > Site Identity (that one always wins).
function ontariogamers_favicon() {
    if (function_exists('has_site_icon') && has_site_icon()) {
        return; // respect an admin-uploaded Site Icon
    }
    $svg_path = get_template_directory() . '/assets/favicon.svg';
    $svg = get_template_directory_uri() . '/assets/favicon.svg';
    if (file_exists($svg_path)) {
        $svg = add_query_arg('ver', filemtime($svg_path), $svg);
    }
    echo '<link rel="icon" type="image/svg+xml" href="' . esc_url($svg) . '">' . "\n";
    echo '<link rel="mask-icon" href="' . esc_url($svg) . '" color="#1a472a">' . "\n";
}
add_action('wp_head', 'ontariogamers_favicon');
add_action('admin_head', 'ontariogamers_favicon');

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

// Default navigation when no menu has been assigned in Appearance → Menus.
// This keeps the header (and the mobile hamburger) functional out of the box.
function ontariogamers_default_menu() {
    $items = array(
        home_url('/')                       => 'Home',
        home_url('/online-casinos/')        => 'Online Casinos',
        home_url('/online-slots/')          => 'Online Slots',
        home_url('/about/')                 => 'About',
        home_url('/responsible-gambling/')  => 'Responsible Gambling',
        home_url('/contact/')               => 'Contact',
    );

    echo '<ul id="primary-menu-list" class="menu">';
    foreach ($items as $url => $label) {
        echo '<li class="menu-item"><a href="' . esc_url($url) . '">' . esc_html($label) . '</a></li>';
    }
    echo '</ul>';
}

// Shared renderer for the footer-column fallbacks below.
function ontariogamers_footer_menu_fallback($items) {
    echo '<ul class="menu">';
    foreach ($items as $url => $label) {
        echo '<li class="menu-item"><a href="' . esc_url($url) . '">' . esc_html($label) . '</a></li>';
    }
    echo '</ul>';
}

// Footer column fallbacks — shown only until the admin assigns a real menu
// to each footer location in Appearance → Menus. Then the admin's menu wins.
function ontariogamers_footer_casinos_fallback() {
    ontariogamers_footer_menu_fallback(array(
        home_url('/online-casinos/')                  => 'Best Ontario Casinos',
        home_url('/guides/ontario-casino-guide/')     => 'Ontario Casino Guide',
        home_url('/online-casinos/bet99-review/')      => 'Bet99 Review (example)',
        home_url('/online-casinos/betmgm-review/')     => 'BetMGM Review (example)',
    ));
}

function ontariogamers_footer_slots_fallback() {
    ontariogamers_footer_menu_fallback(array(
        home_url('/online-slots/')                          => 'All Slot Reviews',
        home_url('/online-slots/gates-of-olympus-ontario/') => 'Gates of Olympus (example)',
        home_url('/online-slots/sweet-bonanza-ontario/')    => 'Sweet Bonanza (example)',
        home_url('/online-slots/big-bass-bonanza-ontario/') => 'Big Bass Bonanza (example)',
    ));
}

function ontariogamers_footer_sports_fallback() {
    ontariogamers_footer_menu_fallback(array(
        home_url('/sports-picks/')  => 'Free Daily Picks',
        home_url('/sport/nhl/')     => 'NHL Picks',
        home_url('/sport/nba/')     => 'NBA Picks',
        home_url('/sport/nfl/')     => 'NFL Picks',
    ));
}

function ontariogamers_footer_company_fallback() {
    ontariogamers_footer_menu_fallback(array(
        home_url('/about/')                  => 'About Us',
        home_url('/responsible-gambling/')   => 'Responsible Gambling',
        home_url('/affiliate-disclosure/')   => 'Affiliate Disclosure',
        home_url('/privacy-policy/')         => 'Privacy Policy',
        home_url('/contact/')                => 'Contact',
    ));
}

// Helper: Get casino rating display
function ontariogamers_rating_display($rating) {    if (!$rating) return '';
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
