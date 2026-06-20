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
                <svg class="logo-icon" viewBox="0 0 64 40" aria-hidden="true" focusable="false">
                    <path d="M16 4h32c7.7 0 14 6.3 14 14 0 2-.4 4-1.2 5.8l-4 9.2c-2 4.6-8 6.1-11.9 3l-5.1-4.1c-1.4-1.1-3.1-1.7-4.9-1.7h-5.8c-1.8 0-3.5.6-4.9 1.7l-5.1 4.1c-3.9 3.1-9.9 1.6-11.9-3l-4-9.2C2.4 22 2 20 2 18 2 10.3 8.3 4 16 4z" fill="currentColor"/>
                    <path d="M15 11h5v4h4v5h-4v4h-5v-4h-4v-5h4z" fill="#1a472a"/>
                    <circle cx="46" cy="14" r="3.2" fill="#1a472a"/>
                    <circle cx="52" cy="20" r="3.2" fill="#1a472a"/>
                </svg>
                <span class="logo-text">Ontario<span class="logo-accent">Gamers</span></span>
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
