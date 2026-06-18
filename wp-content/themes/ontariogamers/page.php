<?php
/**
 * Generic Page Template
 */

get_header();
?>

<div class="site-container">
    <div class="content-area">
        <main class="article-content">

            <?php
            while (have_posts()) :
                the_post();
                ?>
                <h1><?php the_title(); ?></h1>

                <p style="font-size:0.85rem;color:var(--og-text-light);margin-bottom:2rem;">
                    Last Updated: <?php echo get_the_modified_date('F Y'); ?>
                </p>

                <div class="page-content">
                    <?php the_content(); ?>
                </div>
            <?php endwhile; ?>

        </main>

        <aside class="sidebar">
            <?php get_sidebar(); ?>
        </aside>
    </div>
</div>

<?php get_footer(); ?>
