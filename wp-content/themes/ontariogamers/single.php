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

                <?php
                $og_author_id  = (int) get_the_author_meta('ID');
                $og_author_url = get_author_posts_url($og_author_id);
                ?>
                <div class="article-byline">
                    <a href="<?php echo esc_url($og_author_url); ?>" class="article-byline-avatar"><?php echo get_avatar($og_author_id, 44); ?></a>
                    <span class="article-byline-text">
                        By <a href="<?php echo esc_url($og_author_url); ?>" class="article-byline-name"><?php the_author(); ?></a><br>
                        <?php echo esc_html(get_the_date()); ?> &middot; Last updated <?php echo esc_html(get_the_modified_date('F Y')); ?>
                    </span>
                </div>

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
                    <a href="<?php echo esc_url($og_author_url); ?>"><?php echo get_avatar($og_author_id, 80); ?></a>
                    <div>
                        <div class="author-name"><a href="<?php echo esc_url($og_author_url); ?>"><?php the_author(); ?></a></div>
                        <div class="author-title"><?php echo esc_html(function_exists('ontariogamers_author_role') ? ontariogamers_author_role($og_author_id) : 'Writer — OntarioGamers.ca'); ?></div>
                        <?php
                        $og_li = get_the_author_meta('linkedin');
                        $og_pe = get_the_author_meta('public_email');
                        ?>
                        <div class="author-social">
                            <?php if ($og_li) : ?><a href="<?php echo esc_url($og_li); ?>" target="_blank" rel="noopener nofollow">LinkedIn</a><?php endif; ?>
                            <?php if ($og_pe) : ?><a href="mailto:<?php echo esc_attr($og_pe); ?>">Email</a><?php endif; ?>
                            <a href="<?php echo esc_url($og_author_url); ?>">View all posts</a>
                        </div>
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
