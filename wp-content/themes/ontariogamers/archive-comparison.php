<?php
/**
 * Comparisons Archive (listing page)
 * URL: /comparisons/
 */

get_header();
?>

<div class="site-container">
    <div class="content-area">
        <main class="article-content" style="max-width:100%;">

            <h1>Ontario Casino Comparisons — <?php echo date('Y'); ?></h1>

            <p>
                Head-to-head comparisons of AGCO-licensed Ontario online casinos — payout speeds, banking options,
                mobile apps, customer support and responsible gambling tools, tested by our team.
            </p>

            <?php if (function_exists('ontariogamers_affiliate_disclosure')) ontariogamers_affiliate_disclosure(); ?>

            <?php if (have_posts()) : ?>
                <div class="archive-grid">
                    <?php while (have_posts()) : the_post(); ?>
                        <a href="<?php the_permalink(); ?>" class="archive-card" style="display:block;text-decoration:none;color:inherit;">
                            <?php if (has_post_thumbnail()) : the_post_thumbnail('medium_large'); endif; ?>
                            <div class="card-content">
                                <h3><?php the_title(); ?></h3>
                                <p><?php echo esc_html(wp_trim_words(get_the_excerpt(), 26)); ?></p>
                                <span class="btn btn-review">Read Comparison →</span>
                            </div>
                        </a>
                    <?php endwhile; ?>
                </div>

                <div style="margin-top:2rem;text-align:center;">
                    <?php the_posts_pagination(array('mid_size' => 2, 'prev_text' => '← Prev', 'next_text' => 'Next →')); ?>
                </div>
            <?php else : ?>
                <p>No comparisons published yet — check back soon.</p>
            <?php endif; ?>

        </main>

        <aside class="sidebar">
            <?php get_sidebar(); ?>
        </aside>
    </div>
</div>

<?php get_footer(); ?>
