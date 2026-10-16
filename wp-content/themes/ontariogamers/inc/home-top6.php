<?php
/**
 * Homepage "Top 6" casinos — brand data + the wp-admin settings screen
 * (Appearance → Homepage Top 6).
 *
 * Editorial copy for each brand lives in code (ontariogamers_top6_defaults()).
 * Anything that changes often — affiliate links, logos, review links, proof
 * screenshots and the "tested/updated" date labels — is editable in wp-admin
 * and stored in the `og_home_top6` option.
 */

if (!defined('ABSPATH')) {
    exit;
}

const OG_TOP6_OPTION = 'og_home_top6';

/**
 * Default date labels. These are shown until real test dates are entered in
 * Appearance → Homepage Top 6.
 */
function ontariogamers_top6_date_defaults() {
    return array(
        'h1_suffix'    => 'Updated October 2026',
        'byline_date'  => 'Updated: October 2026',
        'table_suffix' => 'Updated October 2026',
    );
}

/**
 * The six brands, in the editorial order of the detailed reviews.
 * `table_pos` controls the order in the quick-comparison table.
 */
function ontariogamers_top6_defaults() {
    return array(
        'betmgm' => array(
            'name'        => 'BetMGM',
            'title'       => 'BetMGM Ontario',
            'official'    => 'https://casino.on.betmgm.ca/',
            'rating'      => '9.6',
            'payout'      => '6 hours 15 minutes',
            'payout_via'  => '',
            'payout_note' => 'Processing time varies – see official rules',
            'table_pos'   => 2,
            'badge'       => '',
            'cta'         => 'Play at BetMGM',
            'color'       => '#111111',
            'ink'         => '#d4b46a',
            'best_for'    => 'Overall premium experience and native app performance',
            'bonus'       => 'The bonus carries a 15x wagering requirement that is restricted to slot games, which have to be fully cleared within 14 days of activation.',
            'games'       => 'We tested Blazing Gold Blitz and 9 Masks of Fire. These two loaded quite fast (below 3 seconds) on iOS. They featured seamless portrait-mode optimization and zero frame-rate drops during high-animation bonus rounds.',
            'why'         => 'This casino offers the MGM Rewards program that integrates directly with physical casino perks – giving online play tangible real-world value. Also, the site’s native app features one of the most intuitive layouts on the market. When in use, players can have an easy time navigating from one point to another.',
            'drawback'    => 'Internal security screening mostly flags low-tier transactions for manual review – making payouts exceed the 3-hour mark.',
            'shot_caption'=> '',
            'review_slug' => '',
        ),
        'bet365' => array(
            'name'        => 'bet365',
            'title'       => 'bet365 Casino Ontario',
            'official'    => 'https://casino.on.bet365.ca/',
            'rating'      => '9.8',
            'payout'      => '1 hour 42 minutes',
            'payout_via'  => 'via Interac e-Transfer',
            'payout_note' => '',
            'table_pos'   => 1,
            'badge'       => 'Fastest payout',
            'cta'         => 'Play at bet365',
            'color'       => '#126e51',
            'ink'         => '#ffe418',
            'best_for'    => 'Instant payment processing and fast-loading interface',
            'bonus'       => 'Remember that a 20x wagering requirement applies to the deposit balance before funds can be converted to cash.',
            'games'       => 'We tested Gates of Olympus and Book of Dead. The site’s proprietary interface bypassed heavy graphic lag – delivering crisp, unthrottled performance even on a standard LTE mobile connection.',
            'why'         => 'Even if you are withdrawing an amount that is below $100, you’ll not be subjected to manual queries that can derail the entire payment process. This makes it easy to get your money within less than 2 hours after requesting a withdrawal.',
            'drawback'    => 'Slots catalogue relies more on established, traditional studios – as such, it lacks some of the niche, indie game releases found elsewhere.',
            'shot_caption'=> 'Deposit confirmation email recorded Dec 5, 2026 – redacted for privacy',
            'review_slug' => '',
        ),
        'fanduel' => array(
            'name'        => 'FanDuel',
            'title'       => 'FanDuel Casino Ontario',
            'official'    => 'https://casino.fanduel.ca/',
            'rating'      => '9.7',
            'payout'      => '2 hours 15 minutes',
            'payout_via'  => 'via Interac e-Transfer',
            'payout_note' => '',
            'table_pos'   => 3,
            'badge'       => '',
            'cta'         => 'Play at FanDuel',
            'color'       => '#0b74e5',
            'ink'         => '#ffffff',
            'best_for'    => 'Flawless mobile stability and rapid payout architecture',
            'bonus'       => 'An industry-low 1x playthrough requirement applies to all bonus spins.',
            'games'       => 'We spun reels on Sweet Bonanza and Wheel of Fortune Triple Extreme Spin. Thankfully, the bet configuration tools were highly responsive. Also, the game state recovered almost instantly when we simulated an incoming phone call during the gaming session.',
            'why'         => 'Its payout efficiency is unmatched. We were able to get money in our account in less than 3 hours. There was no need for repetitive identity uploads. The standalone casino app also works well and does not drain the battery even during extended gaming sessions.',
            'drawback'    => 'Progressive jackpot slots are not as many. This makes the site less ideal for players interested in chasing massive multi-million-dollar prize wheels.',
            'shot_caption'=> '',
            'review_slug' => '',
        ),
        'leovegas' => array(
            'name'        => 'LeoVegas',
            'title'       => 'LeoVegas Casino Ontario',
            'official'    => 'https://www.leovegas.com/en-ca/',
            'rating'      => '9.5',
            'payout'      => '2 hours 30 minutes',
            'payout_via'  => 'via e-Transfer',
            'payout_note' => '',
            'table_pos'   => 4,
            'badge'       => '',
            'cta'         => 'Play at LeoVegas',
            'color'       => '#ff6a00',
            'ink'         => '#ffffff',
            'best_for'    => 'Mobile-first priority and independent game portfolios',
            'bonus'       => 'A 25x wagering requirement applies before bonus cash can be released.',
            'games'       => 'Our team actively tested Amazing Link Apollo and Starburst XXXtreme. The site’s mobile version worked identically to the app – scaling perfectly across multiple Android tablet and smartphone screens.',
            'why'         => 'By offering more than 3,200 slot titles, the casino secures its place among the best online casinos Ontario. Also, its ‘Multy’ view allows you to run 2 slot titles at the same time whenever you’re using a tablet. While at it, you’ll not experience any software glitches.',
            'drawback'    => 'Sometimes, the live chat customer support queue faces high traffic. As a result, you might have to wait up to 15 minutes during peak weekend evening hours.',
            'shot_caption'=> '',
            'review_slug' => '',
        ),
        'caesars' => array(
            'name'        => 'Caesars Palace',
            'title'       => 'Caesars Palace Online Casino Ontario',
            'official'    => 'https://caesarspalaceonline.com/on',
            'rating'      => '9.4',
            'payout'      => '3 hours 10 minutes',
            'payout_via'  => 'through Interac e-Transfer',
            'payout_note' => '',
            'table_pos'   => 5,
            'badge'       => '',
            'cta'         => 'Play at Caesars Palace',
            'color'       => '#0f1d33',
            'ink'         => '#c9a95c',
            'best_for'    => 'High-roller limits and retail brand integration',
            'bonus'       => 'The welcome promo needs a 15x wagering playthrough on slot games – which can scale up to 75x if you attempt to clear it on blackjack tables.',
            'games'       => 'We tested Big Bass Bonanza and Thunderstruck II. Here, high-stakes wagering paths are clearly mapped out. Also, the graphical user interface handles sudden shifts in bet sizes without forcing reload screens.',
            'why'         => 'The tier-system crossover with Caesars Rewards is exceptional – making it highly lucrative for players who travel to physical Windsor or Niagara gaming properties. Also, the table game variant section has exclusive, custom-branded Caesars roulette and blackjack layouts that offer a more refined atmosphere.',
            'drawback'    => 'Sometimes, you have to keep scrolling and clicking to filter through game categories.',
            'shot_caption'=> '',
            'review_slug' => '',
        ),
        'northstar' => array(
            'name'        => 'NorthStar Bets',
            'title'       => 'NorthStar Bets Ontario',
            'official'    => 'https://www.northstarbets.ca/casino',
            'rating'      => '9.3',
            'payout'      => '4 hours 45 minutes',
            'payout_via'  => 'via Interac e-Transfer',
            'payout_note' => '',
            'table_pos'   => 6,
            'badge'       => '',
            'cta'         => 'Play at NorthStar Bets',
            'color'       => '#0a2540',
            'ink'         => '#5fd4c4',
            'best_for'    => 'Custom Ontario localization and specialized content',
            'bonus'       => 'A 15x wagering requirement applies to the casino’s welcome bonus.',
            'games'       => 'Our team tested Buffalo Blitz and Shark Blitz. The integration of local insights next to the gaming window offers a unique, highly personalized gaming environment.',
            'why'         => 'The site is built explicitly for the local market. Here, you’ll get Canadian-themed promotions and games that local players like. The customer service team is also excellent when it comes to addressing various player issues.',
            'drawback'    => 'The casino operates on fixed batch-processing timelines for withdrawals – meaning that if you miss a payout window, your transaction may sit pending for several hours.',
            'shot_caption'=> '',
            'review_slug' => 'northstar-bets-casino',
        ),
    );
}

/**
 * Saved settings merged over defaults.
 */
function ontariogamers_top6_settings() {
    $saved = get_option(OG_TOP6_OPTION, array());
    return is_array($saved) ? $saved : array();
}

/**
 * A date label (h1_suffix | byline_date | table_suffix).
 */
function ontariogamers_top6_date($key) {
    $defaults = ontariogamers_top6_date_defaults();
    $saved    = ontariogamers_top6_settings();
    $value    = isset($saved[$key]) ? trim((string) $saved[$key]) : '';
    return '' !== $value ? $value : (isset($defaults[$key]) ? $defaults[$key] : '');
}

/**
 * Fully resolved brands (defaults + wp-admin overrides + linked review post),
 * in review order. Each brand gains: slug, play_url, is_affiliate, logo_html,
 * review_url, shot_html.
 */
function ontariogamers_top6_brands() {
    static $cache = null;
    if (null !== $cache) {
        return $cache;
    }

    $saved_all = ontariogamers_top6_settings();
    $saved_all = isset($saved_all['brands']) && is_array($saved_all['brands']) ? $saved_all['brands'] : array();
    $brands    = array();

    foreach (ontariogamers_top6_defaults() as $slug => $b) {
        $s = isset($saved_all[$slug]) && is_array($saved_all[$slug]) ? $saved_all[$slug] : array();

        // Fall back to an existing casino_review post for the same brand.
        $post = $b['review_slug'] ? get_page_by_path($b['review_slug'], OBJECT, 'casino_review') : null;
        if ($post && 'publish' !== $post->post_status) {
            $post = null;
        }

        $aff = !empty($s['aff']) ? $s['aff'] : ($post ? (string) get_post_meta($post->ID, 'casino_affiliate_url', true) : '');

        $b['slug']         = $slug;
        $b['is_affiliate'] = '' !== $aff;
        $b['play_url']     = $b['is_affiliate'] ? $aff : $b['official'];
        $b['review_url']   = !empty($s['review_url']) ? $s['review_url'] : ($post ? get_permalink($post) : '');

        $logo_id = !empty($s['logo_id']) ? (int) $s['logo_id'] : ($post ? (int) get_post_thumbnail_id($post) : 0);
        $b['logo_html'] = $logo_id
            ? wp_get_attachment_image($logo_id, 'casino-logo', false, array(
                'class'   => 'hp-logo-img',
                'alt'     => $b['name'] . ' logo',
                'loading' => 'lazy',
            ))
            : '';

        $shot_id = !empty($s['shot_id']) ? (int) $s['shot_id'] : 0;
        if (!empty($s['shot_caption'])) {
            $b['shot_caption'] = $s['shot_caption'];
        }
        $b['shot_html'] = $shot_id
            ? wp_get_attachment_image($shot_id, 'large', false, array(
                'class'   => 'hp-shot-img',
                'alt'     => $b['shot_caption'] ? $b['shot_caption'] : $b['name'] . ' test screenshot',
                'loading' => 'lazy',
            ))
            : '';

        $brands[$slug] = $b;
    }

    $cache = $brands;
    return $brands;
}

/**
 * Brands sorted for the quick-comparison table.
 */
function ontariogamers_top6_table_brands() {
    $brands = ontariogamers_top6_brands();
    uasort($brands, function ($a, $b) {
        return (int) $a['table_pos'] - (int) $b['table_pos'];
    });
    return $brands;
}

/**
 * Logo: uploaded image, or a branded wordmark tile so the page never looks
 * broken before logos are uploaded.
 */
function ontariogamers_top6_logo($brand, $size = 'md') {
    $class = 'hp-logo hp-logo--' . $size;
    if ($brand['logo_html']) {
        return '<span class="' . esc_attr($class) . ' has-img">' . $brand['logo_html'] . '</span>';
    }
    return '<span class="' . esc_attr($class) . '" style="--brand:' . esc_attr($brand['color']) . ';--brand-ink:' . esc_attr($brand['ink']) . '" role="img" aria-label="' . esc_attr($brand['name'] . ' logo') . '">'
        . esc_html($brand['name'])
        . '</span>';
}

/**
 * The outbound "Play" link. Affiliate links are marked sponsored.
 */
function ontariogamers_top6_play_link($brand, $label, $class = 'hp-btn hp-btn--play') {
    $rel = $brand['is_affiliate'] ? ontariogamers_aff_rel() : 'nofollow noopener noreferrer';
    return '<a href="' . esc_url($brand['play_url']) . '" class="' . esc_attr($class) . '" target="_blank" rel="' . esc_attr($rel) . '">'
        . esc_html($label)
        . '<span class="screen-reader-text"> (opens in a new tab)</span></a>';
}

/* ---------------------------------------------------------------------------
 * [og_play brand="bet365" label="Play at bet365"] — use in any article so its
 * Play buttons share the affiliate link set in Appearance → Homepage Top 6.
 * Brands: betmgm, bet365, fanduel, leovegas, caesars, northstar.
 * ------------------------------------------------------------------------ */
function ontariogamers_play_shortcode($atts) {
    $atts   = shortcode_atts(array('brand' => '', 'label' => '', 'size' => ''), $atts, 'og_play');
    $brands = ontariogamers_top6_brands();
    $slug   = sanitize_key($atts['brand']);
    if (!isset($brands[$slug])) {
        return '';
    }
    $b     = $brands[$slug];
    $label = '' !== $atts['label'] ? $atts['label'] : $b['cta'];
    $class = 'og-play-btn' . ('small' === $atts['size'] ? ' og-play-btn--sm' : '');
    return ontariogamers_top6_play_link($b, $label, $class);
}
add_shortcode('og_play', 'ontariogamers_play_shortcode');

/**
 * [og_logo brand="bet365" size="sm|lg"] — brand logo (uploaded in Homepage Top 6)
 * or the branded name tile.
 */
function ontariogamers_logo_shortcode($atts) {
    $atts   = shortcode_atts(array('brand' => '', 'size' => 'sm'), $atts, 'og_logo');
    $brands = ontariogamers_top6_brands();
    $slug   = sanitize_key($atts['brand']);
    if (!isset($brands[$slug])) {
        return '';
    }
    return ontariogamers_top6_logo($brands[$slug], 'lg' === $atts['size'] ? 'lg' : 'sm');
}
add_shortcode('og_logo', 'ontariogamers_logo_shortcode');

/* ---------------------------------------------------------------------------
 * wp-admin: Appearance → Homepage Top 6
 * ------------------------------------------------------------------------ */

function ontariogamers_top6_admin_menu() {
    add_theme_page(
        'Homepage Top 6 Casinos',
        'Homepage Top 6',
        'edit_theme_options',
        'og-homepage-top6',
        'ontariogamers_top6_admin_page'
    );
}
add_action('admin_menu', 'ontariogamers_top6_admin_menu');

function ontariogamers_top6_register_setting() {
    register_setting('og_home_top6_group', OG_TOP6_OPTION, array(
        'type'              => 'array',
        'sanitize_callback' => 'ontariogamers_top6_sanitize',
        'default'           => array(),
    ));
}
add_action('admin_init', 'ontariogamers_top6_register_setting');

function ontariogamers_top6_sanitize($input) {
    $out = array();
    foreach (array_keys(ontariogamers_top6_date_defaults()) as $key) {
        $out[$key] = isset($input[$key]) ? sanitize_text_field($input[$key]) : '';
    }
    $out['brands'] = array();
    foreach (array_keys(ontariogamers_top6_defaults()) as $slug) {
        $b = isset($input['brands'][$slug]) && is_array($input['brands'][$slug]) ? $input['brands'][$slug] : array();
        $out['brands'][$slug] = array(
            'aff'          => isset($b['aff']) ? esc_url_raw(trim($b['aff'])) : '',
            'review_url'   => isset($b['review_url']) ? esc_url_raw(trim($b['review_url'])) : '',
            'logo_id'      => isset($b['logo_id']) ? absint($b['logo_id']) : 0,
            'shot_id'      => isset($b['shot_id']) ? absint($b['shot_id']) : 0,
            'shot_caption' => isset($b['shot_caption']) ? sanitize_text_field($b['shot_caption']) : '',
        );
    }
    return $out;
}

function ontariogamers_top6_admin_assets($hook) {
    if ('appearance_page_og-homepage-top6' !== $hook) {
        return;
    }
    wp_enqueue_media();
    $js = <<<'JS'
document.addEventListener('click', function (e) {
    var pick = e.target.closest('.og-media-pick');
    var clear = e.target.closest('.og-media-clear');
    if (!pick && !clear) { return; }
    e.preventDefault();
    var wrap = (pick || clear).closest('.og-media');
    var input = wrap.querySelector('input[type=hidden]');
    var preview = wrap.querySelector('.og-media-preview');
    if (clear) { input.value = ''; preview.innerHTML = ''; return; }
    var frame = wp.media({ title: pick.dataset.title, button: { text: 'Use this image' }, library: { type: 'image' }, multiple: false });
    frame.on('select', function () {
        var a = frame.state().get('selection').first().toJSON();
        var url = (a.sizes && a.sizes.thumbnail) ? a.sizes.thumbnail.url : a.url;
        input.value = a.id;
        preview.innerHTML = '<img src="' + url + '" alt="">';
    });
    frame.open();
});
JS;
    wp_add_inline_script('media-editor', $js);
    wp_add_inline_style('wp-admin', '
        .og-top6 .og-brand{background:#fff;border:1px solid #dcdcde;border-radius:6px;padding:16px 20px;margin:0 0 16px}
        .og-top6 .og-brand h2{margin:0 0 4px;font-size:1.15em}
        .og-top6 .og-brand .og-sub{color:#646970;margin:0 0 12px}
        .og-top6 .form-table th{width:190px;padding:10px 10px 10px 0}
        .og-top6 .form-table td{padding:8px 10px}
        .og-media{display:flex;align-items:center;gap:10px;flex-wrap:wrap}
        .og-media-preview img{max-width:80px;max-height:80px;border:1px solid #dcdcde;border-radius:4px;background:#f6f7f7;display:block}
        .og-status{display:inline-block;padding:2px 8px;border-radius:10px;font-size:12px;font-weight:600}
        .og-status.ok{background:#d1f3dc;color:#0a6b2d}.og-status.warn{background:#fcf0d0;color:#7a5500}
    ');
}
add_action('admin_enqueue_scripts', 'ontariogamers_top6_admin_assets');

function ontariogamers_top6_media_field($name, $id, $title) {
    $img = $id ? wp_get_attachment_image($id, 'thumbnail') : '';
    ?>
    <div class="og-media">
        <input type="hidden" name="<?php echo esc_attr($name); ?>" value="<?php echo $id ? (int) $id : ''; ?>">
        <span class="og-media-preview"><?php echo $img; ?></span>
        <button type="button" class="button og-media-pick" data-title="<?php echo esc_attr($title); ?>">Select image</button>
        <button type="button" class="button-link og-media-clear">Remove</button>
    </div>
    <?php
}

function ontariogamers_top6_admin_page() {
    if (!current_user_can('edit_theme_options')) {
        return;
    }
    $saved  = ontariogamers_top6_settings();
    $dates  = ontariogamers_top6_date_defaults();
    $brands = ontariogamers_top6_brands();
    $sb     = isset($saved['brands']) ? $saved['brands'] : array();
    $opt    = OG_TOP6_OPTION;
    ?>
    <div class="wrap og-top6">
        <h1>Homepage Top 6 Casinos</h1>
        <p>Controls the comparison table and the six detailed casino reviews on the homepage. The affiliate links here are also used by the <code>[og_play brand="…"]</code> buttons inside Payment Method guides, so each link only has to be entered once. The review text itself is maintained by the developer; everything below can be changed here at any time. <a href="<?php echo esc_url(home_url('/')); ?>" target="_blank">View homepage &rarr;</a></p>

        <form method="post" action="options.php">
            <?php settings_fields('og_home_top6_group'); ?>

            <div class="og-brand">
                <h2>Test dates shown on the page</h2>
                <p class="og-sub">Only enter test dates once the testing has actually happened. Leave a box empty to use the default shown in grey.</p>
                <table class="form-table" role="presentation">
                    <tr>
                        <th scope="row"><label for="og-h1">Headline ending</label></th>
                        <td><input id="og-h1" type="text" class="regular-text" name="<?php echo esc_attr($opt); ?>[h1_suffix]" value="<?php echo esc_attr(isset($saved['h1_suffix']) ? $saved['h1_suffix'] : ''); ?>" placeholder="<?php echo esc_attr($dates['h1_suffix']); ?>">
                        <p class="description">“Best Online Casinos Ontario – <em>this text</em>”. e.g. <code>Tested &amp; Ranked December 2026</code></p></td>
                    </tr>
                    <tr>
                        <th scope="row"><label for="og-by">Author box date</label></th>
                        <td><input id="og-by" type="text" class="regular-text" name="<?php echo esc_attr($opt); ?>[byline_date]" value="<?php echo esc_attr(isset($saved['byline_date']) ? $saved['byline_date'] : ''); ?>" placeholder="<?php echo esc_attr($dates['byline_date']); ?>">
                        <p class="description">e.g. <code>Tested: Dec 5-7, 2026</code></p></td>
                    </tr>
                    <tr>
                        <th scope="row"><label for="og-tbl">Comparison table heading ending</label></th>
                        <td><input id="og-tbl" type="text" class="regular-text" name="<?php echo esc_attr($opt); ?>[table_suffix]" value="<?php echo esc_attr(isset($saved['table_suffix']) ? $saved['table_suffix'] : ''); ?>" placeholder="<?php echo esc_attr($dates['table_suffix']); ?>">
                        <p class="description">e.g. <code>Tests Completed Dec 7, 2026</code></p></td>
                    </tr>
                </table>
            </div>

            <?php foreach ($brands as $slug => $b) :
                $s    = isset($sb[$slug]) ? $sb[$slug] : array();
                $base = $opt . '[brands][' . $slug . ']';
                ?>
                <div class="og-brand">
                    <h2><?php echo esc_html($b['title']); ?>
                        <?php if ($b['is_affiliate']) : ?>
                            <span class="og-status ok">Affiliate link active</span>
                        <?php else : ?>
                            <span class="og-status warn">No affiliate link — Play button goes to official site</span>
                        <?php endif; ?>
                    </h2>
                    <p class="og-sub">Rating <?php echo esc_html($b['rating']); ?>/10 · Payout tested <?php echo esc_html($b['payout']); ?></p>
                    <table class="form-table" role="presentation">
                        <tr>
                            <th scope="row">Affiliate link</th>
                            <td><input type="url" class="large-text" name="<?php echo esc_attr($base); ?>[aff]" value="<?php echo esc_attr(isset($s['aff']) ? $s['aff'] : ''); ?>" placeholder="https://…">
                            <p class="description">Used by every “Play” button for this brand. If empty: <code><?php echo esc_html($b['official']); ?></code></p></td>
                        </tr>
                        <tr>
                            <th scope="row">Logo</th>
                            <td><?php ontariogamers_top6_media_field($base . '[logo_id]', isset($s['logo_id']) ? (int) $s['logo_id'] : 0, $b['name'] . ' logo'); ?>
                            <p class="description">Square image works best. Without one, a branded name tile is shown.</p></td>
                        </tr>
                        <tr>
                            <th scope="row">Full review link</th>
                            <td><input type="url" class="large-text" name="<?php echo esc_attr($base); ?>[review_url]" value="<?php echo esc_attr(isset($s['review_url']) ? $s['review_url'] : ''); ?>" placeholder="<?php echo esc_attr($b['review_url'] ? $b['review_url'] : 'Optional – adds a “Read full review” button'); ?>"></td>
                        </tr>
                        <tr>
                            <th scope="row">Proof screenshot</th>
                            <td><?php ontariogamers_top6_media_field($base . '[shot_id]', isset($s['shot_id']) ? (int) $s['shot_id'] : 0, $b['name'] . ' screenshot'); ?>
                            <p class="description">Optional. Redact personal/banking details before uploading.</p></td>
                        </tr>
                        <tr>
                            <th scope="row">Screenshot caption</th>
                            <td><input type="text" class="large-text" name="<?php echo esc_attr($base); ?>[shot_caption]" value="<?php echo esc_attr(isset($s['shot_caption']) ? $s['shot_caption'] : ''); ?>" placeholder="<?php echo esc_attr($b['shot_caption'] ? $b['shot_caption'] : 'e.g. Withdrawal confirmation – redacted for privacy'); ?>"></td>
                        </tr>
                    </table>
                </div>
            <?php endforeach; ?>

            <?php submit_button('Save homepage settings'); ?>
        </form>
    </div>
    <?php
}
