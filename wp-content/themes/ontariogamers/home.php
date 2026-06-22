<?php
/**
 * Blog / News index (the page set as "Posts page" in Settings → Reading).
 * URL: /news/
 *
 * Magazine layout: a featured lead + latest column at the top, then one section
 * per category showing only its newest articles with a "View all" link. This
 * keeps the page tidy no matter how many articles exist — depth lives in the
 * paginated category archives.
 */

get_header();

$posts_page_id = (int) get_option('page_for_posts');
$heading       = $posts_page_id ? get_the_title($posts_page_id) : 'Ontario Gambling News';
?>

<div class="site-container news-index">

    <header class="news-index-head">
        <h1><?php echo esc_html($heading); ?></h1>
        <p>The latest Ontario casino, slot and sports-betting news — plus plain-English guides to help you play smarter and safer.</p>
    </header>

    <?php
    // ---- Featured zone: newest story as a lead + the next 4 as a list ----
    $featured = new WP_Query(array(
        'post_type'           => 'post',
        'posts_per_page'      => 5,
        'ignore_sticky_posts' => true,
        'no_found_rows'       => true,
    ));

    if ($featured->have_posts()) : ?>
        <section class="news-featured">
            <?php
            $fi = 0;
            while ($featured->have_posts()) : $featured->the_post();
                $f_cats = get_the_category();
                $f_cat  = !empty($f_cats) ? $f_cats[0] : null;

                if ($fi === 0) : ?>
                    <article class="news-lead">
                        <a class="news-lead-media" href="<?php the_permalink(); ?>" tabindex="-1" aria-hidden="true">
                            <?php if (has_post_thumbnail()) : ?>
                                <?php the_post_thumbnail('large'); ?>
                            <?php else : ?>
                                <span class="news-card-placeholder">Ontario<strong>Gamers</strong></span>
                            <?php endif; ?>
                        </a>
                        <div class="news-lead-body">
                            <?php if ($f_cat) : ?>
                                <a class="news-lead-cat" href="<?php echo esc_url(get_category_link($f_cat)); ?>"><?php echo esc_html($f_cat->name); ?></a>
                            <?php endif; ?>
                            <h2 class="news-lead-title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
                            <p class="news-lead-excerpt"><?php echo esc_html(wp_trim_words(get_the_excerpt(), 30)); ?></p>
                            <p class="news-lead-meta">By <a href="<?php echo esc_url(get_author_posts_url(get_the_author_meta('ID'))); ?>" class="news-author-link"><?php the_author(); ?></a> &middot; <?php echo esc_html(get_the_date()); ?></p>
                        </div>
                    </article>
                    <div class="news-featured-list">
                <?php else : ?>
                    <?php get_template_part('template-parts/news', 'list-item'); ?>
                <?php endif; ?>

                <?php $fi++;
            endwhile; ?>
                </div><!-- /.news-featured-list -->
        </section>
    <?php endif; wp_reset_postdata(); ?>

    <?php
    // ---- One section per category, newest 3 each, with a "View all" link ----
    $cats = get_categories(array(
        'hide_empty' => true,
        'orderby'    => 'count',
        'order'      => 'DESC',
    ));

    foreach ($cats as $cat) :
        if (in_array($cat->slug, array('uncategorized', 'uncategorised'), true)) {
            continue;
        }

        $cat_q = new WP_Query(array(
            'post_type'           => 'post',
            'posts_per_page'      => 3,
            'cat'                 => $cat->term_id,
            'ignore_sticky_posts' => true,
            'no_found_rows'       => true,
        ));

        if (!$cat_q->have_posts()) {
            wp_reset_postdata();
            continue;
        }
        ?>
        <section class="news-section">
            <div class="news-section-head">
                <h2><a href="<?php echo esc_url(get_category_link($cat)); ?>"><?php echo esc_html($cat->name); ?></a></h2>
                <a class="news-section-all" href="<?php echo esc_url(get_category_link($cat)); ?>">View all <?php echo esc_html($cat->name); ?> &rarr;</a>
            </div>
            <div class="news-list">
                <?php while ($cat_q->have_posts()) : $cat_q->the_post(); ?>
                    <?php get_template_part('template-parts/news', 'list-item'); ?>
                <?php endwhile; ?>
            </div>
        </section>
        <?php
        wp_reset_postdata();
    endforeach;
    ?>

</div>

<?php get_footer(); ?>
