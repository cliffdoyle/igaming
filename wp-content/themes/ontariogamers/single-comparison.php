<?php
/**
 * Single Comparison template — head-to-head casino comparisons.
 * URL: /comparisons/<slug>/
 */

get_header();
?>

<div class="site-container">
    <div class="content-area">
        <main class="article-content">

            <!-- Breadcrumb -->
            <p style="font-size:0.85rem;color:var(--og-text-light);margin-bottom:1.5rem;">
                <a href="<?php echo esc_url(home_url('/')); ?>">Home</a> /
                <a href="<?php echo esc_url(home_url('/comparisons/')); ?>">Comparisons</a> /
                <?php the_title(); ?>
            </p>

            <h1><?php the_title(); ?></h1>

            <!-- Author & Date -->
            <p style="font-size:0.85rem;color:var(--og-text-light);margin-bottom:2rem;">
                <?php $og_author_id = (int) get_post_field('post_author', get_the_ID()); ?>
                By <a href="<?php echo esc_url(get_author_posts_url($og_author_id)); ?>"><?php echo esc_html(get_the_author_meta('display_name', $og_author_id)); ?></a> | Last Updated: <?php echo get_the_modified_date('F Y'); ?>
            </p>

            <?php if (function_exists('ontariogamers_affiliate_disclosure')) ontariogamers_affiliate_disclosure(); ?>

            <?php if (has_post_thumbnail()) : ?>
                <figure class="comparison-cover"><?php the_post_thumbnail('large', array('style' => 'width:100%;height:auto;border-radius:var(--og-radius);')); ?></figure>
            <?php endif; ?>

            <!-- Comparison content (reuses .review-content responsive styles) -->
            <div class="review-content">
                <?php
                while (have_posts()) :
                    the_post();
                    the_content();
                endwhile;
                ?>
            </div>

            <?php if (function_exists('ontariogamers_disclaimer')) ontariogamers_disclaimer(); ?>

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

        <aside class="sidebar">
            <?php get_sidebar(); ?>
        </aside>
    </div>
</div>

<?php get_footer(); ?>
