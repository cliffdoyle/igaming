<?php
/**
 * Lightweight SEO: meta description, canonical, Open Graph / Twitter cards and
 * JSON-LD structured data (schema.org). Built into the plugin so it deploys via
 * Git and stays light on the 1 GB server — no heavy SEO plugin required.
 *
 * If a dedicated SEO plugin (Yoast, Rank Math, AIOSEO, SEO Framework) is later
 * activated, this module steps aside automatically to avoid duplicate tags.
 *
 * NOTE: WordPress core already serves an XML sitemap at /wp-sitemap.xml — submit
 * that URL to Google Search Console (see the Site Guide → SEO section).
 */

if (!defined('ABSPATH')) {
    exit;
}

/**
 * Detect whether a full SEO plugin is active so we don't double up.
 */
function ontariogamers_seo_plugin_active() {
    return defined('WPSEO_VERSION')              // Yoast SEO
        || defined('RANK_MATH_VERSION')          // Rank Math
        || defined('AIOSEO_VERSION')             // All in One SEO
        || class_exists('The_SEO_Framework\\Load'); // The SEO Framework
}

/**
 * Build a clean meta description for the current view.
 */
function ontariogamers_seo_description() {
    $desc = '';

    if (is_singular()) {
        $post = get_queried_object();
        if (has_excerpt($post)) {
            $desc = get_the_excerpt($post);
        } elseif (!empty($post->post_content)) {
            $desc = $post->post_content;
        }
    } elseif (is_category() || is_tax()) {
        $desc = term_description(get_queried_object());
    }

    if (!$desc) {
        $desc = get_bloginfo('description');
    }
    if (!$desc) {
        // Final fallback so the homepage/archives never ship an empty description.
        $desc = 'Expert reviews of Ontario-licensed online casinos and slots, plus free sports betting picks, bonuses and responsible gambling guides.';
    }

    $desc = wp_strip_all_tags($desc, true);
    return wp_trim_words($desc, 32, '');
}

/**
 * Best canonical URL for the current view.
 */
function ontariogamers_seo_canonical() {
    if (is_singular()) {
        return get_permalink(get_queried_object_id());
    }
    if (is_category() || is_tax() || is_tag()) {
        $link = get_term_link(get_queried_object());
        return is_wp_error($link) ? home_url('/') : $link;
    }
    if (is_home()) {
        $pid = (int) get_option('page_for_posts');
        return $pid ? get_permalink($pid) : home_url('/');
    }
    if (is_post_type_archive()) {
        $link = get_post_type_archive_link(get_post_type());
        return $link ? $link : home_url('/');
    }
    if (is_front_page()) {
        return home_url('/');
    }
    return home_url('/');
}

/**
 * Output meta description, canonical and social cards.
 */
function ontariogamers_seo_meta_tags() {
    if (ontariogamers_seo_plugin_active() || is_404()) {
        return;
    }

    $title = wp_get_document_title();
    $desc  = ontariogamers_seo_description();
    $url   = ontariogamers_seo_canonical();
    $type  = is_singular(array('post')) ? 'article' : 'website';
    $image = '';

    if (is_singular() && has_post_thumbnail(get_queried_object_id())) {
        $image = get_the_post_thumbnail_url(get_queried_object_id(), 'large');
    }

    echo "\n<!-- OntarioGamers SEO -->\n";
    echo '<meta name="description" content="' . esc_attr($desc) . '">' . "\n";
    echo '<link rel="canonical" href="' . esc_url($url) . '">' . "\n";
    echo '<meta property="og:locale" content="en_CA">' . "\n";
    echo '<meta property="og:type" content="' . esc_attr($type) . '">' . "\n";
    echo '<meta property="og:site_name" content="' . esc_attr(get_bloginfo('name')) . '">' . "\n";
    echo '<meta property="og:title" content="' . esc_attr($title) . '">' . "\n";
    echo '<meta property="og:description" content="' . esc_attr($desc) . '">' . "\n";
    echo '<meta property="og:url" content="' . esc_url($url) . '">' . "\n";
    if ($image) {
        echo '<meta property="og:image" content="' . esc_url($image) . '">' . "\n";
    }
    echo '<meta name="twitter:card" content="' . ($image ? 'summary_large_image' : 'summary') . '">' . "\n";
    echo '<meta name="twitter:title" content="' . esc_attr($title) . '">' . "\n";
    echo '<meta name="twitter:description" content="' . esc_attr($desc) . '">' . "\n";
    if ($image) {
        echo '<meta name="twitter:image" content="' . esc_url($image) . '">' . "\n";
    }
}
add_action('wp_head', 'ontariogamers_seo_meta_tags', 1);

/**
 * Output JSON-LD structured data (schema.org).
 * - Sitewide: Organization + WebSite
 * - Posts: Article + BreadcrumbList
 * - Casino/Slot reviews: Review (with our editorial rating) + BreadcrumbList
 */
function ontariogamers_seo_schema() {
    if (ontariogamers_seo_plugin_active() || is_404()) {
        return;
    }

    $graph = array();

    // Sitewide identity
    $graph[] = array(
        '@type' => 'Organization',
        '@id'   => home_url('/#organization'),
        'name'  => get_bloginfo('name'),
        'url'   => home_url('/'),
    );
    $graph[] = array(
        '@type'      => 'WebSite',
        '@id'        => home_url('/#website'),
        'url'        => home_url('/'),
        'name'       => get_bloginfo('name'),
        'publisher'  => array('@id' => home_url('/#organization')),
        'inLanguage' => 'en-CA',
    );

    if (is_singular()) {
        $post = get_queried_object();
        $permalink = get_permalink($post);
        $image = has_post_thumbnail($post) ? get_the_post_thumbnail_url($post, 'large') : '';

        if (is_singular('post')) {
            $graph[] = array(
                '@type'            => 'Article',
                'headline'         => get_the_title($post),
                'datePublished'    => get_the_date('c', $post),
                'dateModified'     => get_the_modified_date('c', $post),
                'author'           => array('@type' => 'Person', 'name' => get_the_author_meta('display_name', $post->post_author)),
                'publisher'        => array('@id' => home_url('/#organization')),
                'mainEntityOfPage' => $permalink,
                'image'            => $image,
                'inLanguage'       => 'en-CA',
            );
        } elseif (is_singular('casino_review')) {
            $rating = get_post_meta($post->ID, 'casino_rating', true);
            $review = array(
                '@type'        => 'Review',
                'url'          => $permalink,
                'itemReviewed' => array('@type' => 'Organization', 'name' => get_the_title($post)),
                'author'       => array('@type' => 'Organization', 'name' => get_bloginfo('name')),
                'publisher'    => array('@id' => home_url('/#organization')),
                'datePublished'=> get_the_date('c', $post),
            );
            if ($rating) {
                $review['reviewRating'] = array(
                    '@type'       => 'Rating',
                    'ratingValue' => (string) $rating,
                    'bestRating'  => '10',
                    'worstRating' => '1',
                );
            }
            $graph[] = $review;
        } elseif (is_singular('slot_review')) {
            $rating   = get_post_meta($post->ID, 'slot_rtp', true);
            $provider = get_post_meta($post->ID, 'slot_provider', true);
            $item = array('@type' => 'Game', 'name' => get_the_title($post));
            if ($provider) {
                $item['author'] = array('@type' => 'Organization', 'name' => $provider);
            }
            $graph[] = array(
                '@type'        => 'Review',
                'url'          => $permalink,
                'itemReviewed' => $item,
                'author'       => array('@type' => 'Organization', 'name' => get_bloginfo('name')),
                'publisher'    => array('@id' => home_url('/#organization')),
                'datePublished'=> get_the_date('c', $post),
            );
        }

        // Breadcrumb for any single review/article
        if (in_array(get_post_type($post), array('post', 'casino_review', 'slot_review'), true)) {
            $items = array(
                array('@type' => 'ListItem', 'position' => 1, 'name' => 'Home', 'item' => home_url('/')),
            );
            if (is_singular('post')) {
                $news = (int) get_option('page_for_posts');
                if ($news) {
                    $items[] = array('@type' => 'ListItem', 'position' => 2, 'name' => 'News', 'item' => get_permalink($news));
                }
            } elseif (is_singular('casino_review')) {
                $items[] = array('@type' => 'ListItem', 'position' => 2, 'name' => 'Online Casinos', 'item' => home_url('/online-casinos/'));
            } elseif (is_singular('slot_review')) {
                $items[] = array('@type' => 'ListItem', 'position' => 2, 'name' => 'Online Slots', 'item' => home_url('/online-slots/'));
            }
            $items[] = array('@type' => 'ListItem', 'position' => count($items) + 1, 'name' => get_the_title($post), 'item' => $permalink);
            $graph[] = array('@type' => 'BreadcrumbList', 'itemListElement' => $items);
        }
    }

    $json = array('@context' => 'https://schema.org', '@graph' => $graph);
    echo "\n" . '<script type="application/ld+json">' . wp_json_encode($json, JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE) . '</script>' . "\n";
}
add_action('wp_head', 'ontariogamers_seo_schema', 5);
