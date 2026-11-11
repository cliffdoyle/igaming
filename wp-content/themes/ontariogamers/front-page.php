<?php
/**
 * Homepage Template
 * Mirrors TheMapleEdge homepage structure:
 * Hero → Trust Badges → Casino Table → Ontario Info → Slots Grid → Footer
 */

get_header();
?>

<main class="hp">
<!-- HERO SECTION -->
<section class="hero">
    <div class="site-container">
        <h1>Best Online Casinos Ontario — <?php echo esc_html(ontariogamers_top6_date('h1_suffix')); ?></h1>
        <p>
            By Vanessa | <?php echo esc_html(ontariogamers_top6_date('byline_date')); ?> | Ontario Resident<br>
            19+ | AGCO-licensed sites only | ConnexOntario and iGaming Ontario resources
        </p>
        <p>
            We deposited $20 at six AGCO-licensed casinos, played real-money slots, and timed withdrawals to a TD account.
            Fastest in this test: bet365 at 1 hour 42 minutes. Slowest: BetMGM at 6 hours 15 minutes.
            Individual results vary by bank, verification, and payment method.
        </p>
        <p class="hero-disclosure">We earn commission, but test with our own money. <a href="#how-we-test">See how we test</a>.</p>
        <div class="hero-ctas">
            <a href="<?php echo esc_url(home_url('/online-casinos/')); ?>" class="btn btn-primary">Compare Top Casinos</a>
            <a href="<?php echo esc_url(home_url('/online-slots/')); ?>" class="btn btn-secondary">Browse Slot Reviews</a>
        </div>
    </div>
</section>

<!-- TRUST BADGES -->
<section class="trust-badges">
    <div class="trust-badge">
        <div class="badge-icon">🇨🇦</div>
        <h3>Built for Ontario</h3>
        <p>Made for local players — Canadian-dollar banking, Interac, AGCO-licensed brands and Ontario sports markets</p>
    </div>
    <div class="trust-badge">
        <div class="badge-icon">🛡️</div>
        <h3>Regulated Brands Only</h3>
        <p>A casino makes our list only after we confirm it on the iGaming Ontario register — never offshore sites</p>
    </div>
    <div class="trust-badge">
        <div class="badge-icon">🎯</div>
        <h3>Real Payout Data</h3>
        <p>We pull slot RTPs from live in-game screens every month — not from provider marketing sheets</p>
    </div>
    <div class="trust-badge">
        <div class="badge-icon">⚖️</div>
        <h3>Honestly Independent</h3>
        <p>We pass on deals with brands we wouldn't play at ourselves, and disclose every partnership openly</p>
    </div>
</section>

<?php get_template_part('template-parts/home-top6-content'); ?>

<!-- SPORTSBOOK SECTION (sportsbook reviews live under Sports Picks) -->
<?php
$sportsbooks = new WP_Query(array(
    'post_type'      => 'sports_pick',
    'posts_per_page' => 6,
    'orderby'        => 'menu_order',
    'order'          => 'ASC',
    'meta_query'     => array(
        array(
            'key'     => 'casino_rating',
            'compare' => 'EXISTS',
        ),
    ),
));
if ($sportsbooks->have_posts()) :
    ?>
    <section class="casino-table">
        <h2>Top-Rated Ontario Sportsbooks for 2026</h2>

        <?php ontariogamers_affiliate_disclosure(); ?>

        <?php
        while ($sportsbooks->have_posts()) : $sportsbooks->the_post();
            $rating     = get_post_meta(get_the_ID(), 'casino_rating', true);
            $affiliate  = get_post_meta(get_the_ID(), 'casino_affiliate_url', true);
            $license    = get_post_meta(get_the_ID(), 'casino_license', true);
            $withdrawal = get_post_meta(get_the_ID(), 'casino_withdrawal_time', true);
            ?>
            <div class="casino-card">
                <div>
                    <?php echo ontariogamers_casino_logo_linked(); ?>
                </div>

                <div class="casino-info">
                    <h3><?php the_title(); ?></h3>
                    <div class="casino-meta">
                        <?php if ($license) : ?>
                            <span>✓ <?php echo esc_html($license); ?></span>
                        <?php endif; ?>
                        <?php if ($withdrawal) : ?>
                            <span>⏱ Withdrawal: <?php echo esc_html($withdrawal); ?></span>
                        <?php endif; ?>
                        <?php if ($rating) : ?>
                            <span>⭐ <?php echo esc_html($rating); ?>/10</span>
                        <?php endif; ?>
                    </div>
                </div>

                <div class="casino-actions">
                    <a href="<?php the_permalink(); ?>" class="btn btn-review">Read Review</a>
                    <?php if ($affiliate) : ?>
                        <a href="<?php echo esc_url($affiliate); ?>" class="btn btn-play" target="_blank" rel="<?php echo esc_attr(ontariogamers_aff_rel()); ?>">Play Now</a>
                    <?php endif; ?>
                </div>

                <div class="casino-disclaimer">
                    New players only. 19+. Ontario players: bonus terms cannot be publicly displayed under AGCO Standard 11.10 — see offer directly at operator. Always read full T&Cs before claiming. Wagering requirements apply.
                </div>
            </div>
            <?php
        endwhile;
        wp_reset_postdata();
        ?>

        <p style="text-align:center;margin-top:1.5rem;">
            <a href="<?php echo esc_url(home_url('/sports-picks/')); ?>" class="btn btn-review">View All Sportsbook Reviews →</a>
        </p>
    </section>
    <?php
endif;
?>

<!-- ONTARIO REGULATION SECTION -->
<section style="background:var(--og-bg-alt);padding:3rem 1.5rem;">
    <div class="site-container" style="max-width:800px;">
        <h2 style="text-align:center;">Is Online Gambling Legal in Ontario?</h2>
        <p>
            Yes. Ontario's regulated online gambling market opened in April 2022. The Alcohol and Gaming Commission of Ontario (AGCO) regulates the market, while iGaming Ontario conducts and manages regulated online gaming with eligible operators. OLG.ca is operated separately by the Ontario Lottery and Gaming Corporation.
        </p>
        <p>
            iGaming Ontario's directory listed 49 operators and 84 gaming websites as of September 1, 2026. Listings can change, so check the exact website before creating an account. Players must be at least 19 and physically located in Ontario.
        </p>
        <p style="text-align:center;">
            <a href="<?php echo esc_url(home_url('/online-casinos/')); ?>" class="btn btn-primary">See AGCO-Registered Casinos</a>
        </p>
    </div>
</section>

<!-- TOP SLOTS SECTION -->
<section class="casino-table">
    <h2>Highest-Rated Slots in Ontario, RTP-Checked</h2>

    <div class="archive-grid">
        <?php
        $slots = new WP_Query(array(
            'post_type'      => 'slot_review',
            'posts_per_page' => 6,
            'orderby'        => 'menu_order',
            'order'          => 'ASC',
        ));

        if ($slots->have_posts()) :
            while ($slots->have_posts()) : $slots->the_post();
                $rtp        = get_post_meta(get_the_ID(), 'slot_rtp', true);
                $volatility = get_post_meta(get_the_ID(), 'slot_volatility', true);
                $provider   = get_post_meta(get_the_ID(), 'slot_provider', true);
                ?>
                <a href="<?php the_permalink(); ?>" class="archive-card" style="text-decoration:none;color:inherit;">
                    <?php if (has_post_thumbnail()) : ?>
                        <?php the_post_thumbnail('card-thumbnail'); ?>
                    <?php endif; ?>
                    <div class="card-content">
                        <h3><?php the_title(); ?></h3>
                        <p>
                            <?php if ($rtp) echo 'RTP: ' . esc_html($rtp) . '% | '; ?>
                            <?php if ($volatility) echo esc_html($volatility) . ' volatility'; ?>
                            <?php if ($provider) echo ' | ' . esc_html($provider); ?>
                        </p>
                    </div>
                </a>
                <?php
            endwhile;
            wp_reset_postdata();
        else :
            ?>
            <p style="text-align:center;color:#666;grid-column:1/-1;">Slot reviews coming soon.</p>
            <?php
        endif;
        ?>
    </div>

    <p style="text-align:center;margin-top:1.5rem;">
        <a href="<?php echo esc_url(home_url('/online-slots/')); ?>" class="btn btn-review">Explore All Slot Reviews →</a>
    </p>
</section>

<!-- LATEST NEWS -->
<section class="casino-table">
    <h2>Latest Ontario Gambling News</h2>

    <div class="news-grid">
        <?php
        $news = new WP_Query(array(
            'post_type'           => 'post',
            'posts_per_page'      => 3,
            'ignore_sticky_posts' => true,
        ));

        if ($news->have_posts()) :
            while ($news->have_posts()) : $news->the_post();
                get_template_part('template-parts/news', 'card');
            endwhile;
            wp_reset_postdata();
        else :
            ?>
            <p style="text-align:center;color:#666;grid-column:1/-1;">News articles coming soon.</p>
            <?php
        endif;
        ?>
    </div>

    <p style="text-align:center;margin-top:1.5rem;">
        <a href="<?php echo esc_url(home_url('/news/')); ?>" class="btn btn-review">Read All News →</a>
    </p>
</section>

<section id="how-we-test" class="hp-section hp-section--alt hp-editorial">
    <div class="hp-wrap hp-wrap--narrow">
    <h2>How We Test Ontario Casinos</h2>
    <ol class="hp-steps">
        <li class="hp-step"><span class="hp-step__num">1</span><div class="hp-step__body"><h3>Confirm Ontario registration</h3><p>We check the iGaming Ontario directory and the operator's terms for eligibility and account rules.</p></div></li>
        <li class="hp-step"><span class="hp-step__num">2</span><div class="hp-step__body"><h3>Review deposits and payments</h3><p>We record supported methods, limits, fees, and restrictions. For a real deposit test, we note the amount, method, and date.</p></div></li>
        <li class="hp-step"><span class="hp-step__num">3</span><div class="hp-step__body"><h3>Explore the games</h3><p>We record titles tested and practical details such as loading, navigation, and mobile usability. Game catalogues change, so findings are dated.</p></div></li>
        <li class="hp-step"><span class="hp-step__num">4</span><div class="hp-step__body"><h3>Measure withdrawals</h3><p>We record request, operator processing, and arrival times separately, along with payment method and any verification. One transaction does not establish a typical payout speed.</p></div></li>
        <li class="hp-step"><span class="hp-step__num">5</span><div class="hp-step__body"><h3>Assess the experience</h3><p>We review terms, support, account rules, and responsible-gambling tools. Testing claims are published only when supported by records.</p></div></li>
    </ol>
    </div>
</section>

<section class="hp-section hp-editorial">
    <div class="hp-wrap hp-wrap--narrow">
    <h2>How to Choose an Ontario Online Casino</h2>
    <p>Verify the exact website in the AGCO and iGaming Ontario listings, then review eligibility, verification, payment, and dispute rules. Regulatory status is not a guarantee of winnings or immediate transactions.</p>
    <p>Compare the cashier's minimum deposits, withdrawal availability, processing rules, and verification requirements before depositing. Do not deposit more to qualify for a promotion; choose an amount that fits your entertainment budget.</p>
    <p>Withdrawal times depend on the operator, payment provider, bank, and account verification. Look for documented tests that distinguish operator processing from transfer time. Treat an untested payout time as unknown.</p>
    </div>
</section>

<section class="hp-section hp-section--rg hp-editorial">
    <div class="hp-wrap hp-wrap--narrow">
    <h2>Responsible Gambling in Ontario</h2>
    <p>Online gambling is paid entertainment, not a source of income. Games involve the chance of losing money, and no bonus, strategy, or betting system guarantees a profit. Decide how much time and money you can spend, avoid borrowing to gamble, and do not chase losses.</p>
    <p>Use account tools such as deposit limits, time-outs, and self-exclusion. If gambling affects your finances, relationships, sleep, or daily responsibilities, ConnexOntario offers free, confidential information and referrals at <a href="tel:18665312600">1-866-531-2600</a> and <a href="https://www.connexontario.ca/" target="_blank" rel="noopener noreferrer">connexontario.ca</a>.</p>
    <p>Ontario players can also consult the <a href="https://www.agco.ca/" target="_blank" rel="noopener noreferrer">AGCO</a>, <a href="https://igamingontario.ca/" target="_blank" rel="noopener noreferrer">iGaming Ontario</a>, and the BetGuard centralized self-exclusion program.</p>
    </div>
</section>

<section id="faq" class="hp-section hp-editorial">
    <div class="hp-wrap hp-wrap--narrow">
    <h2>FAQs: Best Online Casinos Ontario</h2>
    <div class="hp-faq">
        <?php foreach (ontariogamers_home_faqs() as $item) : ?>
            <details class="hp-faq__item">
                <summary><h3><?php echo esc_html($item['q']); ?></h3></summary>
                <div class="hp-faq__a"><p><?php echo esc_html($item['a']); ?></p></div>
            </details>
        <?php endforeach; ?>
    </div>
    </div>
</section>

<?php ontariogamers_disclaimer(); ?>

</main>
<?php get_footer(); ?>
