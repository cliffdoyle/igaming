<?php
/**
 * Single blog / news article.
 */

get_header();

while (have_posts()) :
    the_post();
    $cats = get_the_category_list(', ');
    ?>

    <div class="site-container">
        <div class="content-area">
            <main class="article-content">

                <!-- Breadcrumb -->
                <p style="font-size:0.85rem;color:var(--og-text-light);margin-bottom:1.25rem;">
                    <a href="<?php echo esc_url(home_url('/')); ?>">Home</a> /
                    <a href="<?php echo esc_url(get_permalink(get_option('page_for_posts'))); ?>">News</a> /
                    <?php the_title(); ?>
                </p>

                <?php if ($cats) : ?>
                    <div class="news-card-cat" style="margin-bottom:0.5rem;"><?php echo wp_kses_post($cats); ?></div>
                <?php endif; ?>

                <h1><?php the_title(); ?></h1>

                <p style="font-size:0.85rem;color:var(--og-text-light);margin-bottom:1.5rem;">
                    <?php echo esc_html(get_the_date()); ?> &middot; By <?php the_author(); ?> &middot; Last updated <?php echo esc_html(get_the_modified_date('F Y')); ?>
                </p>

                <?php if (has_post_thumbnail()) : ?>
                    <div class="single-featured">
                        <?php the_post_thumbnail('large'); ?>
                    </div>
                <?php endif; ?>

                <?php ontariogamers_affiliate_disclosure(); ?>

                <div class="entry-content">
                    <?php the_content(); ?>
                </div>

                <?php if (has_tag()) : ?>
                    <p class="post-tags" style="margin-top:1.5rem;font-size:0.85rem;"><?php the_tags('Tags: ', ', ', ''); ?></p>
                <?php endif; ?>

                <!-- Internal-linking CTA: funnel readers into the money pages -->
                <div class="related-cta">
                    <h3>Ready to play in Ontario?</h3>
                    <p>Every operator we recommend is verified as AGCO-registered with iGaming Ontario.</p>
                    <div class="related-cta-buttons">
                        <a href="<?php echo esc_url(home_url('/online-casinos/')); ?>" class="btn btn-review">Top Casinos</a>
                        <a href="<?php echo esc_url(home_url('/online-slots/')); ?>" class="btn btn-review">Slot Reviews</a>
                        <a href="<?php echo esc_url(home_url('/sports-picks/')); ?>" class="btn btn-review">Sports Picks</a>
                    </div>
                </div>

                <!-- Author Box -->
                <div class="author-box">
                    <?php echo get_avatar(get_the_author_meta('ID'), 80); ?>
                    <div>
                        <div class="author-name"><?php the_author(); ?></div>
                        <div class="author-title">Editor — OntarioGamers.com</div>
                        <div class="author-bio"><?php the_author_meta('description'); ?></div>
                    </div>
                </div>

                <?php ontariogamers_disclaimer(); ?>

            </main>

            <aside class="sidebar">
                <?php get_sidebar(); ?>
            </aside>
        </div>
    </div>

<?php endwhile;

get_footer();
