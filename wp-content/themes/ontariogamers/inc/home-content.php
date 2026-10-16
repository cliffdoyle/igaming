<?php
/**
 * Homepage content shared between the template and structured data.
 */

if (!defined('ABSPATH')) {
    exit;
}

/**
 * FAQs for the homepage. Answers are plain text so they can be reused verbatim
 * in FAQPage schema (Google requires schema answers to match visible content).
 */
function ontariogamers_home_faqs() {
    return array(
        array(
            'q' => 'What Is the Best Online Casino in Ontario?',
            'a' => 'The best online casinos Ontario largely depend on what you prefer the most. However, for starters, casinos like BetMGM, bet365, FanDuel, LeoVegas, and Caesars are good starting points. To get the most out of the casino, ensure that you check each site’s current Ontario listing, payment options, games, bonus conditions, and responsible gambling tools.',
        ),
        array(
            'q' => 'Are Online Casinos Legal in Ontario?',
            'a' => 'Yes. Ontario has a regulated online gaming market that was launched in April 2022. Eligible adults who are 19 years and older can now use regulated gaming websites while they are physically located in Ontario. Therefore, if you are looking for legal online casinos Ontario, trust that you’ll find them as long as you meet the conditions mentioned above.',
        ),
        array(
            'q' => 'Which Ontario Casino Pays the Fastest?',
            'a' => 'To be honest, withdrawal times depend on the payment method, account verification, the operator’s processing procedures and the receiving bank or payment provider. Make a point of comparing official withdrawal rules and look for independently documented tests that distinguish casino processing from the time money takes to arrive in players’ accounts.',
        ),
        array(
            'q' => 'What Is the Minimum Deposit at an Ontario Online Casino?',
            'a' => 'The smallest amount you can deposit varies by casino, payment method, and promotion at hand. Some deals need a qualifying deposit that is higher than the casino’s usual minimum. Before you go ahead and deposit, check the cashier and the terms of the specific promotion.',
        ),
        array(
            'q' => 'Can I Use Interac at Online Casinos in Ontario?',
            'a' => 'Yes. This is because some Ontario casinos allow you to use Interac as a method of payment. However, availability of this option varies. Therefore, make sure you check the cashier on the official Ontario website to see which methods are supported by your selected casino. More importantly, confirm if the method can be used for both deposits and withdrawals.',
        ),
        array(
            'q' => 'Do Ontario Online Casinos Offer Welcome Bonuses?',
            'a' => 'Yes. Most casinos offer welcome promotions. Offers here include deposit matches, spins, or bonus funds. Each of these offers has its own conditions, expiry dates, and eligibility rules. Also, wagering requirements can apply before the winnings can become withdrawable.',
        ),
        array(
            'q' => 'Do I Need to Verify My Identity Before Withdrawing?',
            'a' => 'It depends. A casino may require you to verify your age, identity, and address before allowing you to withdraw funds. The exact requirements and timing largely depend on the operator and circumstances of the account.',
        ),
        array(
            'q' => 'Can I Play Ontario Online Casinos Outside Ontario?',
            'a' => 'No. You have to be physically located in Ontario for you to play Ontario online casino games. Being an Ontario resident or having an existing account does not, by itself, remove that location requirement. More importantly, avoid using tools intended to misrepresent your location.',
        ),
    );
}

/**
 * Small inline SVG icons (stroke style) for the homepage.
 */
function ontariogamers_icon($name) {
    $paths = array(
        'check'   => '<path d="M20 6 9 17l-5-5"/>',
        'clock'   => '<circle cx="12" cy="12" r="9"/><path d="M12 7v5l3 2"/>',
        'shield'  => '<path d="M12 3 4 6v6c0 5 3.5 8 8 9 4.5-1 8-4 8-9V6l-8-3Z"/><path d="m9 12 2 2 4-4"/>',
        'star'    => '<path d="m12 3 2.8 5.7 6.2.9-4.5 4.4 1 6.2L12 17.3 6.5 20.2l1-6.2L3 9.6l6.2-.9L12 3Z"/>',
        'alert'   => '<path d="M12 3 2 20h20L12 3Z"/><path d="M12 10v4M12 17h.01"/>',
        'game'    => '<rect x="2" y="7" width="20" height="11" rx="4"/><path d="M7 11v3M5.5 12.5h3M15 12h.01M18 13h.01"/>',
        'card'    => '<rect x="2" y="5" width="20" height="14" rx="2"/><path d="M2 10h20M6 15h4"/>',
        'gift'    => '<rect x="3" y="8" width="18" height="13" rx="1"/><path d="M12 8v13M3 12h18M12 8S10 3 7.5 4.5 9 8 12 8Zm0 0s2-5 4.5-3.5S15 8 12 8Z"/>',
        'search'  => '<circle cx="11" cy="11" r="7"/><path d="m20 20-3.5-3.5"/>',
        'phone'   => '<path d="M5 4h4l2 5-2.5 1.5a11 11 0 0 0 5 5L15 13l5 2v4a2 2 0 0 1-2 2A16 16 0 0 1 3 6a2 2 0 0 1 2-2Z"/>',
        'arrow'   => '<path d="M5 12h14M13 6l6 6-6 6"/>',
        'user'    => '<circle cx="12" cy="8" r="4"/><path d="M4 21a8 8 0 0 1 16 0"/>',
        'pin'     => '<path d="M12 21s7-6 7-12a7 7 0 0 0-14 0c0 6 7 12 7 12Z"/><circle cx="12" cy="9" r="2.5"/>',
        'scale'   => '<path d="M12 3v18M5 21h14M6 7h12M6 7l-3 7a3 3 0 0 0 6 0L6 7Zm12 0-3 7a3 3 0 0 0 6 0l-3-7Z"/>',
        'pause'   => '<circle cx="12" cy="12" r="9"/><path d="M10 9v6M14 9v6"/>',
        'stop'    => '<circle cx="12" cy="12" r="9"/><path d="m5.6 5.6 12.8 12.8"/>',
        'wallet'  => '<path d="M3 7a2 2 0 0 1 2-2h13v4"/><rect x="3" y="7" width="18" height="13" rx="2"/><path d="M16 13.5h.01"/>',
    );
    if (!isset($paths[$name])) {
        return '';
    }
    return '<svg class="hp-ico" viewBox="0 0 24 24" width="20" height="20" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true" focusable="false">' . $paths[$name] . '</svg>';
}

/**
 * Compact review row (logo · name · rating/withdrawal · Review + Play).
 * Must be called inside a post loop (casino_review or rated sports_pick).
 */
function ontariogamers_home_mini_row() {
    $id         = get_the_ID();
    $rating     = get_post_meta($id, 'casino_rating', true);
    $affiliate  = get_post_meta($id, 'casino_affiliate_url', true);
    $withdrawal = get_post_meta($id, 'casino_withdrawal_time', true);
    ?>
    <div class="hp-mini">
        <div class="hp-mini__logo"><?php echo ontariogamers_casino_logo_linked('casino-logo', 'casino-logo'); ?></div>
        <div class="hp-mini__info">
            <h3><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
            <p class="hp-mini__meta">
                <?php if ($rating) : ?><span><?php echo ontariogamers_icon('star'); ?><?php echo esc_html($rating); ?>/10</span><?php endif; ?>
                <?php if ($withdrawal) : ?><span><?php echo ontariogamers_icon('clock'); ?>Withdrawal: <?php echo esc_html($withdrawal); ?></span><?php endif; ?>
            </p>
        </div>
        <div class="hp-mini__cta">
            <a href="<?php the_permalink(); ?>" class="hp-btn hp-btn--outline hp-btn--sm">Review</a>
            <?php if ($affiliate) : ?>
                <a href="<?php echo esc_url($affiliate); ?>" class="hp-btn hp-btn--play hp-btn--sm" target="_blank" rel="<?php echo esc_attr(ontariogamers_aff_rel()); ?>">Play<span class="screen-reader-text"> at <?php echo esc_html(get_the_title()); ?> (opens in a new tab)</span></a>
            <?php endif; ?>
        </div>
    </div>
    <?php
}

/**
 * Homepage structured data: FAQPage + an ItemList of the ranked casinos.
 */
function ontariogamers_home_schema() {
    if (!is_front_page()) {
        return;
    }

    $faq = array();
    foreach (ontariogamers_home_faqs() as $item) {
        $faq[] = array(
            '@type'          => 'Question',
            'name'           => $item['q'],
            'acceptedAnswer' => array('@type' => 'Answer', 'text' => $item['a']),
        );
    }

    $list = array();
    if (function_exists('ontariogamers_top6_table_brands')) {
        $pos = 1;
        foreach (ontariogamers_top6_table_brands() as $b) {
            $list[] = array(
                '@type'    => 'ListItem',
                'position' => $pos++,
                'name'     => $b['title'],
                'url'      => home_url('/#review-' . $b['slug']),
            );
        }
    }

    $graph = array(
        array(
            '@type'      => 'FAQPage',
            '@id'        => home_url('/#faq'),
            'mainEntity' => $faq,
        ),
    );
    if ($list) {
        $graph[] = array(
            '@type'           => 'ItemList',
            '@id'             => home_url('/#top-6'),
            'name'            => 'Top 6 Best Online Casinos Ontario',
            'itemListOrder'   => 'https://schema.org/ItemListOrderAscending',
            'numberOfItems'   => count($list),
            'itemListElement' => $list,
        );
    }

    echo "\n" . '<script type="application/ld+json">'
        . wp_json_encode(array('@context' => 'https://schema.org', '@graph' => $graph), JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE)
        . '</script>' . "\n";
}
add_action('wp_head', 'ontariogamers_home_schema', 30);
