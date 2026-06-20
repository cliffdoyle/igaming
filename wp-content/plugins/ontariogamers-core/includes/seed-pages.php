<?php
/**
 * Static Pages Seeder
 *
 * Creates the standard legal/trust pages for OntarioGamers automatically.
 * Pages are only created if they don't already exist (by slug), so running
 * this multiple times is safe — it will never duplicate or overwrite your edits.
 *
 * HOW TO RUN IT:
 * After pulling new code, go to wp-admin → Plugins → deactivate
 * "OntarioGamers Core" then activate it again. The activation hook runs
 * this seeder and the pages appear under Pages.
 *
 * You can freely edit the page text afterwards in the WordPress editor —
 * the seeder will NOT touch pages that already exist.
 */

if (!defined('ABSPATH')) {
    exit;
}

function ontariogamers_seed_static_pages() {

    $pages = array(

        // ───────────────────────────── ABOUT US ─────────────────────────────
        array(
            'slug'  => 'about',
            'title' => 'About OntarioGamers',
            'content' => '
<h2>Who We Are</h2>
<p>OntarioGamers.com is an independent guide to online casinos, slots and sports betting for Ontario players. We review and rate gambling products available in Ontario&mdash;verifying licensing, testing banking and withdrawals, checking RTP figures, and explaining how games work in plain language. Our goal is simple: give Ontario players the information they need to make genuinely informed choices.</p>
<p>We are operated independently. We are not owned by, or affiliated with, any casino operator, sportsbook or gambling software provider. We publish honest assessments and take accountability for the accuracy of every claim we make.</p>

<h2>Our Review Methodology</h2>
<h3>Casino Reviews</h3>
<p>Before we recommend any casino to Ontario players, we verify the following:</p>
<ul>
<li><strong>Licensing</strong> &mdash; confirmed on the AGCO / iGaming Ontario operator directory</li>
<li><strong>Interac e-Transfer availability</strong> &mdash; the Canadian payment standard, in Canadian dollars</li>
<li><strong>CAD account support</strong> &mdash; no currency conversion fees for Ontario players</li>
<li><strong>Withdrawal processing times</strong> &mdash; tested and documented</li>
<li><strong>Responsible gambling tools</strong> &mdash; deposit limits, cooling-off periods, self-exclusion</li>
<li><strong>Customer support</strong> &mdash; response time and helpfulness</li>
<li><strong>Game library</strong> &mdash; software providers, slot selection, live dealer availability</li>
</ul>

<h3>Slot Reviews</h3>
<p>Every slot review verifies the RTP from the live in-game information panel at recommended Ontario casinos&mdash;not from developer marketing materials. We confirm volatility, document bonus mechanics, and explain what a realistic session looks like. Reviews are updated regularly as operators change configurations.</p>

<h2>Our Editorial Independence</h2>
<p>OntarioGamers.com maintains editorial independence from all commercial partners:</p>
<ul>
<li>No operator pays for content placement&mdash;recommendations reflect our assessment, not payment</li>
<li>No operator reviews our content before publication</li>
<li>We publish negative assessments when an operator has a genuine weakness</li>
<li>Commission rates do not affect our rankings or ratings</li>
<li>We disclose all commercial relationships transparently on every page</li>
</ul>

<h2>Contact</h2>
<p>Editorial questions, corrections or review requests: <a href="mailto:contact@ontariogamers.com">contact@ontariogamers.com</a></p>
',
        ),

        // ──────────────────────── RESPONSIBLE GAMBLING ───────────────────────
        array(
            'slug'  => 'responsible-gambling',
            'title' => 'Responsible Gambling',
            'content' => '
<p>OntarioGamers.com is committed to promoting responsible gambling. Gambling should be entertainment&mdash;when it stops being enjoyable, or when it affects your finances, relationships or mental health, it has become a problem that deserves attention and support.</p>
<p><strong>19+ only.</strong> Online gambling in Ontario is for adults aged 19 and over. Every AGCO-registered operator verifies your age before accepting deposits. If you are under 19, please do not attempt to gamble online.</p>

<h2>Canadian Helplines &mdash; Free, Confidential, 24/7</h2>
<ul>
<li><strong>ConnexOntario:</strong> 1-866-531-2600 &mdash; free, confidential mental health and addictions support for Ontario residents, 24 hours a day.</li>
<li><strong>Centre for Addiction and Mental Health (CAMH):</strong> <a href="https://www.camh.ca" target="_blank" rel="noopener">camh.ca</a> &mdash; problem gambling resources and self-assessment tools.</li>
<li><strong>Responsible Gambling Council:</strong> <a href="https://www.rgc.ca" target="_blank" rel="noopener">rgc.ca</a></li>
<li><strong>Gambling Help Online:</strong> live chat, email and phone support across Canada.</li>
</ul>

<h2>Practical Tools for Safer Play</h2>
<p>These tools are available at all licensed Ontario operators through your account settings:</p>
<ul>
<li><strong>Deposit limits</strong> &mdash; set a maximum you can deposit per day, week or month.</li>
<li><strong>Time limits</strong> &mdash; set a maximum session duration.</li>
<li><strong>Loss limits</strong> &mdash; cap how much you can lose in a period.</li>
<li><strong>Cooling-off periods</strong> &mdash; take a break of 24 hours to several weeks.</li>
<li><strong>Reality checks</strong> &mdash; reminders showing how long you have played and spent.</li>
<li><strong>Self-exclusion</strong> &mdash; exclude yourself from gambling platforms.</li>
</ul>

<h2>Self-Exclusion in Ontario</h2>
<p>Ontario&rsquo;s self-exclusion system, operated through the AGCO, excludes you from all iGaming Ontario-registered online casino and sports betting sites simultaneously. Once applied, you cannot open new accounts or deposit at any of the 80+ licensed Ontario operators. Self-exclusion periods start at 6 months and can be permanent. To begin, visit igamingontario.ca or contact ConnexOntario on 1-866-531-2600.</p>

<h2>Signs of Problem Gambling</h2>
<ul>
<li>Gambling with money needed for rent, bills or food</li>
<li>Increasing bet sizes to recover losses (&ldquo;chasing losses&rdquo;)</li>
<li>Lying to friends or family about gambling</li>
<li>Gambling to escape stress or negative emotions</li>
<li>Feeling unable to stop even when you want to</li>
<li>Borrowing money or selling possessions to fund gambling</li>
</ul>
<p>If you recognise any of these signs in yourself or someone you care about, help is available right now. Calling ConnexOntario (1-866-531-2600) is free, confidential and available 24 hours a day.</p>

<h2>Gambling Is Not a Way to Make Money</h2>
<p>Every casino game and sports bet has a built-in house edge&mdash;a mathematical advantage that ensures the operator profits over time. Gambling is entertainment with a cost, like a concert ticket or a cinema visit. It is not an investment strategy or a reliable source of income.</p>
',
        ),

        // ───────────────────────── AFFILIATE DISCLOSURE ──────────────────────
        array(
            'slug'  => 'affiliate-disclosure',
            'title' => 'Affiliate Disclosure',
            'content' => '
<p>OntarioGamers.com is an independent affiliate review and guide site operated for Ontario players. We want to be completely transparent about how we earn money.</p>

<h2>How We Earn Commission</h2>
<p>When you click a link to a casino or sportsbook on our site and register or deposit, the operator may pay us a commission. This comes at <strong>no extra cost to you</strong>&mdash;you pay exactly the same whether you arrive through our link or go to the operator directly.</p>

<h2>How This Affects Our Reviews</h2>
<p>It doesn&rsquo;t. Our commercial relationships do not influence our editorial recommendations:</p>
<ul>
<li>We only recommend operators verified as AGCO-registered with iGaming Ontario.</li>
<li>Commission rates paid by different operators do not affect our rankings or ratings.</li>
<li>We publish honest assessments, including weaknesses, even for operators we have affiliate relationships with.</li>
<li>No operator pays for placement, and no operator approves our content before publication.</li>
</ul>

<h2>Why We Disclose This</h2>
<p>Transparency is a legal requirement and an ethical one. Under the Canadian Gaming Association&rsquo;s Code for Responsible Gaming Advertising and AGCO affiliate standards, we disclose all material commercial relationships prominently. You deserve to know how a site you rely on makes its money.</p>

<p>If you have questions about our affiliate relationships, contact us at <a href="mailto:contact@ontariogamers.com">contact@ontariogamers.com</a>.</p>
',
        ),

        // ─────────────────────────── PRIVACY POLICY ──────────────────────────
        array(
            'slug'  => 'privacy-policy',
            'title' => 'Privacy Policy',
            'content' => '
<p>This Privacy Policy explains how OntarioGamers.com (&ldquo;we&rdquo;, &ldquo;us&rdquo;) collects, uses and protects information when you visit our website. By using this site, you consent to the practices described here.</p>

<h2>Information We Collect</h2>
<ul>
<li><strong>Analytics data</strong> &mdash; we use analytics tools (such as Google Analytics) to understand how visitors use our site. This may include your approximate location, device type, browser, pages visited and time on site. This data is aggregated and does not personally identify you.</li>
<li><strong>Cookies</strong> &mdash; small files stored in your browser that help the site function and help us measure traffic. You can disable cookies in your browser settings.</li>
<li><strong>Information you provide</strong> &mdash; if you contact us by email, we receive the information you choose to send (such as your name and email address).</li>
</ul>

<h2>How We Use Information</h2>
<ul>
<li>To operate, maintain and improve our website</li>
<li>To understand which content is useful to our visitors</li>
<li>To respond to enquiries you send us</li>
<li>To comply with legal and regulatory obligations</li>
</ul>

<h2>Third-Party Links</h2>
<p>Our site contains links to third-party operators. When you click these links, you leave our site and are subject to the privacy policies of those operators. We are not responsible for the content or privacy practices of external sites.</p>

<h2>Affiliate Tracking</h2>
<p>When you click an affiliate link, the destination operator may set a cookie to track that you arrived from our site. This is used to credit referrals. See our <a href="/affiliate-disclosure/">Affiliate Disclosure</a> for details.</p>

<h2>Data Retention &amp; Your Rights</h2>
<p>We retain analytics data only as long as necessary for the purposes described. You may request information about data we hold relating to you, or request its deletion, by contacting us. You can also opt out of Google Analytics using Google&rsquo;s browser opt-out tools.</p>

<h2>Children</h2>
<p>This site is intended for adults aged 19 and over. We do not knowingly collect information from anyone under the legal gambling age.</p>

<h2>Changes to This Policy</h2>
<p>We may update this Privacy Policy from time to time. The &ldquo;last updated&rdquo; date reflects the most recent revision.</p>

<h2>Contact</h2>
<p>Questions about this policy: <a href="mailto:contact@ontariogamers.com">contact@ontariogamers.com</a></p>
',
        ),

        // ─────────────────────── TERMS AND CONDITIONS ────────────────────────
        array(
            'slug'  => 'terms-and-conditions',
            'title' => 'Terms and Conditions',
            'content' => '
<p>Welcome to OntarioGamers.com. By accessing and using this website, you agree to the following terms and conditions. If you do not agree, please do not use the site.</p>

<h2>Informational Purpose Only</h2>
<p>OntarioGamers.com provides information, reviews and guides about online gambling for Ontario players. We are not a gambling operator. We do not accept wagers, hold player funds or operate any games. All gambling takes place on third-party operator sites subject to their own terms.</p>

<h2>Age Restriction</h2>
<p>You must be 19 years of age or older to use this site and to gamble in Ontario. By using this site you confirm you meet the legal age requirement.</p>

<h2>Accuracy of Information</h2>
<p>We work hard to keep information accurate and current, but bonus offers, RTP configurations, licensing status and operator details change frequently. We make no warranty that all information is complete or up to date at the moment you read it. Always verify current terms directly with the operator before depositing.</p>

<h2>Affiliate Relationships</h2>
<p>We earn commission from some operators when you register through our links. See our <a href="/affiliate-disclosure/">Affiliate Disclosure</a>.</p>

<h2>Limitation of Liability</h2>
<p>You use this site and any third-party operators at your own risk. OntarioGamers.com is not liable for any losses&mdash;financial or otherwise&mdash;arising from gambling activity or reliance on information published here.</p>

<h2>Responsible Gambling</h2>
<p>Gambling involves financial risk. Please read our <a href="/responsible-gambling/">Responsible Gambling</a> page and never bet more than you can afford to lose.</p>

<h2>Changes to These Terms</h2>
<p>We may update these terms at any time. Continued use of the site constitutes acceptance of the revised terms.</p>
',
        ),

        // ───────────────────────────── CONTACT ───────────────────────────────
        array(
            'slug'  => 'contact',
            'title' => 'Contact Us',
            'content' => '
<p>Have a question, correction or partnership enquiry? We&rsquo;d love to hear from you.</p>

<h2>Email</h2>
<p>General &amp; editorial enquiries: <a href="mailto:contact@ontariogamers.com">contact@ontariogamers.com</a></p>
<p>Review corrections &amp; factual errors: <a href="mailto:contact@ontariogamers.com">contact@ontariogamers.com</a><br>
Please include the page URL and details of the issue. We investigate all reported errors.</p>

<!--
  ┌─────────────────────────────────────────────────────────────────┐
  │  EDIT YOUR DETAILS HERE                                          │
  │  Replace the placeholder values below with your real info,       │
  │  then remove the [ brackets ]. You can edit all of this in       │
  │  the WordPress editor (Pages → Contact Us → Edit).               │
  └─────────────────────────────────────────────────────────────────┘
-->

<h2>Business Details</h2>
<ul>
<li><strong>Site name:</strong> OntarioGamers.com</li>
<li><strong>Email:</strong> [your-email@ontariogamers.com]</li>
<li><strong>Location:</strong> [Your City, Ontario, Canada]</li>
<li><strong>Response time:</strong> We aim to respond within 24&ndash;48 hours.</li>
</ul>

<h2>Responsible Gambling Support</h2>
<p>Please note: we cannot provide gambling counselling. If you need help with problem gambling, contact ConnexOntario on 1-866-531-2600 (free, confidential, 24/7) &mdash; they have trained counsellors available at all times.</p>
',
        ),
    );

    $created = array();

    foreach ($pages as $page) {
        // Skip if a page with this slug already exists (never overwrite edits)
        $existing = get_page_by_path($page['slug']);
        if ($existing) {
            continue;
        }

        $page_id = wp_insert_post(array(
            'post_title'   => $page['title'],
            'post_name'    => $page['slug'],
            'post_content' => $page['content'],
            'post_status'  => 'publish',
            'post_type'    => 'page',
            'post_author'  => 1,
        ));

        if ($page_id && !is_wp_error($page_id)) {
            $created[] = $page['title'];
        }
    }

    return $created;
}

/**
 * One-time: create an example Sports Pick (plus NHL/NBA/NFL leagues) so the
 * Sports Picks feature is visible on the live site immediately after deploy.
 * Runs once, guarded by an option, then flushes rewrite rules so the new
 * /sports-picks/ and /sport/<league>/ URLs resolve without a manual permalink save.
 */
function ontariogamers_seed_sports_example() {
    if (get_option('og_sports_seed_v1')) {
        return;
    }
    if (!post_type_exists('sports_pick')) {
        return;
    }

    // Make sure the league terms exist so /sport/nhl/ etc. resolve.
    foreach (array('NHL', 'NBA', 'NFL') as $league) {
        if (!term_exists($league, 'pick_sport')) {
            wp_insert_term($league, 'pick_sport');
        }
    }

    // Create one example pick if it isn't already there.
    $existing = get_page_by_path('example-nhl-pick', OBJECT, 'sports_pick');
    if (!$existing) {
        $pid = wp_insert_post(array(
            'post_type'    => 'sports_pick',
            'post_status'  => 'publish',
            'post_title'   => 'Maple Leafs vs Canadiens — NHL Pick',
            'post_name'    => 'example-nhl-pick',
            'post_author'  => 1,
            'menu_order'   => 1,
            'post_content' => '<p>This is an <strong>example sports pick</strong> created automatically so you can see how the Sports Picks section works. Edit or delete it any time under <em>Sports Picks</em> in your WordPress dashboard.</p>
<p>Toronto has won four of their last five meetings with Montreal and skates well at home. We like the Leafs to control the run of play and win by two or more goals, which is why we are taking them on the puck line.</p>
<p><em>Replace this with your own analysis when you add a real pick.</em></p>',
        ));

        if ($pid && !is_wp_error($pid)) {
            wp_set_object_terms($pid, 'NHL', 'pick_sport');
            update_post_meta($pid, 'pick_match', 'Toronto Maple Leafs vs Montreal Canadiens');
            update_post_meta($pid, 'pick_selection', 'Maple Leafs -1.5');
            update_post_meta($pid, 'pick_odds', '+150');
            update_post_meta($pid, 'pick_result', 'Pending');
            update_post_meta($pid, 'pick_event_date', date('Y-m-d', strtotime('+2 days')));
            update_post_meta($pid, 'pick_sportsbook', 'Bet99');
        }
    }

    flush_rewrite_rules();
    update_option('og_sports_seed_v1', 1);
}
add_action('init', 'ontariogamers_seed_sports_example', 20);

/**
 * One-time: create one example Casino Review and one example Slot Review so the
 * Casinos and Slots sections show real, working pages immediately after deploy.
 * Slugs match the existing footer example links so those links resolve.
 * Runs once, guarded by an option.
 */
function ontariogamers_seed_review_examples() {
    if (get_option('og_reviews_seed_v1')) {
        return;
    }
    if (!post_type_exists('casino_review') || !post_type_exists('slot_review')) {
        return;
    }

    // ── Example Casino Review (Bet99) ──────────────────────────────────────
    if (!get_page_by_path('bet99-review', OBJECT, 'casino_review')) {
        $cid = wp_insert_post(array(
            'post_type'    => 'casino_review',
            'post_status'  => 'publish',
            'post_title'   => 'Bet99',
            'post_name'    => 'bet99-review',
            'post_author'  => 1,
            'post_content' => '<p><em>This is an <strong>example casino review</strong> created automatically so you can see how the Casinos section works. Edit or delete it under <strong>Casino Reviews</strong> in your dashboard, and replace the affiliate link with your own.</em></p>

<h2>Bet99 Ontario — Quick Verdict</h2>
<p>Bet99 is an AGCO-registered operator built for Ontario players, with fast Interac payouts, a strong sportsbook and a large casino lobby. It is one of the more recognisable Canadian-facing brands in the regulated market.</p>

<h2>Welcome Bonus</h2>
<p>New players can claim a generous matched deposit offer plus free spins. Always read the wagering requirements before opting in — our full terms breakdown is below.</p>

<h2>Banking &amp; Payouts</h2>
<p>Interac e-Transfer withdrawals are typically processed within 24 hours, which is among the faster turnarounds available to Ontario players. Minimum deposit is low at $10.</p>

<h2>Is Bet99 Safe?</h2>
<p>Yes — Bet99 is registered with iGaming Ontario and the AGCO, meaning it is legally licensed to operate in the province and is held to provincial player-protection standards.</p>',
        ));

        if ($cid && !is_wp_error($cid)) {
            update_post_meta($cid, 'casino_rating', '8.7');
            update_post_meta($cid, 'casino_bonus_description', '100% up to $1,000 + 100 Free Spins');
            update_post_meta($cid, 'casino_affiliate_url', 'https://bet99.com');
            update_post_meta($cid, 'casino_license', 'AGCO-registered / iGaming Ontario');
            update_post_meta($cid, 'casino_deposit_methods', 'Interac, Visa, Mastercard, iDebit');
            update_post_meta($cid, 'casino_withdrawal_time', '0–24 hours (Interac)');
            update_post_meta($cid, 'casino_min_deposit', '$10');
            update_post_meta($cid, 'casino_year_established', '2021');
        }
    }

    // ── Example Slot Review (Gates of Olympus) ─────────────────────────────
    if (!get_page_by_path('gates-of-olympus-ontario', OBJECT, 'slot_review')) {
        $sid = wp_insert_post(array(
            'post_type'    => 'slot_review',
            'post_status'  => 'publish',
            'post_title'   => 'Gates of Olympus',
            'post_name'    => 'gates-of-olympus-ontario',
            'post_author'  => 1,
            'post_content' => '<p><em>This is an <strong>example slot review</strong> created automatically so you can see how the Slots section works. Edit or delete it under <strong>Slot Reviews</strong> in your dashboard, and replace the play link with your own affiliate URL.</em></p>

<h2>Gates of Olympus — Overview</h2>
<p>Gates of Olympus is a high-volatility Pragmatic Play slot built around tumbling reels and multiplier symbols that can combine for a maximum win of 5,000x your stake. It is one of the most-played slots in the Ontario market.</p>

<h2>How It Plays</h2>
<p>Instead of fixed paylines, wins are scatter-paid — land eight or more matching symbols anywhere on the 6x5 grid. Multiplier orbs from Zeus can land at any time and add together during the free spins round.</p>

<h2>RTP &amp; Volatility</h2>
<p>The verified RTP is 96.50% in its standard configuration. Volatility is high, so expect longer dry spells punctuated by larger wins — bankroll management matters here.</p>

<h2>Where to Play in Ontario</h2>
<p>Gates of Olympus is available at most AGCO-registered Ontario casinos. Always play at a licensed operator and set deposit limits.</p>',
        ));

        if ($sid && !is_wp_error($sid)) {
            update_post_meta($sid, 'slot_rtp', '96.50');
            update_post_meta($sid, 'slot_volatility', 'High');
            update_post_meta($sid, 'slot_max_win', '5,000x');
            update_post_meta($sid, 'slot_provider', 'Pragmatic Play');
            update_post_meta($sid, 'slot_theme', 'Greek Mythology');
            update_post_meta($sid, 'slot_reels', '6x5');
            update_post_meta($sid, 'slot_paylines', 'Scatter Pays (8+)');
            update_post_meta($sid, 'slot_min_bet', '0.20');
            update_post_meta($sid, 'slot_max_bet', '100');
            update_post_meta($sid, 'slot_affiliate_url', '');

            if (taxonomy_exists('game_provider')) {
                wp_set_object_terms($sid, 'Pragmatic Play', 'game_provider');
            }
        }
    }

    update_option('og_reviews_seed_v1', 1);
}
add_action('init', 'ontariogamers_seed_review_examples', 20);
