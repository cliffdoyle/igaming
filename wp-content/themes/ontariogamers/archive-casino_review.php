<?php
/**
 * Casino Reviews Archive (listing page)
 * URL: /online-casinos/
 */

get_header();
?>

<div class="site-container">
    <div class="content-area">
        <main class="article-content" style="max-width:100%;">

            <h1>Best Online Casinos Ontario — <?php echo date('Y'); ?></h1>

            <p>
                Every casino listed below is verified as AGCO-registered on the iGaming Ontario operator directory.
                We test deposits, withdrawals, game libraries and responsible gambling tools before recommending any operator.
                Updated monthly.
            </p>

            <?php ontariogamers_affiliate_disclosure(); ?>

            <!-- Casino Cards -->
            <?php if (have_posts()) : ?>
                <?php while (have_posts()) : the_post();
                    $rating     = get_post_meta(get_the_ID(), 'casino_rating', true);
                    $bonus      = get_post_meta(get_the_ID(), 'casino_bonus_description', true);
                    $affiliate  = get_post_meta(get_the_ID(), 'casino_affiliate_url', true);
                    $license    = get_post_meta(get_the_ID(), 'casino_license', true);
                    $withdrawal = get_post_meta(get_the_ID(), 'casino_withdrawal_time', true);
                    ?>
                    <div class="casino-card">
                        <div>
                            <?php if (has_post_thumbnail()) : ?>
                                <?php the_post_thumbnail('casino-logo', array('class' => 'casino-logo')); ?>
                            <?php else : ?>
                                <div class="casino-logo" style="display:flex;align-items:center;justify-content:center;background:#f0f0f0;font-weight:700;font-size:0.7rem;"><?php the_title(); ?></div>
                            <?php endif; ?>
                        </div>

                        <div class="casino-info">
                            <h3><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
                            <div class="casino-bonus"><?php echo esc_html($bonus ?: 'Welcome bonus available — see operator for current terms'); ?></div>
                            <div class="casino-meta">
                                <?php if ($license) : ?><span>✓ <?php echo esc_html($license); ?></span><?php endif; ?>
                                <?php if ($withdrawal) : ?><span>⏱ <?php echo esc_html($withdrawal); ?></span><?php endif; ?>
                                <?php if ($rating) : ?><span>⭐ <?php echo esc_html($rating); ?>/10</span><?php endif; ?>
                            </div>
                        </div>

                        <div class="casino-actions">
                            <a href="<?php the_permalink(); ?>" class="btn btn-review">Read Review</a>
                            <?php if ($affiliate) : ?>
                                <a href="<?php echo esc_url($affiliate); ?>" class="btn btn-play" target="_blank" rel="noopener noreferrer nofollow">Play Now</a>
                            <?php endif; ?>
                        </div>

                        <div class="casino-disclaimer">
                            New players only. 19+. Ontario players: bonus terms cannot be publicly displayed under AGCO Standard 11.10. Always read full T&Cs. Wagering requirements apply.
                        </div>
                    </div>
                <?php endwhile; ?>

                <!-- Pagination -->
                <div style="margin-top:2rem;text-align:center;">
                    <?php the_posts_pagination(); ?>
                </div>
            <?php else : ?>
                <p>Casino reviews coming soon. Check back shortly.</p>
            <?php endif; ?>

            <?php ontariogamers_disclaimer(); ?>

        </main>
    </div>
</div>

<?php get_footer(); ?>
