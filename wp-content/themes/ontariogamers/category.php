<?php
/**
 * Category archive (e.g. /category/casino-news/).
 * Reuses the news-card layout.
 */

get_header();
?>

<div class="site-container">
    <div class="content-area">
        <main class="article-content">

            <h1><?php single_cat_title(); ?></h1>
            <?php if (category_description()) : ?>
                <div class="archive-description"><?php echo category_description(); ?></div>
            <?php endif; ?>

            <?php if (have_posts()) : ?>
                <div class="news-grid">
                    <?php while (have_posts()) : the_post(); ?>
                        <?php get_template_part('template-parts/news', 'card'); ?>
                    <?php endwhile; ?>
                </div>
                <div style="margin-top:2rem;text-align:center;">
                    <?php the_posts_pagination(); ?>
                </div>
            <?php else : ?>
                <p>No articles in this category yet. Check back soon.</p>
            <?php endif; ?>

        </main>

        <aside class="sidebar">
            <?php get_sidebar(); ?>
        </aside>
    </div>
</div>

<?php get_footer(); ?>
