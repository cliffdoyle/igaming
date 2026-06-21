<?php
/**
 * News article card — used in the news index, category archives and the
 * "Latest News" strip on the homepage. Expects to run inside a post loop.
 */
if (!defined('ABSPATH')) {
    exit;
}
$cats = get_the_category_list(', ');
?>
<article class="news-card">
    <a href="<?php the_permalink(); ?>" class="news-card-media" tabindex="-1" aria-hidden="true">
        <?php if (has_post_thumbnail()) : ?>
            <?php the_post_thumbnail('card-thumbnail'); ?>
        <?php else : ?>
            <span class="news-card-placeholder">Ontario<strong>Gamers</strong></span>
        <?php endif; ?>
    </a>
    <div class="news-card-body">
        <?php if ($cats) : ?>
            <div class="news-card-cat"><?php echo wp_kses_post($cats); ?></div>
        <?php endif; ?>
        <h3 class="news-card-title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
        <p class="news-card-meta"><?php echo esc_html(get_the_date()); ?> &middot; By <?php the_author(); ?></p>
        <p class="news-card-excerpt"><?php echo esc_html(wp_trim_words(get_the_excerpt(), 24)); ?></p>
        <a href="<?php the_permalink(); ?>" class="btn btn-review">Read Article</a>
    </div>
</article>
