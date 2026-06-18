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
        <h1>Ontario's Independent Online Casino Guide — 2026</h1>
        <p>
            AGCO-verified casino reviews, RTP-tested slot reviews, and free daily sports picks.
            Every recommendation is licensed, tested, and updated monthly.
        </p>
        <div class="hero-ctas">
            <a href="<?php echo esc_url(home_url('/online-casinos/')); ?>" class="btn btn-primary">Best Ontario Casinos</a>
            <a href="<?php echo esc_url(home_url('/sports-picks/')); ?>" class="btn btn-secondary">Free Daily Picks</a>
            <a href="<?php echo esc_url(home_url('/online-slots/')); ?>" class="btn btn-secondary">Top Slot Reviews</a>
        </div>
    </div>
</section>

<!-- TRUST BADGES -->
<section class="trust-badges">
    <div class="trust-badge">
        <div class="badge-icon">🍁</div>
        <h3>Ontario Focused</h3>
        <p>Built specifically for Ontario players — CAD banking, AGCO licensing, Ontario sports</p>
    </div>
    <div class="trust-badge">
        <div class="badge-icon">✅</div>
        <h3>Licensed Operators Only</h3>
        <p>Every casino verified on the iGaming Ontario operator directory before listing</p>
    </div>
    <div class="trust-badge">
        <div class="badge-icon">📊</div>
        <h3>RTP Verified Monthly</h3>
        <p>All slot RTPs checked from live in-game data — not developer marketing figures</p>
    </div>
    <div class="trust-badge">
        <div class="badge-icon">🔒</div>
        <h3>Genuinely Independent</h3>
        <p>We decline partnerships with casinos we would not recommend. Full affiliate disclosure on every page</p>
    </div>
</section>

<!-- CASINO COMPARISON TABLE -->
<section class="casino-table">
    <h2>Best Online Casinos in Ontario — 2026</h2>

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
            // Get custom fields (ACF)
            $rating       = get_field('casino_rating');
            $bonus        = get_field('casino_bonus_description');
            $affiliate    = get_field('casino_affiliate_url');
            $license      = get_field('casino_license');
            $withdrawal   = get_field('casino_withdrawal_time');
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
        <a href="<?php echo esc_url(home_url('/online-casinos/')); ?>" class="btn btn-review">See All Ontario Casino Reviews →</a>
    </p>
</section>

<!-- ONTARIO REGULATION SECTION -->
<section style="background:var(--og-bg-alt);padding:3rem 1.5rem;">
    <div class="site-container" style="max-width:800px;">
        <h2 style="text-align:center;">Ontario — Canada's #1 iGaming Market</h2>
        <p>
            Ontario operates the most competitive regulated online casino market in North America. Since iGaming Ontario launched in April 2022, over 80 licensed operators serve Ontario players under AGCO oversight. In 2025 alone, Ontario players wagered $98.3 billion on licensed platforms.
        </p>
        <p>
            Playing at an AGCO-registered casino means audited game fairness, mandatory responsible gambling tools, Canadian dollar banking, and formal dispute resolution. Offshore casinos operating without AGCO registration offer none of these protections.
        </p>
        <p style="text-align:center;">
            <a href="<?php echo esc_url(home_url('/guides/ontario-casino-guide/')); ?>" class="btn btn-primary">Full Ontario Casino Guide</a>
        </p>
    </div>
</section>

<!-- TOP SLOTS SECTION -->
<section class="casino-table">
    <h2>Top Online Slots in Ontario — RTP Verified</h2>

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
                $rtp        = get_field('slot_rtp');
                $volatility = get_field('slot_volatility');
                $provider   = get_field('slot_provider');
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
        <a href="<?php echo esc_url(home_url('/online-slots/')); ?>" class="btn btn-review">See All Slot Reviews →</a>
    </p>
</section>

<!-- HOW WE REVIEW SECTION -->
<section style="padding:3rem 1.5rem;max-width:800px;margin:0 auto;">
    <h2 style="text-align:center;">How OntarioGamers Reviews Casinos & Slots</h2>

    <div style="display:grid;grid-template-columns:repeat(auto-fit, minmax(250px, 1fr));gap:1.5rem;margin-top:1.5rem;">
        <div>
            <h4>Casino Review Process</h4>
            <ul style="font-size:0.9rem;padding-left:1.25rem;">
                <li>AGCO registration verified on iGaming Ontario directory</li>
                <li>Interac e-Transfer deposit & withdrawal tested</li>
                <li>Responsible gambling tools assessed</li>
                <li>Customer support response times checked</li>
                <li>Updated monthly with fresh data</li>
            </ul>
        </div>
        <div>
            <h4>Slot Review Process</h4>
            <ul style="font-size:0.9rem;padding-left:1.25rem;">
                <li>RTP verified from live in-game information panel</li>
                <li>Volatility confirmed from provider documentation</li>
                <li>Maximum win probability verified</li>
                <li>Bonus mechanics explained in plain language</li>
                <li>Operator RTP configuration differences disclosed</li>
            </ul>
        </div>
    </div>
</section>

<?php ontariogamers_disclaimer(); ?>

<?php get_footer(); ?>
