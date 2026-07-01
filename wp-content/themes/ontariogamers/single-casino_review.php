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
                <?php $og_author_id = (int) get_post_field('post_author', get_the_ID()); ?>
                By <a href="<?php echo esc_url(get_author_posts_url($og_author_id)); ?>"><?php echo esc_html(get_the_author_meta('display_name', $og_author_id)); ?></a> | Last Updated: <?php echo get_the_modified_date('F Y'); ?>
            </p>

            <?php ontariogamers_affiliate_disclosure(); ?>

            <!-- Quick Info / Review Box -->
            <div class="review-box">
                <div class="review-header">
                    <?php if ($affiliate && has_post_thumbnail()) : ?>
                        <a href="<?php echo esc_url($affiliate); ?>" class="review-logo-link" target="_blank" rel="<?php echo esc_attr(ontariogamers_aff_rel()); ?>" aria-label="Visit <?php the_title_attribute(); ?>">
                            <?php the_post_thumbnail('casino-logo', array('class' => 'review-logo')); ?>
                        </a>
                    <?php elseif (has_post_thumbnail()) : ?>
                        <?php the_post_thumbnail('casino-logo', array('class' => 'review-logo')); ?>
                    <?php endif; ?>
                    <div style="flex:1;">
                        <h2 style="margin:0;">
                            <?php if ($affiliate) : ?>
                                <a href="<?php echo esc_url($affiliate); ?>" target="_blank" rel="<?php echo esc_attr(ontariogamers_aff_rel()); ?>" style="color:inherit;text-decoration:none;"><?php the_title(); ?></a>
                            <?php else : ?>
                                <?php the_title(); ?>
                            <?php endif; ?>
                        </h2>
                        <?php if ($rating) : ?>
                            <?php echo ontariogamers_rating_display($rating); ?>
                        <?php endif; ?>
                        <?php if ($affiliate) : ?>
                            <div style="margin-top:0.75rem;">
                                <a href="<?php echo esc_url($affiliate); ?>" class="btn btn-play" target="_blank" rel="<?php echo esc_attr(ontariogamers_aff_rel()); ?>" style="font-size:1rem;padding:0.6rem 1.75rem;">CLAIM BONUS</a>
                            </div>
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
                        <a href="<?php echo esc_url($affiliate); ?>" class="btn btn-play" target="_blank" rel="<?php echo esc_attr(ontariogamers_aff_rel()); ?>" style="font-size:1rem;padding:0.75rem 2rem;">
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
            <?php
            $og_author_id  = (int) get_post_field('post_author', get_the_ID());
            $og_author_url = get_author_posts_url($og_author_id);
            $og_li = get_the_author_meta('linkedin', $og_author_id);
            $og_pe = get_the_author_meta('public_email', $og_author_id);
            ?>
            <div class="author-box">
                <a href="<?php echo esc_url($og_author_url); ?>"><?php echo get_avatar($og_author_id, 80); ?></a>
                <div>
                    <div class="author-name"><a href="<?php echo esc_url($og_author_url); ?>"><?php echo esc_html(get_the_author_meta('display_name', $og_author_id)); ?></a></div>
                    <div class="author-title"><?php echo esc_html(function_exists('ontariogamers_author_role') ? ontariogamers_author_role($og_author_id) : 'Casino Reviewer — OntarioGamers.ca'); ?></div>
                    <div class="author-social">
                        <?php if ($og_li) : ?><a href="<?php echo esc_url($og_li); ?>" target="_blank" rel="noopener nofollow">LinkedIn</a><?php endif; ?>
                        <?php if ($og_pe) : ?><a href="mailto:<?php echo esc_attr($og_pe); ?>">Email</a><?php endif; ?>
                        <a href="<?php echo esc_url($og_author_url); ?>">View all posts</a>
                    </div>
                    <div class="author-bio"><?php echo esc_html(get_the_author_meta('description', $og_author_id)); ?></div>
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
