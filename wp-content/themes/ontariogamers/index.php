<?php
/**
 * Fallback template
 */

get_header();
?>

<div class="site-container">
    <div class="content-area">
        <main class="article-content">
            <?php
            if (have_posts()) :
                while (have_posts()) :
                    the_post();
                    ?>
                    <article>
                        <h2><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
                        <p style="font-size:0.85rem;color:var(--og-text-light);">
                            <?php echo get_the_date(); ?> | By <?php the_author(); ?>
                        </p>
                        <?php the_excerpt(); ?>
                        <a href="<?php the_permalink(); ?>" class="btn btn-review">Read More</a>
                    </article>
                    <hr style="margin:2rem 0;border:none;border-top:1px solid var(--og-border);">
                    <?php
                endwhile;
                the_posts_pagination();
            else :
                echo '<p>No content found.</p>';
            endif;
            ?>
        </main>

        <aside class="sidebar">
            <?php get_sidebar(); ?>
        </aside>
    </div>
</div>

<?php get_footer(); ?>
