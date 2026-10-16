<?php
/**
 * Payment Methods hub — /payment-methods/
 */

get_header();
?>

<div class="pg-hero pg-hero--hub">
    <div class="pg-wrap">
        <nav class="pg-crumbs" aria-label="Breadcrumb">
            <a href="<?php echo esc_url(home_url('/')); ?>">Home</a>
            <span aria-hidden="true">/</span>
            <span aria-current="page">Payment Methods</span>
        </nav>
        <p class="pg-eyebrow">Deposit &amp; withdrawal guides</p>
        <h1 class="pg-title">Ontario Casino Payment Methods</h1>
        <p class="pg-lead">
            Step-by-step guides to depositing and withdrawing at AGCO-licensed Ontario casinos. We test each method
            with our own money and record minimum deposits, fees and real transaction times.
        </p>
    </div>
</div>

<div class="pg-wrap pg-body">
    <main class="pg-hub">
        <?php if (have_posts()) : ?>
            <div class="pg-cards">
                <?php while (have_posts()) : the_post();
                    $note = get_post_meta(get_the_ID(), 'og_byline_note', true);
                    ?>
                    <article class="pg-card">
                        <?php if (has_post_thumbnail()) : ?>
                            <a href="<?php the_permalink(); ?>" class="pg-card__media" tabindex="-1" aria-hidden="true"><?php the_post_thumbnail('card-thumbnail'); ?></a>
                        <?php endif; ?>
                        <div class="pg-card__body">
                            <?php if ($note) : ?><p class="pg-card__note"><?php echo esc_html($note); ?></p><?php endif; ?>
                            <h2 class="pg-card__title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
                            <p class="pg-card__excerpt"><?php echo esc_html(wp_trim_words(get_the_excerpt(), 30)); ?></p>
                            <p class="pg-card__meta">By <?php the_author(); ?> · Updated <?php echo esc_html(get_the_modified_date('M j, Y')); ?></p>
                            <a href="<?php the_permalink(); ?>" class="og-play-btn og-play-btn--sm pg-card__cta">Read the guide</a>
                        </div>
                    </article>
                <?php endwhile; ?>
            </div>

            <div class="pg-pagination">
                <?php the_posts_pagination(array('mid_size' => 2, 'prev_text' => '← Prev', 'next_text' => 'Next →')); ?>
            </div>
        <?php else : ?>
            <p>Payment guides are coming soon.</p>
        <?php endif; ?>

        <?php ontariogamers_disclaimer(); ?>
    </main>
</div>

<?php get_footer(); ?>
