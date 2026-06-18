<?php
/**
 * Single Casino Review Template
 * Mirrors TheMapleEdge casino review page structure
 */

get_header();

// Get custom fields
$rating       = get_post_meta(get_the_ID(), 'casino_rating', true);
$bonus        = get_post_meta(get_the_ID(), 'casino_bonus_description', true);
$affiliate    = get_post_meta(get_the_ID(), 'casino_affiliate_url', true);
$license      = get_post_meta(get_the_ID(), 'casino_license', true);
$deposit      = get_post_meta(get_the_ID(), 'casino_deposit_methods', true);
$withdrawal   = get_post_meta(get_the_ID(), 'casino_withdrawal_time', true);
$min_deposit  = get_post_meta(get_the_ID(), 'casino_min_deposit', true);
$established  = get_post_meta(get_the_ID(), 'casino_year_established', true);
?>

<div class="site-container">
    <div class="content-area">
        <main class="article-content">

            <!-- Breadcrumb -->
            <p style="font-size:0.85rem;color:var(--og-text-light);margin-bottom:1.5rem;">
                <a href="<?php echo esc_url(home_url('/')); ?>">Home</a> /
                <a href="<?php echo esc_url(home_url('/online-casinos/')); ?>">Online Casinos</a> /
                <?php the_title(); ?>
            </p>

            <h1><?php the_title(); ?> — Ontario Review <?php echo date('Y'); ?></h1>

            <!-- Author & Date -->
            <p style="font-size:0.85rem;color:var(--og-text-light);margin-bottom:2rem;">
                By <?php the_author(); ?> | Last Updated: <?php echo get_the_modified_date('F Y'); ?>
            </p>

            <?php ontariogamers_affiliate_disclosure(); ?>

            <!-- Quick Info / Review Box -->
            <div class="review-box">
                <div class="review-header">
                    <?php if (has_post_thumbnail()) : ?>
                        <?php the_post_thumbnail('casino-logo', array('class' => 'review-logo')); ?>
                    <?php endif; ?>
                    <div>
                        <h2 style="margin:0;"><?php the_title(); ?></h2>
                        <?php if ($rating) : ?>
                            <?php echo ontariogamers_rating_display($rating); ?>
                        <?php endif; ?>
                    </div>
                </div>

                <div class="review-details">
                    <?php if ($license) : ?>
                        <div class="review-detail">
                            <span>License</span>
                            <strong>✓ <?php echo esc_html($license); ?></strong>
                        </div>
                    <?php endif; ?>
                    <?php if ($bonus) : ?>
                        <div class="review-detail">
                            <span>Welcome Bonus</span>
                            <strong><?php echo esc_html($bonus); ?></strong>
                        </div>
                    <?php endif; ?>
                    <?php if ($deposit) : ?>
                        <div class="review-detail">
                            <span>Deposit Methods</span>
                            <strong><?php echo esc_html($deposit); ?></strong>
                        </div>
                    <?php endif; ?>
                    <?php if ($withdrawal) : ?>
                        <div class="review-detail">
                            <span>Withdrawal Time</span>
                            <strong><?php echo esc_html($withdrawal); ?></strong>
                        </div>
                    <?php endif; ?>
                    <?php if ($min_deposit) : ?>
                        <div class="review-detail">
                            <span>Min Deposit</span>
                            <strong><?php echo esc_html($min_deposit); ?></strong>
                        </div>
                    <?php endif; ?>
                    <?php if ($established) : ?>
                        <div class="review-detail">
                            <span>Established</span>
                            <strong><?php echo esc_html($established); ?></strong>
                        </div>
                    <?php endif; ?>
                </div>

                <?php if ($affiliate) : ?>
                    <div style="text-align:center;margin-top:1rem;">
                        <a href="<?php echo esc_url($affiliate); ?>" class="btn btn-play" target="_blank" rel="noopener noreferrer nofollow" style="font-size:1rem;padding:0.75rem 2rem;">
                            Play Now at <?php the_title(); ?>
                        </a>
                        <p style="font-size:0.75rem;color:var(--og-text-light);margin-top:0.5rem;">
                            19+. T&Cs apply. New players only.
                        </p>
                    </div>
                <?php endif; ?>
            </div>

            <!-- Main Review Content (from WordPress editor) -->
            <div class="review-content">
                <?php
                while (have_posts()) :
                    the_post();
                    the_content();
                endwhile;
                ?>
            </div>

            <!-- Responsible Gambling Disclaimer -->
            <?php ontariogamers_disclaimer(); ?>

            <!-- Author Box -->
            <div class="author-box">
                <?php echo get_avatar(get_the_author_meta('ID'), 80); ?>
                <div>
                    <div class="author-name"><?php the_author(); ?></div>
                    <div class="author-title">Casino Reviewer — OntarioGamers.com</div>
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
