<?php
/**
 * Compact news list item — small square thumbnail + category + headline + byline.
 * Used in the featured "Latest" column and inside each category section on the
 * news index. Runs inside a post loop.
 */
if (!defined('ABSPATH')) {
    exit;
}
$og_cats = get_the_category();
$og_cat  = !empty($og_cats) ? $og_cats[0] : null;
?>
<article class="news-li">
    <a class="news-li-media" href="<?php the_permalink(); ?>" tabindex="-1" aria-hidden="true">
        <?php if (has_post_thumbnail()) : ?>
            <?php the_post_thumbnail('card-thumbnail'); ?>
        <?php else : ?>
            <span class="news-li-ph">OG</span>
        <?php endif; ?>
    </a>
    <div class="news-li-body">
        <?php if ($og_cat) : ?>
            <a class="news-li-cat" href="<?php echo esc_url(get_category_link($og_cat)); ?>"><?php echo esc_html($og_cat->name); ?></a>
        <?php endif; ?>
        <h4 class="news-li-title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h4>
        <p class="news-li-meta">By <?php the_author(); ?> &middot; <?php echo esc_html(get_the_date()); ?></p>
    </div>
</article>
