<?php
/**
 * Blog / News index (the page set as "Posts page" in Settings → Reading).
 * URL: /news/
 */

get_header();

$posts_page_id = (int) get_option('page_for_posts');
$heading = $posts_page_id ? get_the_title($posts_page_id) : 'Ontario Gambling News';
?>

<div class="site-container">
    <div class="content-area">
        <main class="article-content">

            <h1><?php echo esc_html($heading); ?></h1>
            <p>The latest Ontario casino, slot and sports-betting news — plus plain-English guides to help you play smarter and safer.</p>

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
                <p>No articles published yet. Check back soon.</p>
            <?php endif; ?>

        </main>

        <aside class="sidebar">
            <?php get_sidebar(); ?>
        </aside>
    </div>
</div>

<?php get_footer(); ?>
