<?php
/**
 * Sport / League taxonomy archive
 * URL: /sport/<league>/  e.g. /sport/nhl/
 */

get_header();
$term = get_queried_object();
?>

<div class="site-container">
    <div class="content-area full-width">
        <main class="article-content" style="max-width:100%;">

            <h1><?php echo esc_html($term->name); ?> Picks — <?php echo date('Y'); ?></h1>

            <?php if (!empty($term->description)) : ?>
                <p><?php echo esc_html($term->description); ?></p>
            <?php else : ?>
                <p>Our latest <?php echo esc_html($term->name); ?> betting picks for Ontario bettors. Every pick shows the selection, odds and final result.</p>
            <?php endif; ?>

            <?php ontariogamers_affiliate_disclosure(); ?>

            <?php get_template_part('template-parts/sports-picks', 'loop'); ?>

            <?php ontariogamers_disclaimer(); ?>

        </main>
    </div>
</div>

<?php get_footer(); ?>
