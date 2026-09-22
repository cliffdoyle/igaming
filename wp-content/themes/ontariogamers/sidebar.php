<?php
/**
 * Sidebar Template
 */
?>

<div class="sidebar">
    <!-- Top Casinos Widget (hardcoded for now, can be dynamic later) -->
    <div class="sidebar-widget">
        <h3>Top Ontario Casinos</h3>
        <?php
        $top_casinos = new WP_Query(array(
            'post_type'      => 'casino_review',
            'posts_per_page' => 5,
            'orderby'        => 'menu_order',
            'order'          => 'ASC',
        ));

        if ($top_casinos->have_posts()) :
            while ($top_casinos->have_posts()) : $top_casinos->the_post();
                ?>
                <a href="<?php the_permalink(); ?>" class="sidebar-casino" style="text-decoration:none;color:inherit;">
                    <?php if (has_post_thumbnail()) : ?>
                        <?php the_post_thumbnail(array(40, 40)); ?>
                    <?php endif; ?>
                    <div>
                        <div class="casino-name"><?php the_title(); ?></div>
                    </div>
                </a>
                <?php
            endwhile;
            wp_reset_postdata();
        endif;
        ?>
    </div>

    <!-- Featured Sportsbooks Widget (sportsbook reviews live under Sports Picks) -->
    <?php
    $top_sportsbooks = new WP_Query(array(
        'post_type'      => 'sports_pick',
        'posts_per_page' => 5,
        'orderby'        => 'menu_order',
        'order'          => 'ASC',
        'meta_query'     => array(
            array(
                'key'     => 'casino_rating',
                'compare' => 'EXISTS',
            ),
        ),
    ));
    if ($top_sportsbooks->have_posts()) :
        ?>
        <div class="sidebar-widget">
            <h3>Featured Sportsbooks</h3>
            <?php
            while ($top_sportsbooks->have_posts()) : $top_sportsbooks->the_post();
                ?>
                <a href="<?php the_permalink(); ?>" class="sidebar-casino" style="text-decoration:none;color:inherit;">
                    <?php if (has_post_thumbnail()) : ?>
                        <?php the_post_thumbnail(array(40, 40)); ?>
                    <?php endif; ?>
                    <div>
                        <div class="casino-name"><?php the_title(); ?></div>
                    </div>
                </a>
                <?php
            endwhile;
            wp_reset_postdata();
            ?>
        </div>
        <?php
    endif;
    ?>

    <!-- Responsible Gambling Widget -->
    <div class="sidebar-widget" style="background:#fef3cd;border-color:#ffc107;">
        <h3>Play Responsibly</h3>
        <p style="font-size:0.8rem;margin-bottom:0.5rem;">19+ only. Never bet more than you can afford to lose.</p>
        <p style="font-size:0.8rem;margin-bottom:0.5rem;"><strong>ConnexOntario:</strong> 1-866-531-2600</p>
        <p style="font-size:0.8rem;"><a href="<?php echo esc_url(home_url('/responsible-gambling/')); ?>">Full resources →</a></p>
    </div>

    <!-- Dynamic widgets area -->
    <?php if (is_active_sidebar('sidebar-main')) : ?>
        <?php dynamic_sidebar('sidebar-main'); ?>
    <?php endif; ?>
</div>
