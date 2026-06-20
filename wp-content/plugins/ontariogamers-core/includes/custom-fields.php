<?php
/**
 * Custom Fields Registration
 * These work with ACF (Advanced Custom Fields) plugin — free version
 * If ACF is not installed, these definitions are stored here as reference
 * and can be imported via ACF JSON sync
 */

if (!defined('ABSPATH')) {
    exit;
}

/**
 * Register custom fields using ACF (if installed)
 * ACF must be installed separately from wordpress.org (free)
 *
 * Field Groups:
 * 1. Casino Review Fields — attached to casino_review post type
 * 2. Slot Review Fields — attached to slot_review post type
 */

// If ACF is not installed, register basic meta boxes as fallback
if (!function_exists('acf_add_local_field_group')) {

    // Fallback: Register custom meta boxes without ACF
    function ontariogamers_add_meta_boxes() {
        add_meta_box(
            'casino_review_fields',
            'Casino Review Details',
            'ontariogamers_casino_meta_box',
            'casino_review',
            'normal',
            'high'
        );

        add_meta_box(
            'slot_review_fields',
            'Slot Review Details',
            'ontariogamers_slot_meta_box',
            'slot_review',
            'normal',
            'high'
        );

        add_meta_box(
            'sports_pick_fields',
            'Sports Pick Details',
            'ontariogamers_sports_meta_box',
            'sports_pick',
            'normal',
            'high'
        );
    }
    add_action('add_meta_boxes', 'ontariogamers_add_meta_boxes');

    // Casino Review Meta Box HTML
    function ontariogamers_casino_meta_box($post) {
        wp_nonce_field('ontariogamers_casino_nonce', 'ontariogamers_casino_nonce_field');

        $fields = array(
            'casino_rating'          => array('label' => 'Rating (1-10)', 'type' => 'number'),
            'casino_bonus_description' => array('label' => 'Bonus Description', 'type' => 'textarea'),
            'casino_affiliate_url'   => array('label' => 'Affiliate URL', 'type' => 'url'),
            'casino_license'         => array('label' => 'License (e.g., AGCO-registered)', 'type' => 'text'),
            'casino_deposit_methods' => array('label' => 'Deposit Methods', 'type' => 'text'),
            'casino_withdrawal_time' => array('label' => 'Withdrawal Time (e.g., 0-24 hours)', 'type' => 'text'),
            'casino_min_deposit'     => array('label' => 'Minimum Deposit', 'type' => 'text'),
            'casino_year_established' => array('label' => 'Year Established', 'type' => 'number'),
        );

        echo '<table class="form-table">';
        foreach ($fields as $key => $field) {
            $value = get_post_meta($post->ID, $key, true);
            echo '<tr>';
            echo '<th><label for="' . esc_attr($key) . '">' . esc_html($field['label']) . '</label></th>';
            echo '<td>';
            if ($field['type'] === 'textarea') {
                echo '<textarea id="' . esc_attr($key) . '" name="' . esc_attr($key) . '" rows="3" class="large-text">' . esc_textarea($value) . '</textarea>';
            } else {
                echo '<input type="' . esc_attr($field['type']) . '" id="' . esc_attr($key) . '" name="' . esc_attr($key) . '" value="' . esc_attr($value) . '" class="regular-text">';
            }
            echo '</td>';
            echo '</tr>';
        }
        echo '</table>';
    }

    // Slot Review Meta Box HTML
    function ontariogamers_slot_meta_box($post) {
        wp_nonce_field('ontariogamers_slot_nonce', 'ontariogamers_slot_nonce_field');

        $fields = array(
            'slot_rtp'          => array('label' => 'RTP (%)', 'type' => 'number'),
            'slot_volatility'   => array('label' => 'Volatility (Low/Medium/High)', 'type' => 'text'),
            'slot_max_win'      => array('label' => 'Max Win (e.g., 5000x)', 'type' => 'text'),
            'slot_provider'     => array('label' => 'Provider (e.g., Pragmatic Play)', 'type' => 'text'),
            'slot_theme'        => array('label' => 'Theme (e.g., Greek Mythology)', 'type' => 'text'),
            'slot_reels'        => array('label' => 'Reels (e.g., 5x3)', 'type' => 'text'),
            'slot_paylines'     => array('label' => 'Paylines/Ways', 'type' => 'text'),
            'slot_min_bet'      => array('label' => 'Min Bet (CAD)', 'type' => 'text'),
            'slot_max_bet'      => array('label' => 'Max Bet (CAD)', 'type' => 'text'),
            'slot_affiliate_url' => array('label' => 'Affiliate URL', 'type' => 'url'),
        );

        echo '<table class="form-table">';
        foreach ($fields as $key => $field) {
            $value = get_post_meta($post->ID, $key, true);
            echo '<tr>';
            echo '<th><label for="' . esc_attr($key) . '">' . esc_html($field['label']) . '</label></th>';
            echo '<td>';
            echo '<input type="' . esc_attr($field['type']) . '" id="' . esc_attr($key) . '" name="' . esc_attr($key) . '" value="' . esc_attr($value) . '" class="regular-text"';
            if ($field['type'] === 'number' && $key === 'slot_rtp') {
                echo ' step="0.01" min="80" max="99.99"';
            }
            echo '>';
            echo '</td>';
            echo '</tr>';
        }
        echo '</table>';
    }

    // Save casino meta
    function ontariogamers_save_casino_meta($post_id) {
        if (!isset($_POST['ontariogamers_casino_nonce_field'])) return;
        if (!wp_verify_nonce($_POST['ontariogamers_casino_nonce_field'], 'ontariogamers_casino_nonce')) return;
        if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) return;
        if (!current_user_can('edit_post', $post_id)) return;

        $fields = array(
            'casino_rating', 'casino_bonus_description', 'casino_affiliate_url',
            'casino_license', 'casino_deposit_methods', 'casino_withdrawal_time',
            'casino_min_deposit', 'casino_year_established'
        );

        foreach ($fields as $field) {
            if (isset($_POST[$field])) {
                update_post_meta($post_id, $field, sanitize_text_field($_POST[$field]));
            }
        }
    }
    add_action('save_post_casino_review', 'ontariogamers_save_casino_meta');

    // Save slot meta
    function ontariogamers_save_slot_meta($post_id) {
        if (!isset($_POST['ontariogamers_slot_nonce_field'])) return;
        if (!wp_verify_nonce($_POST['ontariogamers_slot_nonce_field'], 'ontariogamers_slot_nonce')) return;
        if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) return;
        if (!current_user_can('edit_post', $post_id)) return;

        $fields = array(
            'slot_rtp', 'slot_volatility', 'slot_max_win', 'slot_provider',
            'slot_theme', 'slot_reels', 'slot_paylines', 'slot_min_bet',
            'slot_max_bet', 'slot_affiliate_url'
        );

        foreach ($fields as $field) {
            if (isset($_POST[$field])) {
                update_post_meta($post_id, $field, sanitize_text_field($_POST[$field]));
            }
        }
    }
    add_action('save_post_slot_review', 'ontariogamers_save_slot_meta');

    // Sports Pick Meta Box HTML
    function ontariogamers_sports_meta_box($post) {
        wp_nonce_field('ontariogamers_sports_nonce', 'ontariogamers_sports_nonce_field');
        $match     = get_post_meta($post->ID, 'pick_match', true);
        $selection = get_post_meta($post->ID, 'pick_selection', true);
        $odds      = get_post_meta($post->ID, 'pick_odds', true);
        $result    = get_post_meta($post->ID, 'pick_result', true);
        if (!$result) $result = 'Pending';
        $date      = get_post_meta($post->ID, 'pick_event_date', true);
        $book      = get_post_meta($post->ID, 'pick_sportsbook', true);
        $aff       = get_post_meta($post->ID, 'pick_affiliate_url', true);
        ?>
        <table class="form-table">
            <tr>
                <th><label for="pick_match">Match / Event</label></th>
                <td><input type="text" id="pick_match" name="pick_match" value="<?php echo esc_attr($match); ?>" class="regular-text" placeholder="e.g. Maple Leafs vs Canadiens"></td>
            </tr>
            <tr>
                <th><label for="pick_selection">Our Pick</label></th>
                <td><input type="text" id="pick_selection" name="pick_selection" value="<?php echo esc_attr($selection); ?>" class="regular-text" placeholder="e.g. Maple Leafs -1.5"></td>
            </tr>
            <tr>
                <th><label for="pick_odds">Odds</label></th>
                <td><input type="text" id="pick_odds" name="pick_odds" value="<?php echo esc_attr($odds); ?>" class="regular-text" placeholder="e.g. +150"></td>
            </tr>
            <tr>
                <th><label for="pick_event_date">Event Date</label></th>
                <td><input type="date" id="pick_event_date" name="pick_event_date" value="<?php echo esc_attr($date); ?>" class="regular-text"></td>
            </tr>
            <tr>
                <th><label for="pick_result">Result</label></th>
                <td>
                    <select id="pick_result" name="pick_result">
                        <?php foreach (array('Pending', 'Won', 'Lost', 'Push') as $opt) : ?>
                            <option value="<?php echo esc_attr($opt); ?>" <?php selected($result, $opt); ?>><?php echo esc_html($opt); ?></option>
                        <?php endforeach; ?>
                    </select>
                </td>
            </tr>
            <tr>
                <th><label for="pick_sportsbook">Sportsbook (optional)</label></th>
                <td><input type="text" id="pick_sportsbook" name="pick_sportsbook" value="<?php echo esc_attr($book); ?>" class="regular-text" placeholder="e.g. Bet99"></td>
            </tr>
            <tr>
                <th><label for="pick_affiliate_url">Sportsbook Link (optional)</label></th>
                <td><input type="url" id="pick_affiliate_url" name="pick_affiliate_url" value="<?php echo esc_attr($aff); ?>" class="regular-text" placeholder="https://..."></td>
            </tr>
        </table>
        <p class="description">Tip: also set the <strong>Sport / League</strong> (NHL, NBA, NFL…) in the box on the right so the pick appears under that league at <code>/sport/&lt;league&gt;/</code>.</p>
        <?php
    }

    // Save sports pick meta
    function ontariogamers_save_sports_meta($post_id) {
        if (!isset($_POST['ontariogamers_sports_nonce_field'])) return;
        if (!wp_verify_nonce($_POST['ontariogamers_sports_nonce_field'], 'ontariogamers_sports_nonce')) return;
        if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) return;
        if (!current_user_can('edit_post', $post_id)) return;

        $fields = array(
            'pick_match', 'pick_selection', 'pick_odds', 'pick_result',
            'pick_event_date', 'pick_sportsbook', 'pick_affiliate_url'
        );

        foreach ($fields as $field) {
            if (isset($_POST[$field])) {
                update_post_meta($post_id, $field, sanitize_text_field($_POST[$field]));
            }
        }
    }
    add_action('save_post_sports_pick', 'ontariogamers_save_sports_meta');
    function ontariogamers_get_field($field_name, $post_id = null) {
        if (!$post_id) $post_id = get_the_ID();

        // If ACF is available, use it
        if (function_exists('get_field')) {
            return get_field($field_name, $post_id);
        }

        // Fallback to standard post meta
        return get_post_meta($post_id, $field_name, true);
    }
}
