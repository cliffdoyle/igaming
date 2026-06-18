<?php
/**
 * Template Part: Slot Card
 * Reusable slot listing card for grid displays
 * Include with: get_template_part('template-parts/slot-card');
 */

$rtp        = get_post_meta(get_the_ID(), 'slot_rtp', true);
$volatility = get_post_meta(get_the_ID(), 'slot_volatility', true);
$max_win    = get_post_meta(get_the_ID(), 'slot_max_win', true);
$provider   = get_post_meta(get_the_ID(), 'slot_provider', true);
?>

<a href="<?php the_permalink(); ?>" class="archive-card" style="text-decoration:none;color:inherit;">
    <?php if (has_post_thumbnail()) : ?>
        <?php the_post_thumbnail('card-thumbnail'); ?>
    <?php else : ?>
        <div style="height:180px;background:var(--og-bg-alt);display:flex;align-items:center;justify-content:center;font-weight:700;color:var(--og-text-light);">
            <?php the_title(); ?>
        </div>
    <?php endif; ?>
    <div class="card-content">
        <h3><?php the_title(); ?></h3>
        <p>
            <?php if ($rtp) echo 'RTP: ' . esc_html($rtp) . '%'; ?>
            <?php if ($volatility) echo ' | ' . esc_html($volatility); ?>
            <?php if ($max_win) echo ' | Max: ' . esc_html($max_win); ?>
        </p>
        <?php if ($provider) : ?>
            <span style="font-size:0.75rem;background:var(--og-bg-alt);padding:0.2rem 0.5rem;border-radius:4px;">
                <?php echo esc_html($provider); ?>
            </span>
        <?php endif; ?>
    </div>
</a>
