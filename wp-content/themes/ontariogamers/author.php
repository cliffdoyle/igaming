<?php
/**
 * Author archive — a public profile page for each writer, listing their bio,
 * LinkedIn, and every article they've published. URL: /author/<name>/
 */

get_header();

$author    = get_queried_object(); // WP_User on an author archive
$author_id = isset($author->ID) ? (int) $author->ID : 0;

$bio      = get_the_author_meta('description', $author_id);
$linkedin = get_the_author_meta('linkedin', $author_id);
$email    = get_the_author_meta('public_email', $author_id);
$role     = function_exists('ontariogamers_author_role') ? ontariogamers_author_role($author_id) : 'Writer — OntarioGamers.ca';
$count    = (int) count_user_posts($author_id, 'post', true);
?>

<div class="site-container">
    <section class="author-archive">

        <div class="author-hero">
            <div class="author-hero-avatar">
                <?php echo get_avatar($author_id, 140); ?>
            </div>
            <div class="author-hero-info">
                <span class="author-eyebrow">About the Author</span>
                <h1><?php echo esc_html($author->display_name); ?></h1>
                <div class="author-role"><?php echo esc_html($role); ?></div>

                <div class="author-links">
                    <?php if ($linkedin) : ?>
                        <a href="<?php echo esc_url($linkedin); ?>" target="_blank" rel="noopener nofollow" class="author-link author-link-linkedin">
                            <span aria-hidden="true">in</span> LinkedIn
                        </a>
                    <?php endif; ?>
                    <?php if ($email) : ?>
                        <a href="mailto:<?php echo esc_attr($email); ?>" class="author-link author-link-email">
                            <span aria-hidden="true">&#9993;</span> Email
                        </a>
                    <?php endif; ?>
                    <span class="author-link author-link-posts"><?php echo $count; ?> article<?php echo ($count === 1 ? '' : 's'); ?></span>
                </div>

                <?php if ($bio) : ?>
                    <p class="author-bio-full"><?php echo esc_html($bio); ?></p>
                <?php endif; ?>
            </div>
        </div>

        <h2 class="author-posts-title">Latest from <?php echo esc_html($author->display_name); ?></h2>

        <?php if (have_posts()) : ?>
            <div class="news-grid">
                <?php while (have_posts()) : the_post(); ?>
                    <?php get_template_part('template-parts/news-card'); ?>
                <?php endwhile; ?>
            </div>

            <div class="author-pagination">
                <?php the_posts_pagination(array(
                    'mid_size'  => 1,
                    'prev_text' => '&laquo; Newer',
                    'next_text' => 'Older &raquo;',
                )); ?>
            </div>
        <?php else : ?>
            <p>No articles published yet — check back soon.</p>
        <?php endif; ?>

    </section>
</div>

<?php get_footer();
