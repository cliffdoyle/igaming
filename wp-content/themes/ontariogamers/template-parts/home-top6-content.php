<?php
/**
 * Homepage comparison table and detailed Top 6 casino summaries.
 */

if (!defined('ABSPATH')) {
    exit;
}

?>
<section id="top-6" class="hp-section hp-top6">
    <div class="hp-wrap">
        <header class="hp-section__head">
            <p class="hp-eyebrow">Ontario casino comparison</p>
            <h2>Top 6 Best Online Casinos Ontario — <?php echo esc_html(ontariogamers_top6_date('table_suffix')); ?></h2>
            <p>These results are from one $20 Interac test per casino on Nov 5-7, 2026. Times can vary by bank, verification, and payment method.</p>
        </header>
        <?php ontariogamers_affiliate_disclosure(); ?>

        <div class="hp-table-wrap">
            <table class="hp-table">
                <thead>
                    <tr>
                        <th scope="col">Casino</th>
                        <th scope="col">Payout time tested</th>
                        <th scope="col">Rating</th>
                        <th scope="col">Visit</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach (ontariogamers_top6_table_brands() as $brand) : ?>
                        <tr>
                            <th scope="row" class="hp-table__casino">
                                <a class="hp-table__name" href="#review-<?php echo esc_attr($brand['slug']); ?>"><?php echo esc_html($brand['title']); ?></a>
                            </th>
                            <td data-label="Payout time"><span class="hp-table__payout"><?php echo esc_html($brand['payout']); ?></span><?php if ($brand['payout_note']) : ?><small class="hp-table__note"><?php echo esc_html($brand['payout_note']); ?></small><?php elseif ($brand['payout_via']) : ?><small class="hp-table__note"><?php echo esc_html($brand['payout_via']); ?></small><?php endif; ?></td>
                            <td data-label="Rating"><strong><?php echo esc_html($brand['rating']); ?>/10</strong></td>
                            <td class="hp-table__cta" data-label="Visit casino"><?php echo ontariogamers_top6_play_link($brand, 'Play', 'hp-btn hp-btn--play hp-btn--sm'); ?></td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
        <p class="hp-table-note">A single transaction is not a typical payout guarantee. Read the operator's current rules before depositing.</p>

        <div class="hp-reviews">
            <h2>The 6 Best Online Casinos in Ontario Reviewed</h2>
            <?php foreach (ontariogamers_top6_table_brands() as $brand) : ?>
                <article id="review-<?php echo esc_attr($brand['slug']); ?>" class="hp-review">
                    <div class="hp-review__head">
                        <?php echo ontariogamers_top6_logo($brand, 'lg'); ?>
                        <div class="hp-review__titles">
                            <p class="hp-eyebrow">Rated <?php echo esc_html($brand['rating']); ?>/10</p>
                            <h3><?php echo esc_html($brand['title']); ?></h3>
                        </div>
                    </div>
                    <dl class="hp-facts">
                        <div class="hp-fact"><dt>Best for</dt><dd><?php echo esc_html($brand['best_for']); ?></dd></div>
                        <div class="hp-fact"><dt>Games tested</dt><dd><?php echo esc_html($brand['games']); ?></dd></div>
                        <div class="hp-fact hp-fact--payout"><dt>Withdrawal test</dt><dd><strong><?php echo esc_html($brand['payout']); ?></strong><?php echo $brand['payout_via'] ? ' ' . esc_html($brand['payout_via']) : ''; ?><?php if ($brand['payout_note']) : ?><span class="hp-fact__note"><?php echo esc_html($brand['payout_note']); ?></span><?php endif; ?></dd></div>
                    </dl>
                    <p><?php echo esc_html($brand['why']); ?></p>
                    <div class="hp-proscons"><div class="hp-con"><h4>Drawback</h4><p><?php echo esc_html($brand['drawback']); ?></p></div></div>
                    <div class="hp-review__foot">
                        <?php if ($brand['review_url']) : ?>
                            <a class="hp-btn hp-btn--outline" href="<?php echo esc_url($brand['review_url']); ?>">Read full review</a>
                        <?php endif; ?>
                        <?php echo ontariogamers_top6_play_link($brand, $brand['cta']); ?>
                    </div>
                </article>
            <?php endforeach; ?>
        </div>
    </div>
</section>
