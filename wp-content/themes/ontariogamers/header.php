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
