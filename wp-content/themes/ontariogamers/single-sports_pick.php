<?php
/**
 * Single Sports Pick
 * URL: /sports-picks/<pick>/
 */

get_header();

while (have_posts()) : the_post();
    $match     = get_post_meta(get_the_ID(), 'pick_match', true);
    $selection = get_post_meta(get_the_ID(), 'pick_selection', true);
    $odds      = get_post_meta(get_the_ID(), 'pick_odds', true);
    $result    = get_post_meta(get_the_ID(), 'pick_result', true);
    if (!$result) $result = 'Pending';
    $date      = get_post_meta(get_the_ID(), 'pick_event_date', true);
    $book      = get_post_meta(get_the_ID(), 'pick_sportsbook', true);
    $aff       = get_post_meta(get_the_ID(), 'pick_affiliate_url', true);
    $leagues   = get_the_term_list(get_the_ID(), 'pick_sport', '', ', ');
    $rclass    = 'result-' . strtolower($result);
    ?>

    <div class="site-container">
        <div class="content-area full-width">
            <main class="article-content">
                <article>
                    <h1><?php the_title(); ?></h1>

                    <div class="pick-summary">
                        <table>
                            <?php if ($leagues && !is_wp_error($leagues)) : ?>
                                <tr><th>Sport / League</th><td><?php echo wp_kses_post($leagues); ?></td></tr>
                            <?php endif; ?>
                            <?php if ($match) : ?><tr><th>Match</th><td><?php echo esc_html($match); ?></td></tr><?php endif; ?>
                            <?php if ($selection) : ?><tr><th>Our Pick</th><td><strong><?php echo esc_html($selection); ?></strong></td></tr><?php endif; ?>
                            <?php if ($odds) : ?><tr><th>Odds</th><td><?php echo esc_html($odds); ?></td></tr><?php endif; ?>
                            <?php if ($date) : ?><tr><th>Event Date</th><td><?php echo esc_html(date_i18n('M j, Y', strtotime($date))); ?></td></tr><?php endif; ?>
                            <tr><th>Result</th><td><span class="pick-result <?php echo esc_attr($rclass); ?>"><?php echo esc_html($result); ?></span></td></tr>
                        </table>
                    </div>

                    <?php ontariogamers_affiliate_disclosure(); ?>

                    <div class="entry-content">
                        <?php the_content(); ?>
                    </div>

                    <?php if ($aff) : ?>
                        <p style="margin-top:1.5rem;">
                            <a href="<?php echo esc_url($aff); ?>" class="btn btn-play" target="_blank" rel="noopener noreferrer nofollow">Bet at <?php echo esc_html($book ? $book : 'Sportsbook'); ?></a>
                        </p>
                    <?php endif; ?>
                </article>

                <?php ontariogamers_disclaimer(); ?>
            </main>
        </div>
    </div>

<?php endwhile;

get_footer();
