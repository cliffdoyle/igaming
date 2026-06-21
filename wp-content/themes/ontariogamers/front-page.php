<?php
/**
 * Homepage Template
 * Mirrors TheMapleEdge homepage structure:
 * Hero → Trust Badges → Casino Table → Ontario Info → Slots Grid → Footer
 */

get_header();
?>

<!-- HERO SECTION -->
<section class="hero">
    <div class="site-container">
        <h1>Smarter Online Gambling for Ontario Players — 2026</h1>
        <p>
            Hands-on, independent reviews of Ontario's licensed casinos and slots — plus sports picks.
            We test the banking, confirm the licences, and check the real payout rates, so you can choose with confidence.
        </p>
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

<!-- CASINO COMPARISON TABLE -->
<section class="casino-table">
    <h2>Top-Rated Ontario Casinos for 2026</h2>

    <?php ontariogamers_affiliate_disclosure(); ?>

    <?php
    // Query casino reviews (custom post type)
    $casinos = new WP_Query(array(
        'post_type'      => 'casino_review',
        'posts_per_page' => 6,
        'orderby'        => 'menu_order',
        'order'          => 'ASC',
    ));

    if ($casinos->have_posts()) :
        while ($casinos->have_posts()) : $casinos->the_post();
            // Get custom fields
            $rating       = get_post_meta(get_the_ID(), 'casino_rating', true);
            $bonus        = get_post_meta(get_the_ID(), 'casino_bonus_description', true);
            $affiliate    = get_post_meta(get_the_ID(), 'casino_affiliate_url', true);
            $license      = get_post_meta(get_the_ID(), 'casino_license', true);
            $withdrawal   = get_post_meta(get_the_ID(), 'casino_withdrawal_time', true);
            ?>
            <div class="casino-card">
                <div>
                    <?php if (has_post_thumbnail()) : ?>
                        <?php the_post_thumbnail('casino-logo', array('class' => 'casino-logo')); ?>
                    <?php else : ?>
                        <div class="casino-logo" style="display:flex;align-items:center;justify-content:center;background:#f0f0f0;font-weight:700;font-size:0.75rem;"><?php the_title(); ?></div>
                    <?php endif; ?>
                </div>

                <div class="casino-info">
                    <h3><?php the_title(); ?></h3>
                    <div class="casino-bonus"><?php echo esc_html($bonus ?: 'Welcome bonus available — see operator for current terms'); ?></div>
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
                        <a href="<?php echo esc_url($affiliate); ?>" class="btn btn-play" target="_blank" rel="noopener noreferrer nofollow">Play Now</a>
                    <?php endif; ?>
                </div>

                <div class="casino-disclaimer">
                    New players only. 19+. Ontario players: bonus terms cannot be publicly displayed under AGCO Standard 11.10 — see offer directly at operator. Always read full T&Cs before claiming. Wagering requirements apply.
                </div>
            </div>
            <?php
        endwhile;
        wp_reset_postdata();
    else :
        ?>
        <p style="text-align:center;color:#666;">Casino reviews coming soon. Check back shortly.</p>
        <?php
    endif;
    ?>

    <p style="text-align:center;margin-top:1.5rem;">
        <a href="<?php echo esc_url(home_url('/online-casinos/')); ?>" class="btn btn-review">View Every Casino Review →</a>
    </p>
</section>

<!-- ONTARIO REGULATION SECTION -->
<section style="background:var(--og-bg-alt);padding:3rem 1.5rem;">
    <div class="site-container" style="max-width:800px;">
        <h2 style="text-align:center;">Why Ontario's Regulated Market Matters</h2>
        <p>
            Ontario runs one of the most competitive legal online gambling markets anywhere in North America. Since iGaming Ontario went live in April 2022, more than 80 licensed operators have launched under AGCO oversight, and players staked tens of billions of dollars on regulated platforms in 2025 alone.
        </p>
        <p>
            Sticking to an AGCO-registered casino gives you independently audited games, built-in responsible-gambling controls, banking in Canadian dollars, and a proper complaints process if something goes wrong. Unlicensed offshore sites give you none of that protection.
        </p>
        <p style="text-align:center;">
            <a href="<?php echo esc_url(home_url('/guides/ontario-casino-guide/')); ?>" class="btn btn-primary">Read the Ontario Casino Guide</a>
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

<!-- HOW WE REVIEW SECTION -->
<section style="padding:3rem 1.5rem;max-width:800px;margin:0 auto;">
    <h2 style="text-align:center;">Our Testing Process, Step by Step</h2>

    <div style="display:grid;grid-template-columns:repeat(auto-fit, minmax(250px, 1fr));gap:1.5rem;margin-top:1.5rem;">
        <div>
            <h4>How We Test Casinos</h4>
            <ul style="font-size:0.9rem;padding-left:1.25rem;">
                <li>Licence confirmed on the iGaming Ontario register</li>
                <li>We deposit and withdraw with Interac e-Transfer ourselves</li>
                <li>Responsible-gambling controls reviewed in the account area</li>
                <li>Support response times timed across live chat and email</li>
                <li>Refreshed every month with current figures</li>
            </ul>
        </div>
        <div>
            <h4>How We Test Slots</h4>
            <ul style="font-size:0.9rem;padding-left:1.25rem;">
                <li>RTP read straight from the live in-game info panel</li>
                <li>Volatility cross-checked against the studio's own data</li>
                <li>Top-win potential and hit frequency verified</li>
                <li>Bonus features broken down in everyday language</li>
                <li>Operator-by-operator RTP differences flagged</li>
            </ul>
        </div>
    </div>
</section>

<?php ontariogamers_disclaimer(); ?>

<?php get_footer(); ?>
