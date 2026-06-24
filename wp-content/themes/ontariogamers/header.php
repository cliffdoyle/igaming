<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
    <meta charset="<?php bloginfo('charset'); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>
<?php wp_body_open(); ?>

<header class="site-header">
    <div class="header-inner">
        <a href="<?php echo esc_url(home_url('/')); ?>" class="site-logo">
            <?php if (has_custom_logo()) : ?>
                <?php the_custom_logo(); ?>
            <?php else : ?>
                <span class="logo-emblem" aria-hidden="true">
                    <svg viewBox="0 0 100 100" width="44" height="44" focusable="false" role="img">
                        <circle cx="50" cy="50" r="48" fill="#f5a623"/>
                        <circle cx="50" cy="50" r="41" fill="none" stroke="#ffffff" stroke-width="6" stroke-dasharray="16 16.2"/>
                        <circle cx="50" cy="50" r="34" fill="#1a472a"/>
                        <circle cx="50" cy="50" r="34" fill="none" stroke="#f5a623" stroke-width="2.5"/>
                        <path d="M50,30 C50,42 70,48 70,60 C70,69 60,70 54,65 C55,70 57,73 61,76 L39,76 C43,73 45,70 46,65 C40,70 30,69 30,60 C30,48 50,42 50,30 Z" fill="#f5a623"/>
                    </svg>
                </span>
                <span class="logo-text">Ontario<span class="logo-accent">Gamers</span><span class="logo-tld">.ca</span></span>
            <?php endif; ?>
        </a>

        <button class="menu-toggle" aria-label="Open menu" aria-expanded="false" aria-controls="primary-menu">☰</button>

        <nav class="main-nav" id="primary-menu" aria-label="Primary navigation">
            <?php
            wp_nav_menu(array(
                'theme_location' => 'primary',
                'container'      => false,
                'fallback_cb'    => 'ontariogamers_default_menu',
                'depth'          => 2,
            ));
            ?>
        </nav>
    </div>
</header>
