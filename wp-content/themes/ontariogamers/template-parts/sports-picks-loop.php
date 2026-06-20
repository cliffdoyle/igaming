<?php
/**
 * Reusable Sports Picks loop.
 * Used by archive-sports_pick.php and taxonomy-pick_sport.php.
 * Runs against the current main query.
 */
if (!defined('ABSPATH')) {
    exit;
}

if (have_posts()) : ?>
    <div class="picks-list">
        <?php while (have_posts()) : the_post();
            $match     = get_post_meta(get_the_ID(), 'pick_match', true);
            $selection = get_post_meta(get_the_ID(), 'pick_selection', true);
            $odds      = get_post_meta(get_the_ID(), 'pick_odds', true);
            $result    = get_post_meta(get_the_ID(), 'pick_result', true);
            if (!$result) $result = 'Pending';
            $date      = get_post_meta(get_the_ID(), 'pick_event_date', true);
            $leagues   = get_the_term_list(get_the_ID(), 'pick_sport', '', ', ');
            $rclass    = 'result-' . strtolower($result);
            ?>
            <article class="pick-card">
                <div class="pick-card-head">
                    <?php if ($leagues && !is_wp_error($leagues)) : ?>
                        <span class="pick-league"><?php echo wp_kses_post($leagues); ?></span>
                    <?php else : ?>
                        <span class="pick-league">Sports Pick</span>
                    <?php endif; ?>
                    <span class="pick-result <?php echo esc_attr($rclass); ?>"><?php echo esc_html($result); ?></span>
                </div>
                <h3 class="pick-title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
                <?php if ($match) : ?><p class="pick-match"><?php echo esc_html($match); ?></p><?php endif; ?>
                <div class="pick-meta">
                    <?php if ($selection) : ?><span><strong>Pick:</strong> <?php echo esc_html($selection); ?></span><?php endif; ?>
                    <?php if ($odds) : ?><span><strong>Odds:</strong> <?php echo esc_html($odds); ?></span><?php endif; ?>
                    <?php if ($date) : ?><span><strong>Date:</strong> <?php echo esc_html(date_i18n('M j, Y', strtotime($date))); ?></span><?php endif; ?>
                </div>
                <a href="<?php the_permalink(); ?>" class="btn btn-review">Read Analysis</a>
            </article>
        <?php endwhile; ?>
    </div>

    <div style="margin-top:2rem;text-align:center;">
        <?php the_posts_pagination(); ?>
    </div>
<?php else : ?>
    <p>No picks published here yet. Check back soon.</p>
<?php endif;
