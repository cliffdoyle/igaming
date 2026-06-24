<?php
/**
 * Single Slot Review Template
 * Mirrors TheMapleEdge slot review page structure
 */

get_header();

// Get custom fields
$rtp          = get_post_meta(get_the_ID(), 'slot_rtp', true);
$volatility   = get_post_meta(get_the_ID(), 'slot_volatility', true);
$max_win      = get_post_meta(get_the_ID(), 'slot_max_win', true);
$provider     = get_post_meta(get_the_ID(), 'slot_provider', true);
$theme        = get_post_meta(get_the_ID(), 'slot_theme', true);
$reels        = get_post_meta(get_the_ID(), 'slot_reels', true);
$paylines     = get_post_meta(get_the_ID(), 'slot_paylines', true);
$min_bet      = get_post_meta(get_the_ID(), 'slot_min_bet', true);
$max_bet      = get_post_meta(get_the_ID(), 'slot_max_bet', true);
$affiliate    = get_post_meta(get_the_ID(), 'slot_affiliate_url', true);
?>

<div class="site-container">
    <div class="content-area">
        <main class="article-content">

            <!-- Breadcrumb -->
            <p style="font-size:0.85rem;color:var(--og-text-light);margin-bottom:1.5rem;">
                <a href="<?php echo esc_url(home_url('/')); ?>">Home</a> /
                <a href="<?php echo esc_url(home_url('/online-slots/')); ?>">Online Slots</a> /
                <?php the_title(); ?>
            </p>

            <h1><?php the_title(); ?> — Ontario Review <?php echo date('Y'); ?></h1>

            <!-- Author & Date -->
            <p style="font-size:0.85rem;color:var(--og-text-light);margin-bottom:2rem;">
                By <?php the_author(); ?> | Last Updated: <?php echo get_the_modified_date('F Y'); ?>
            </p>

            <!-- Slot Screenshot -->
            <?php if (has_post_thumbnail()) : ?>
                <div style="margin-bottom:2rem;border-radius:var(--og-radius);overflow:hidden;">
                    <?php the_post_thumbnail('large'); ?>
                </div>
            <?php endif; ?>

            <!-- Quick Stats Box -->
            <div class="slot-stats">
                <?php if ($rtp) : ?>
                    <div class="slot-stat">
                        <div class="stat-value"><?php echo esc_html($rtp); ?>%</div>
                        <div class="stat-label">RTP</div>
                    </div>
                <?php endif; ?>
                <?php if ($volatility) : ?>
                    <div class="slot-stat">
                        <div class="stat-value"><?php echo esc_html($volatility); ?></div>
                        <div class="stat-label">Volatility</div>
                    </div>
                <?php endif; ?>
                <?php if ($max_win) : ?>
                    <div class="slot-stat">
                        <div class="stat-value"><?php echo esc_html($max_win); ?></div>
                        <div class="stat-label">Max Win</div>
                    </div>
                <?php endif; ?>
                <?php if ($provider) : ?>
                    <div class="slot-stat">
                        <div class="stat-value"><?php echo esc_html($provider); ?></div>
                        <div class="stat-label">Provider</div>
                    </div>
                <?php endif; ?>
            </div>

            <!-- Play Now CTA -->
            <?php if ($affiliate) : ?>
                <div style="text-align:center;margin-bottom:2rem;">
                    <a href="<?php echo esc_url($affiliate); ?>" class="btn btn-play" target="_blank" rel="noopener noreferrer nofollow" style="font-size:1rem;padding:0.75rem 2rem;">
                        Play <?php the_title(); ?> Now
                    </a>
                    <p style="font-size:0.75rem;color:var(--og-text-light);margin-top:0.5rem;">
                        19+. T&Cs apply. Play at AGCO-licensed Ontario casinos only.
                    </p>
                </div>
            <?php endif; ?>

            <?php ontariogamers_affiliate_disclosure(); ?>

            <!-- Detailed Stats Table -->
            <table class="slot-details-table" style="width:100%;border-collapse:collapse;margin-bottom:2rem;">
                <tbody>
                    <?php if ($rtp) : ?>
                        <tr><td style="padding:0.6rem;border-bottom:1px solid var(--og-border);font-weight:600;">RTP (Verified)</td><td style="padding:0.6rem;border-bottom:1px solid var(--og-border);"><?php echo esc_html($rtp); ?>%</td></tr>
                    <?php endif; ?>
                    <?php if ($volatility) : ?>
                        <tr><td style="padding:0.6rem;border-bottom:1px solid var(--og-border);font-weight:600;">Volatility</td><td style="padding:0.6rem;border-bottom:1px solid var(--og-border);"><?php echo esc_html($volatility); ?></td></tr>
                    <?php endif; ?>
                    <?php if ($max_win) : ?>
                        <tr><td style="padding:0.6rem;border-bottom:1px solid var(--og-border);font-weight:600;">Maximum Win</td><td style="padding:0.6rem;border-bottom:1px solid var(--og-border);"><?php echo esc_html($max_win); ?></td></tr>
                    <?php endif; ?>
                    <?php if ($provider) : ?>
                        <tr><td style="padding:0.6rem;border-bottom:1px solid var(--og-border);font-weight:600;">Provider</td><td style="padding:0.6rem;border-bottom:1px solid var(--og-border);"><?php echo esc_html($provider); ?></td></tr>
                    <?php endif; ?>
                    <?php if ($reels) : ?>
                        <tr><td style="padding:0.6rem;border-bottom:1px solid var(--og-border);font-weight:600;">Reel Layout</td><td style="padding:0.6rem;border-bottom:1px solid var(--og-border);"><?php echo esc_html($reels); ?></td></tr>
                    <?php endif; ?>
                    <?php if ($paylines) : ?>
                        <tr><td style="padding:0.6rem;border-bottom:1px solid var(--og-border);font-weight:600;">Paylines/Ways</td><td style="padding:0.6rem;border-bottom:1px solid var(--og-border);"><?php echo esc_html($paylines); ?></td></tr>
                    <?php endif; ?>
                    <?php if ($min_bet && $max_bet) : ?>
                        <tr><td style="padding:0.6rem;border-bottom:1px solid var(--og-border);font-weight:600;">Bet Range (CAD)</td><td style="padding:0.6rem;border-bottom:1px solid var(--og-border);">$<?php echo esc_html($min_bet); ?> — $<?php echo esc_html($max_bet); ?></td></tr>
                    <?php endif; ?>
                    <?php if ($theme) : ?>
                        <tr><td style="padding:0.6rem;border-bottom:1px solid var(--og-border);font-weight:600;">Theme</td><td style="padding:0.6rem;border-bottom:1px solid var(--og-border);"><?php echo esc_html($theme); ?></td></tr>
                    <?php endif; ?>
                </tbody>
            </table>

            <!-- Main Review Content -->
            <div class="review-content">
                <?php
                while (have_posts()) :
                    the_post();
                    the_content();
                endwhile;
                ?>
            </div>

            <!-- Responsible Gambling -->
            <?php ontariogamers_disclaimer(); ?>

            <!-- Author Box -->
            <div class="author-box">
                <?php echo get_avatar(get_the_author_meta('ID'), 80); ?>
                <div>
                    <div class="author-name"><?php the_author(); ?></div>
                    <div class="author-title">Slot Reviewer — OntarioGamers.ca</div>
                    <div class="author-bio"><?php the_author_meta('description'); ?></div>
                </div>
            </div>

        </main>

        <!-- Sidebar -->
        <aside class="sidebar">
            <?php get_sidebar(); ?>
        </aside>
    </div>
</div>

<?php get_footer(); ?>
