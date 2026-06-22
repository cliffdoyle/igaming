<?php
/**
 * Authors / Bylines
 *
 * - Adds a LinkedIn field to user profiles.
 * - Provides author avatars without Gravatar (custom photo URL, or an
 *   auto-generated initials avatar so every author always has a picture).
 * - Seeds the site's two writers (Vanessa Phillimore + George Owens) with bios
 *   and LinkedIn links, idempotently (safe to run on every load).
 *
 * Authors appear on each article byline, in the article author box, and on their
 * own author archive page at /author/<name>/ (styled in the theme's author.php).
 */

if (!defined('ABSPATH')) {
    exit;
}

/**
 * Add LinkedIn (and a public email) to the profile contact fields.
 * Appears under Users → Profile → "Contact Info".
 */
function ontariogamers_author_contactmethods($methods) {
    $methods['linkedin']      = 'LinkedIn Profile URL';
    $methods['public_email']  = 'Public Email (shown on author page)';
    $methods['author_role']   = 'Author Title (e.g. Slots Writer)';
    return $methods;
}
add_filter('user_contactmethods', 'ontariogamers_author_contactmethods');

/**
 * Build a base64 SVG "initials" avatar so an author always has a real picture
 * even before they upload a photo. Green tile, gold initials (brand colours).
 */
function ontariogamers_author_initials_avatar($name, $size = 120) {
    $parts = preg_split('/\s+/', trim((string) $name));
    $initials = '';
    foreach ($parts as $p) {
        if ($p !== '') {
            $initials .= strtoupper(substr($p, 0, 1));
        }
        if (strlen($initials) >= 2) {
            break;
        }
    }
    if ($initials === '') {
        $initials = 'OG';
    }
    $font = max(18, (int) round($size * 0.4));
    $svg  = '<svg xmlns="http://www.w3.org/2000/svg" width="' . $size . '" height="' . $size . '" viewBox="0 0 120 120">'
          . '<rect width="120" height="120" fill="#1a472a"/>'
          . '<text x="50%" y="50%" dy=".35em" text-anchor="middle" '
          . 'font-family="Arial,Helvetica,sans-serif" font-size="48" font-weight="700" fill="#f5a623">'
          . esc_html($initials) . '</text></svg>';
    unset($font); // size is fixed via viewBox scaling
    return 'data:image/svg+xml;base64,' . base64_encode($svg);
}

/**
 * Resolve a WP_User from whatever get_avatar_data() passes in.
 */
function ontariogamers_resolve_avatar_user($id_or_email) {
    if (is_numeric($id_or_email)) {
        return get_user_by('id', (int) $id_or_email);
    }
    if ($id_or_email instanceof WP_User) {
        return $id_or_email;
    }
    if ($id_or_email instanceof WP_Post) {
        return get_user_by('id', (int) $id_or_email->post_author);
    }
    if ($id_or_email instanceof WP_Comment) {
        if (!empty($id_or_email->user_id)) {
            return get_user_by('id', (int) $id_or_email->user_id);
        }
        return false;
    }
    if (is_string($id_or_email) && is_email($id_or_email)) {
        return get_user_by('email', $id_or_email);
    }
    return false;
}

/**
 * Use a custom photo (user meta 'og_avatar_url') if set. Note: the auto-generated
 * initials avatar is applied in the get_avatar() HTML filter below, because
 * esc_url() (used on the avatar data array) strips data: URIs.
 */
function ontariogamers_custom_avatar($args, $id_or_email) {
    $user = ontariogamers_resolve_avatar_user($id_or_email);
    if (!$user) {
        return $args;
    }
    $custom = get_user_meta($user->ID, 'og_avatar_url', true);
    if ($custom) {
        $args['url']          = $custom;
        $args['found_avatar'] = true;
    }
    return $args;
}
add_filter('pre_get_avatar_data', 'ontariogamers_custom_avatar', 10, 2);

/**
 * Final HTML pass: if an author has no custom photo, render an initials SVG
 * avatar (data URI) so every author always shows a real picture. We build the
 * <img> here and escape the src with esc_attr (which keeps data: URIs intact).
 */
function ontariogamers_avatar_html($avatar, $id_or_email, $size, $default, $alt, $args = array()) {
    $user = ontariogamers_resolve_avatar_user($id_or_email);
    if (!$user) {
        return $avatar;
    }
    // A custom photo URL was set — leave WordPress's normal output alone.
    if (get_user_meta($user->ID, 'og_avatar_url', true)) {
        return $avatar;
    }
    $url   = ontariogamers_author_initials_avatar($user->display_name, $size);
    $class = 'avatar avatar-' . (int) $size . ' photo og-avatar';
    return sprintf(
        '<img alt="%s" src="%s" class="%s" height="%d" width="%d" decoding="async" />',
        esc_attr($alt),
        esc_attr($url),
        esc_attr($class),
        (int) $size,
        (int) $size
    );
}
add_filter('get_avatar', 'ontariogamers_avatar_html', 10, 6);

/**
 * Add a "Profile Picture URL" field to the user profile screen so admins can
 * paste a photo (e.g. from the Media Library) without a plugin.
 */
function ontariogamers_author_avatar_field($user) {
    $val = esc_attr(get_user_meta($user->ID, 'og_avatar_url', true));
    ?>
    <h2>Profile Picture</h2>
    <table class="form-table" role="presentation">
        <tr>
            <th><label for="og_avatar_url">Profile Picture URL</label></th>
            <td>
                <input type="url" name="og_avatar_url" id="og_avatar_url" value="<?php echo $val; ?>" class="regular-text" placeholder="https://ontariogamers.ca/wp-content/uploads/…" />
                <p class="description">Paste an image URL (upload it under <strong>Media</strong> first, then copy its URL). Leave blank to use the auto-generated initials picture.</p>
            </td>
        </tr>
    </table>
    <?php
}
add_action('show_user_profile', 'ontariogamers_author_avatar_field');
add_action('edit_user_profile', 'ontariogamers_author_avatar_field');

function ontariogamers_save_author_avatar_field($user_id) {
    if (!current_user_can('edit_user', $user_id)) {
        return;
    }
    if (isset($_POST['og_avatar_url'])) {
        update_user_meta($user_id, 'og_avatar_url', esc_url_raw(wp_unslash($_POST['og_avatar_url'])));
    }
}
add_action('personal_options_update', 'ontariogamers_save_author_avatar_field');
add_action('edit_user_profile_update', 'ontariogamers_save_author_avatar_field');

/**
 * Seed the two site writers with display names, bios and LinkedIn links.
 * Idempotent via an option lock; bump the version to re-apply changes.
 */
function ontariogamers_seed_authors() {
    if (get_option('og_authors_seed_v1')) {
        return;
    }
    add_option('og_authors_seed_v1', 1, '', 'no');

    // --- Vanessa Phillimore: the existing admin account, renamed for bylines ---
    $vanessa = get_user_by('login', 'philimorevanessa');
    if ($vanessa) {
        wp_update_user(array(
            'ID'           => $vanessa->ID,
            'first_name'   => 'Vanessa',
            'last_name'    => 'Phillimore',
            'display_name' => 'Vanessa Phillimore',
            'nickname'     => 'Vanessa Phillimore',
            'description'  => 'Vanessa Phillimore is an experienced online casino content writer with a passion for clear, trustworthy guides that connect Ontario players with safe, regulated gaming. From casino and slot reviews to industry news and responsible-gambling advice, she pairs careful research with an engaging writing style that keeps readers informed.',
        ));
        update_user_meta($vanessa->ID, 'linkedin', 'https://www.linkedin.com/in/vanessa-phillimore-53308a352/');
        update_user_meta($vanessa->ID, 'author_role', 'Senior Casino & Slots Writer');
    }

    // --- George Owens: create as an Author if missing ---
    $george = get_user_by('login', 'georgeowens');
    if (!$george) {
        $new_id = wp_insert_user(array(
            'user_login'   => 'georgeowens',
            'user_pass'    => wp_generate_password(24, true, true),
            'user_email'   => 'george.owens@ontariogamers.ca',
            'first_name'   => 'George',
            'last_name'    => 'Owens',
            'display_name' => 'George Owens',
            'nickname'     => 'George Owens',
            'role'         => 'author',
            'description'  => 'George Owens is a sports-betting and iGaming writer covering the Ontario market. He breaks down odds, betting strategy and the latest operator news, with a focus on helping readers bet smarter and stay within the AGCO-regulated, responsible-gambling framework.',
        ));
        if (!is_wp_error($new_id)) {
            $george = get_user_by('id', $new_id);
        }
    }
    if ($george && !is_wp_error($george)) {
        update_user_meta($george->ID, 'linkedin', 'https://www.linkedin.com/in/george-owens-b051aa328');
        update_user_meta($george->ID, 'author_role', 'Sports Betting & News Writer');

        // Give George at least one published article so his author page works.
        $post = get_page_by_path('how-to-read-slot-rtp-guide', OBJECT, 'post');
        if ($post && (int) $post->post_author !== (int) $george->ID) {
            wp_update_post(array('ID' => $post->ID, 'post_author' => $george->ID));
        }
    }
}
add_action('init', 'ontariogamers_seed_authors', 24);

/**
 * Helper used by the theme: the author's title/role line.
 */
function ontariogamers_author_role($user_id) {
    $role = get_user_meta($user_id, 'author_role', true);
    return $role ? $role : 'Writer — OntarioGamers.ca';
}
