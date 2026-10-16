<?php
/**
 * Payment Methods guides — seeding of launch content.
 *
 * Guides are the `payment_guide` post type (/payment-methods/<slug>/). Content
 * is stored as Gutenberg blocks so editors can change the wording in wp-admin:
 * headings, paragraphs and lists are normal blocks; the comparison table,
 * casino cards and FAQ are "Custom HTML" blocks. Play buttons use the
 * [og_play brand="…"] shortcode, which reads affiliate links from
 * Appearance → Homepage Top 6.
 *
 * Post meta used by the theme/SEO:
 *   og_seo_title    – <title> override
 *   og_byline_note  – text after the author in the byline (e.g. "Tested Oct 1-3, 2026")
 */

if (!defined('ABSPATH')) {
    exit;
}

/* --- tiny Gutenberg block builders ------------------------------------- */

function og_blk_p($html) {
    return "<!-- wp:paragraph -->\n<p>" . $html . "</p>\n<!-- /wp:paragraph -->\n\n";
}

function og_blk_h($text, $level = 2, $anchor = '') {
    $attrs = array();
    if (2 !== $level) {
        $attrs['level'] = $level;
    }
    $json = $attrs ? ' ' . wp_json_encode($attrs) : '';
    $id   = $anchor ? ' id="' . esc_attr($anchor) . '"' : '';
    return "<!-- wp:heading{$json} -->\n<h{$level} class=\"wp-block-heading\"{$id}>" . $text . "</h{$level}>\n<!-- /wp:heading -->\n\n";
}

function og_blk_ul(array $items) {
    $out = "<!-- wp:list -->\n<ul class=\"wp-block-list\">";
    foreach ($items as $item) {
        $out .= "<!-- wp:list-item -->\n<li>" . $item . "</li>\n<!-- /wp:list-item -->";
    }
    return $out . "</ul>\n<!-- /wp:list -->\n\n";
}

function og_blk_html($html) {
    return "<!-- wp:html -->\n" . trim($html) . "\n<!-- /wp:html -->\n\n";
}

/* --- Interac guide ------------------------------------------------------ */

function ontariogamers_interac_guide_content() {
    $c = '';

    $c .= og_blk_html('
<ul class="og-trust-strip"><li class="is-age">19+</li><li>AGCO Licensed Only</li><li>5 casinos tested with real money</li><li>$20 Interac e-Transfer via TD Bank</li></ul>');

    $c .= og_blk_p('We deposited $20 via Interac at 6 AGCO sites. Fastest: bet365 1h 42m payout. Below is what happened with Interac specifically. 19+ | AGCO Licensed Only');

    /* Quick comparison ---------------------------------------------------- */
    $c .= og_blk_h('Quick Comparison – Interac Deposit &amp; Withdrawal Times – Tests Completed Oct 3, 2026', 2, 'comparison');
    $c .= og_blk_p('When choosing between Interac casinos Ontario players can access, transaction speed is one of the defining factors. The table below outlines our direct testing data using a standardized $20 Interac deposit rail. For us to remain compliant with strict local advertising regulations, we have omitted bonus dollar values. Instead, our focus is entirely on transaction speeds and operational thresholds.');

    $rows = array(
        array('bet365', 'bet365', '$10', '23 seconds', '1 hour 42 minutes', 'Play at bet365', true),
        array('fanduel', 'FanDuel', '$10', '45 seconds', '2 hours 15 minutes', 'Play at FanDuel', false),
        array('leovegas', 'LeoVegas', '$10', '31 seconds', '2 hours 30 minutes', 'Play at LeoVegas', false),
        array('caesars', 'Caesars Palace', '$10', '58 seconds', '3 hours 10 minutes', 'Play at Caesars Palace', false),
        array('northstar', 'NorthStar Bets', '$10', '40 seconds', '4 hours 45 minutes', 'Play at NorthStar Bets', false),
    );
    $t  = '<div class="og-compare-wrap"><table class="og-compare">';
    $t .= '<caption class="screen-reader-text">Interac deposit and withdrawal times tested at 5 Ontario casinos</caption>';
    $t .= '<thead><tr><th scope="col">Casino</th><th scope="col">Interac Minimum Deposit</th><th scope="col">Interac Deposit Time (Tested)</th><th scope="col">Interac Withdrawal Time (Tested)</th><th scope="col">Fees</th><th scope="col"><span class="screen-reader-text">Play</span></th></tr></thead><tbody>';
    foreach ($rows as $r) {
        $t .= '<tr' . ($r[6] ? ' class="is-featured"' : '') . '>'
            . '<th scope="row" class="og-compare__casino">[og_logo brand="' . $r[0] . '"]<span><strong>' . $r[1] . '</strong>' . ($r[6] ? '<em class="og-badge">Fastest</em>' : '') . '<a href="#interac-' . $r[0] . '">Read our test</a></span></th>'
            . '<td data-label="Min deposit">' . $r[2] . '</td>'
            . '<td data-label="Deposit time">' . $r[3] . '</td>'
            . '<td data-label="Withdrawal time"><strong>' . $r[4] . '</strong></td>'
            . '<td data-label="Fees"><span class="og-pill og-pill--good">No fee</span></td>'
            . '<td class="og-compare__cta">[og_play brand="' . $r[0] . '" label="' . $r[5] . '" size="small"]</td>'
            . '</tr>';
    }
    $t .= '</tbody></table></div>';
    $c .= og_blk_html($t);

    $c .= og_blk_html('<p class="og-note"><strong>Testing methodology:</strong> $20 Interac e-Transfer deposits via TD Bank, Oct 1-3, 2026 by Ontario contributor. Times reflect our test only. 19+ Ontario only. All operators AGCO licensed.</p>');

    /* How we tested -------------------------------------------------------- */
    $c .= og_blk_h('How We Tested Interac in Ontario', 2, 'how-we-tested');
    $c .= og_blk_p('To offer a fully transparent look at casinos with Interac Ontario, we avoided relying on corporate press releases and third-party reviews. Instead, we executed a live, multi-stage testing methodology on the 5 best online casinos that allow players to use Interac for payment processes. Our tester, Vanessa, used her personal banking infrastructure to document every delay, fee, and processing checkpoint. Here is how we carried out our tests.');

    $c .= og_blk_h('Step 1: Cashier Infrastructure Check', 3);
    $c .= og_blk_p('We logged into each of the best Interac casinos Ontario and opened the payment screen. Our main goal was to evaluate the specific gateway used – noting whether a particular site uses modern Interac e-Transfer deposit time optimizations or legacy systems. Our team also checked for auto-routing, custom email identifiers, and request-for-money triggers.');

    $c .= og_blk_h('Step 2: The Deposit Phase', 3);
    $c .= og_blk_p('We initiated an Interac deposit casino Ontario action with exactly $20 using a TD Bank Interac casino Ontario account. Our team used a digital stopwatch to measure the exact runway from confirming the transfer within the TD mobile app to the balance reflecting in our casino wallet. This information was helpful in establishing the various deposit timelines of the best Interac casinos Ontario.');
    $c .= og_blk_html('<p class="og-note og-note--shot"><strong>Screenshot note:</strong> Deposit confirmation email recorded Oct 3, 2026 – redacted for privacy.</p>');

    $c .= og_blk_h('Step 3: The Withdrawal Phase', 3);
    $c .= og_blk_p('After meeting the mandatory 1x turnover requirements on slot games, our team requested an Interac withdrawal casino Ontario action. At this stage, we kept our stopwatch running to log two distinct values:');
    $c .= og_blk_ul(array(
        'How long the casino took to move the transaction from “Pending” to “Approved” (internal review)',
        'How long the Interac network took to route the funds back to our checking account.',
    ));

    /* Reviews -------------------------------------------------------------- */
    $c .= og_blk_h('5 Best Interac Casinos Ontario Reviewed', 2, 'reviews');
    $c .= og_blk_p('Each of the reviews below details exactly how these sites handled our real-money sequence. Our team took a look at:');
    $c .= og_blk_ul(array('Structural limits', 'Ease of verification', 'Actual transaction turnarounds'));
    $c .= og_blk_p('The following are the 5 best Interac casinos Ontario that our team reviewed.');

    $reviews = array(
        array(
            'slug' => 'bet365', 'title' => 'bet365 Casino Ontario', 'cta' => 'Play at bet365',
            'best' => 'Best Interac e-Transfer casino Ontario for payout speed',
            'dep' => '23 seconds', 'wd' => '1 hour 42 minutes', 'games' => 'Book of Dead and Gates of Olympus',
            'why_label' => 'Why Interac Works Smoothly Here',
            'why' => 'Being the premium minimum deposit Interac casino Ontario choice for fast turnarounds, this casino uses a completely automated clearing for transactions that are below $100. Since our $20 withdrawal fell below their high-risk threshold – it bypassed the manual security queue entirely. As a matter of fact, the outbound notification cleared the Interac network almost instantly – making it one of the best Interac casinos with fastest withdrawal Ontario option.',
            'con' => 'The cashier setup requires strict address matching. This means that your TD Bank profile address should not differ even by a single character from the details you used during the registration process. If that happens, chances are that payment will get automatically kicked back.',
        ),
        array(
            'slug' => 'fanduel', 'title' => 'FanDuel Casino Ontario', 'cta' => 'Play at FanDuel',
            'best' => 'Flawless mobile app integration',
            'dep' => '45 seconds', 'wd' => '2 hours 15 minutes', 'games' => 'Wheel of Fortune and Sweet Bonanza',
            'why_label' => 'Why Interac Is Good Here',
            'why' => 'This site stands out as a top Interac casino $10 deposit Ontario location as its mobile interface embeds the payment screen directly into the app. Therefore, you won’t have to leave the mobile app in order to make payments. That means that you can authorize your bank transfer using the mobile app of this casino. Also, the casino operates as a true Ontario Interac casino no fees site – absorbing all the back-end transaction costs that a player can incur.',
            'con' => 'The withdrawal history ledger inside the app tends to update slowly – it shows a status of ‘Processing’ even when funds have actually landed in your bank account.',
        ),
        array(
            'slug' => 'leovegas', 'title' => 'LeoVegas Casino Ontario', 'cta' => 'Play at LeoVegas',
            'best' => 'Massive slot category variety',
            'dep' => '31 seconds', 'wd' => '2 hours 30 minutes', 'games' => 'Starburst XXXtreme and Amazing Link Apollo',
            'why_label' => 'Why Interac Is Good Here',
            'why' => 'LeoVegas offers a clean Interac casino verification Ontario path – the system links your banking name directly with your legal KYC profile upon deposit. This greatly reduces the need for secondary document uploads any time you request a cash out. On weekends, payouts do not exceed 3 hours to be cleared.',
            'con' => 'Compared to its sports-centric peers, the maximum transaction caps on Interac withdrawals are relatively low. If you are a high roller, you might have to split large balances into multiple requests.',
        ),
        array(
            'slug' => 'caesars', 'title' => 'Caesars Palace Online Casino Ontario', 'cta' => 'Play at Caesars Palace',
            'best' => 'High-roller limits and rewards crossover',
            'dep' => '58 seconds', 'wd' => '3 hours 10 minutes', 'games' => 'Thunderstruck II and Big Bass Bonanza',
            'why_label' => 'Why Interac Is Good Here',
            'why' => 'The casino offers deep institutional security – making it one of the most reliable best Interac casinos Ontario destinations for players moving larger balances. Caesars’ system uses direct API banking hooks that prevent transaction timeouts – ensuring that your $20 or $1,000 moves down a highly secure data pipe.',
            'con' => 'The casino uses a batch-processing model for outbound payments. Suppose your withdrawal request misses the hourly processing cutoff, your funds will sit idle for an extra 60 to 90 minutes.',
        ),
        array(
            'slug' => 'northstar', 'title' => 'NorthStar Bets Ontario', 'cta' => 'Play at NorthStar Bets',
            'best' => 'Specialized localized promotions',
            'dep' => '40 seconds', 'wd' => '4 hours 45 minutes', 'games' => 'Shark Blitz and Buffalo Blitz',
            'why_label' => 'Why Interac Is Good Here',
            'why' => 'NorthStar Bets is highly synchronized with domestic Canadian financial institutions – making it ideal for Ontario players. Their customer support team is entirely onshore – meaning that any routing issues or stuck transfers within the Interac network will be resolved by staff who really understand the Canadian banking systems well.',
            'con' => 'Outbound Interac requests that are initiated past 10:00 PM Eastern Time get held frequently until the morning shift begins – preventing overnight instant payouts.',
        ),
    );

    foreach ($reviews as $i => $r) {
        $n = $i + 1;
        $c .= og_blk_html('
<article class="og-brand" id="interac-' . $r['slug'] . '">
<header class="og-brand__head"><span class="og-brand__rank">' . $n . '</span>[og_logo brand="' . $r['slug'] . '" size="lg"]<div><h3>' . $n . '. ' . esc_html($r['title']) . '</h3><p class="og-brand__best"><strong>Best for:</strong> ' . esc_html($r['best']) . '</p></div></header>
<dl class="og-brand__facts">
<div><dt>Min Interac deposit</dt><dd>$10</dd></div>
<div class="is-good"><dt>Interac deposit (tested)</dt><dd>' . esc_html($r['dep']) . '</dd></div>
<div class="is-good"><dt>Interac withdrawal (tested)</dt><dd>' . esc_html($r['wd']) . ' <small>via e-Transfer</small></dd></div>
<div><dt>Games tested</dt><dd>' . esc_html($r['games']) . '</dd></div>
</dl>
<div class="og-brand__pc">
<div class="og-pro"><h4>' . esc_html($r['why_label']) . '</h4><p>' . esc_html($r['why']) . '</p></div>
<div class="og-con"><h4>Drawback</h4><p>' . esc_html($r['con']) . '</p></div>
</div>
<footer class="og-brand__foot">[og_play brand="' . $r['slug'] . '" label="' . esc_attr($r['cta']) . '"]<a class="og-brand__more" href="/#review-' . $r['slug'] . '">Full casino review</a><span>19+ · Ontario only · T&amp;Cs apply</span></footer>
</article>');
    }

    /* e-Transfer vs Online -------------------------------------------------- */
    $c .= og_blk_h('Interac e-Transfer vs Interac Online – Which Do Ontario Casinos Use?', 2, 'etransfer-vs-online');
    $c .= og_blk_p('Players searching Interac online casinos Ontario ought to keep an eye on the exact payment service listed in the cashier section of the best Interac casinos Ontario mentioned above. That said, Interac e-Transfer and Interac Online are different services. As a player based in Ontario, it is important that you know the difference between these two services.');
    $c .= og_blk_html('
<div class="og-vs">
<div class="og-vs__card is-yes"><span class="og-vs__tag">Used by Ontario casinos</span><h3>Interac e-Transfer</h3><p>Allows players to send money through participating financial institutions using the service’s supported transfer process. Availability, transfer limits, and authentication requirements largely depend on the bank account and service conditions.</p></div>
<div class="og-vs__card is-no"><span class="og-vs__tag">Discontinued</span><h3>Interac Online</h3><p>A separate online payment service that allowed eligible customers to pay merchants through participating financial institutions. Simply because a website accepts another Interac payment option, Interac Online should not be assumed to be available.</p></div>
</div>');
    $c .= og_blk_p('However, on October 31, 2024, Interac Corporation discontinued Interac Online. Since Interac Online is defunct, the cashier sections at Ontario casinos fall into two distinct workflows:');
    $c .= og_blk_ul(array('Interac e-Transfer (standard)', 'Interac eCashout / Direct Debit'));
    $c .= og_blk_p('If you’re researching Interac Online vs e-Transfer – it is important to note that the former is no longer in use. Therefore, most casinos now use the Interac e-Transfer method as the standard method of payment.');
    $c .= og_blk_p('For Ontario casinos that accept Interac – the most useful comparison identifies the specific method, minimum and maximum limits, any fees, and conditions that affect the process of requesting payouts.');

    /* FAQ ----------------------------------------------------------------- */
    $c .= og_blk_h('Frequently Asked Questions', 2, 'faq');
    $faq = '<div class="og-faq">';
    foreach (ontariogamers_interac_guide_faqs() as $i => $f) {
        $faq .= '<details class="og-faq__item"' . (0 === $i ? ' open' : '') . '><summary><h3>' . esc_html($f['q']) . '</h3></summary><div class="og-faq__a"><p>' . esc_html($f['a']) . '</p></div></details>';
    }
    $faq .= '</div>';
    $c .= og_blk_html($faq);

    /* Responsible gambling ----------------------------------------------- */
    $c .= og_blk_h('Responsible Gambling in Ontario', 2, 'responsible-gambling');
    $c .= og_blk_p('Online casino gambling is restricted to adults aged 19 and older who are physically present in Ontario. Before you go ahead to deposit money, confirm that the operator is registered first. Also, read the payment terms of the operator.');
    $c .= og_blk_p('With Interac, it is possible to move money electronically – but that does not change the fact that gambling comes with its own financial risks. For safety, ensure that you:');
    $c .= og_blk_ul(array('Set a spending limit', 'Keep track of deposits and withdrawals', 'Avoid gambling with money needed for essential expenses'));
    $c .= og_blk_p('If you discover that you’re grappling with problem gambling, take a break and seek professional help. <a href="https://www.connexontario.ca/" target="_blank" rel="noopener">ConnexOntario</a> (1-866-531-2600, free and confidential, 24/7) is a good platform where you can seek help and get the much-needed assistance.');

    $c .= og_blk_html('<p class="og-note"><strong>Disclaimer:</strong> Testing conducted by our Ontario contributor Vanessa. Site owned by KBLAN SOLUTIONS, Kenya.</p>');

    return $c;
}

/**
 * FAQs for the Interac guide (also used for FAQPage schema).
 */
function ontariogamers_interac_guide_faqs() {
    return array(
        array('q' => 'Do All Ontario Casinos Accept Interac?', 'a' => 'Not really. However, those online casinos that are licensed by iGaming Ontario and the AGCO support Interac as a primary banking method. This is because that method is the national financial standard for Canadian players. Therefore, a casino cannot be competitive in Ontario without allowing players to make payments using Interac.'),
        array('q' => 'What Is the Minimum Interac Deposit in Ontario?', 'a' => 'The standard minimum Interac deposit Ontario baseline across the industry is $10. Although some niche platforms may allow you to deposit as low as $5, the 5 best Interac casinos Ontario that we have reviewed require players to deposit at least $10 using Interac before they can get started.'),
        array('q' => 'Can I Withdraw with Interac in Ontario?', 'a' => 'Yes. It is possible for you to withdraw your winnings using Interac. As long as your Interac details match the details you shared during the registration process, be assured that you’ll be good to go. The withdrawal process can take about 3 hours or even less, depending on the casino you choose.'),
        array('q' => 'Is Interac Safe at Ontario Casinos?', 'a' => 'Yes. As long as you use it at AGCO licensed Interac casinos, be sure that the entire transaction process will be safe. The good news is that your banking credentials are not exposed to the casino whatsoever. Instead, authentication is held entirely within the multi-layer encryption protocols of your domestic bank.'),
        array('q' => 'Why Was My Interac Deposit Declined?', 'a' => 'One of the reasons why your Interac deposit got declined is an unaligned KYC profile. If your name, physical address, or email does not match perfectly with the verification details provided to the casino during the registration process – the site’s security script is likely to block the deposit automatically.'),
    );
}

/**
 * One-time: publish the Interac guide. Never overwrites an existing post, so
 * edits made in wp-admin are safe.
 */
function ontariogamers_seed_payment_guides_v1() {
    if (get_option('og_payment_guides_seed_v1')) {
        return;
    }
    if (!post_type_exists('payment_guide')) {
        return;
    }
    if (false === add_option('og_payment_guides_seed_v1', 1, '', 'no')) {
        return;
    }

    $slug = 'best-interac-casinos-ontario';
    if (get_page_by_path($slug, OBJECT, 'payment_guide')) {
        return;
    }

    $author = get_user_by('login', 'philimorevanessa');

    // Seeding runs on a visitor request, where KSES would strip block HTML.
    kses_remove_filters();
    $id = wp_insert_post(array(
        'post_type'    => 'payment_guide',
        'post_status'  => 'publish',
        'post_name'    => $slug,
        'post_title'   => 'Best Interac Casinos Ontario – 5 e-Transfer Sites [Oct 2026]',
        'post_excerpt' => 'We tested 5 AGCO casinos with $20 Interac e-Transfer. Fastest deposit: bet365 23 seconds. See min deposit, fees, and withdrawal times with screenshots.',
        'post_content' => ontariogamers_interac_guide_content(),
        'post_author'  => $author ? $author->ID : 1,
        'menu_order'   => 1,
    ));
    kses_init_filters();

    if ($id && !is_wp_error($id)) {
        update_post_meta($id, 'og_seo_title', 'Best Interac Casinos Ontario – 5 Sites Tested Oct 2026');
        update_post_meta($id, 'og_byline_note', 'Tested Oct 1-3, 2026');
        update_post_meta($id, 'og_payment_icon', 'interac');
    }
}
add_action('init', 'ontariogamers_seed_payment_guides_v1', 30);
