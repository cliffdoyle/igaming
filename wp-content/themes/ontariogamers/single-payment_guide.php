<?php
/**
 * Single Payment Method guide — /payment-methods/<slug>/
 */

get_header();

while (have_posts()) :
    the_post();

    $og_author_id  = (int) get_the_author_meta('ID');
    $og_author_url = get_author_posts_url($og_author_id);
    $og_note       = get_post_meta(get_the_ID(), 'og_byline_note', true);
    $og_content    = apply_filters('the_content', get_the_content());

    // "On this page" links from the guide's H2s that carry an id.
    $og_toc = array();
    if (preg_match_all('#<h2[^>]*\bid="([^"]+)"[^>]*>(.*?)</h2>#is', $og_content, $m, PREG_SET_ORDER)) {
        foreach ($m as $h) {
            $label = wp_strip_all_tags($h[2]);
            $label = preg_replace('/\s+[–-]\s+Tests Completed.*$/u', '', $label);
            $og_toc[] = array('id' => $h[1], 'label' => $label);
        }
    }
    ?>

    <div class="pg-hero">
        <div class="pg-wrap">
            <nav class="pg-crumbs" aria-label="Breadcrumb">
                <a href="<?php echo esc_url(home_url('/')); ?>">Home</a>
                <span aria-hidden="true">/</span>
                <a href="<?php echo esc_url(get_post_type_archive_link('payment_guide')); ?>">Payment Methods</a>
                <span aria-hidden="true">/</span>
                <span aria-current="page"><?php the_title(); ?></span>
            </nav>

            <p class="pg-eyebrow">Payment Methods</p>
            <h1 class="pg-title"><?php the_title(); ?></h1>

            <div class="pg-byline">
                <a href="<?php echo esc_url($og_author_url); ?>" class="pg-byline__avatar"><?php echo get_avatar($og_author_id, 48, '', get_the_author()); ?></a>
                <p>
                    <span>By <a href="<?php echo esc_url($og_author_url); ?>"><?php the_author(); ?></a></span>
                    <?php if ($og_note) : ?><span class="pg-sep" aria-hidden="true">|</span><span><?php echo esc_html($og_note); ?></span><?php endif; ?>
                    <span class="pg-sep" aria-hidden="true">|</span><span>Ontario Resident</span>
                    <span class="pg-sep" aria-hidden="true">|</span><span>Updated <?php echo esc_html(get_the_modified_date('M j, Y')); ?></span>
                </p>
            </div>
        </div>
    </div>

    <div class="pg-wrap pg-body">
        <main class="pg-article">

            <p class="pg-disclosure">We earn commission – but we test with our own money. <a href="<?php echo esc_url(home_url('/#how-we-test')); ?>">See How We Test</a></p>

            <?php if (count($og_toc) > 2) : ?>
                <nav class="pg-toc" aria-label="On this page">
                    <p class="pg-toc__title">On this page</p>
                    <ol>
                        <?php foreach ($og_toc as $t) : ?>
                            <li><a href="#<?php echo esc_attr($t['id']); ?>"><?php echo esc_html($t['label']); ?></a></li>
                        <?php endforeach; ?>
                    </ol>
                </nav>
            <?php endif; ?>

            <?php if (has_post_thumbnail()) : ?>
                <div class="single-featured"><?php the_post_thumbnail('large'); ?></div>
            <?php endif; ?>

            <div class="entry-content pg-content">
                <?php echo $og_content; // already filtered by the_content ?>
            </div>

            <?php
            $og_more = get_posts(array(
                'post_type'      => 'payment_guide',
                'posts_per_page' => 3,
                'post__not_in'   => array(get_the_ID()),
                'orderby'        => array('menu_order' => 'ASC', 'date' => 'DESC'),
                'no_found_rows'  => true,
            ));
            if ($og_more) : ?>
                <aside class="pg-related" aria-labelledby="pg-related-title">
                    <h2 id="pg-related-title">More payment guides</h2>
                    <ul>
                        <?php foreach ($og_more as $g) : $gn = get_post_meta($g->ID, 'og_byline_note', true); ?>
                            <li>
                                <a href="<?php echo esc_url(get_permalink($g)); ?>">
                                    <?php if ($gn) : ?><span class="pg-related__note"><?php echo esc_html($gn); ?></span><?php endif; ?>
                                    <strong><?php echo esc_html(get_the_title($g)); ?></strong>
                                    <span class="pg-related__go" aria-hidden="true">Read guide →</span>
                                </a>
                            </li>
                        <?php endforeach; ?>
                    </ul>
                </aside>
            <?php endif; ?>

            <div class="related-cta">
                <h3>Compare the best Ontario casinos</h3>
                <p>See our full Top 6 ranking with tested payout times, ratings, pros and cons.</p>
                <div class="related-cta-buttons">
                    <a href="<?php echo esc_url(home_url('/#top-6')); ?>" class="btn btn-review">Top 6 Ontario Casinos</a>
                    <a href="<?php echo esc_url(get_post_type_archive_link('payment_guide')); ?>" class="btn btn-review">All Payment Guides</a>
                    <a href="<?php echo esc_url(home_url('/responsible-gambling/')); ?>" class="btn btn-review">Responsible Gambling</a>
                </div>
            </div>

            <div class="author-box">
                <a href="<?php echo esc_url($og_author_url); ?>"><?php echo get_avatar($og_author_id, 80); ?></a>
                <div>
                    <div class="author-name"><a href="<?php echo esc_url($og_author_url); ?>"><?php the_author(); ?></a></div>
                    <div class="author-title"><?php echo esc_html(function_exists('ontariogamers_author_role') ? ontariogamers_author_role($og_author_id) : 'Writer — OntarioGamers.ca'); ?></div>
                    <?php $og_li = get_the_author_meta('linkedin'); ?>
                    <div class="author-social">
                        <?php if ($og_li) : ?><a href="<?php echo esc_url($og_li); ?>" target="_blank" rel="noopener nofollow">LinkedIn</a><?php endif; ?>
                        <a href="<?php echo esc_url($og_author_url); ?>">View all posts</a>
                    </div>
                    <div class="author-bio"><?php the_author_meta('description'); ?></div>
                </div>
            </div>

            <?php ontariogamers_affiliate_disclosure(); ?>
            <?php ontariogamers_disclaimer(); ?>
        </main>
    </div>

<?php endwhile;

get_footer();
