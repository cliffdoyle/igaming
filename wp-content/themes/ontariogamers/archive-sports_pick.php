<?php
/**
 * Sports Picks Archive (listing page)
 * URL: /sports-picks/
 */

get_header();
?>

<div class="site-container">
    <div class="content-area full-width">
        <main class="article-content" style="max-width:100%;">

            <h1>Free Ontario Sports Picks — <?php echo date('Y'); ?></h1>

            <p>
                Our latest sports betting picks for Ontario bettors across the NHL, NBA, NFL and more.
                Every pick shows the selection, the odds and the final result — wins and losses both displayed,
                for full transparency.
            </p>

            <?php ontariogamers_affiliate_disclosure(); ?>

            <?php get_template_part('template-parts/sports-picks', 'loop'); ?>

            <?php ontariogamers_disclaimer(); ?>

        </main>
    </div>
</div>

<?php get_footer(); ?>
