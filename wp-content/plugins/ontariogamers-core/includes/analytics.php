<?php
/**
 * Google Analytics 4 (GA4) tracking.
 *
 * Outputs the GA4 gtag.js snippet in the site <head> so page views are
 * reported to Google Analytics. The Measurement ID can be overridden with
 * either the ONTARIOGAMERS_GA4_ID constant (in wp-config.php) or the
 * 'ontariogamers_ga4_id' filter; otherwise the default below is used.
 *
 * The tag is skipped for logged-in admins/editors so your own visits don't
 * inflate the stats, and skipped entirely if no ID is set.
 */

if (!defined('ABSPATH')) {
    exit;
}

/**
 * Resolve the GA4 Measurement ID (e.g. "G-XXXXXXXXXX").
 */
function ontariogamers_ga4_id() {
    $id = defined('ONTARIOGAMERS_GA4_ID') ? ONTARIOGAMERS_GA4_ID : 'G-JGPHEWDBY9';
    return trim((string) apply_filters('ontariogamers_ga4_id', $id));
}

/**
 * Print the GA4 gtag.js snippet in <head>.
 */
function ontariogamers_ga4_tag() {
    $id = ontariogamers_ga4_id();

    // No ID configured — do nothing.
    if ($id === '') {
        return;
    }

    // Don't track logged-in users who can edit the site (you and your authors)
    // so your own page views don't pollute the analytics.
    if (is_user_logged_in() && current_user_can('edit_posts')) {
        return;
    }

    $id_attr = esc_attr($id);
    $id_js   = esc_js($id);
    ?>
<!-- Google Analytics 4 (OntarioGamers) -->
<script async src="https://www.googletagmanager.com/gtag/js?id=<?php echo $id_attr; ?>"></script>
<script>
    window.dataLayer = window.dataLayer || [];
    function gtag(){dataLayer.push(arguments);}
    gtag('js', new Date());
    gtag('config', '<?php echo $id_js; ?>');
</script>
<!-- /Google Analytics 4 -->
    <?php
}
add_action('wp_head', 'ontariogamers_ga4_tag', 20);
