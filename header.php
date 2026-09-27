<!doctype html>
<html <?php language_attributes(); ?>>
    <head>
        <meta charset="<?php bloginfo('charset'); ?>">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <?php wp_head(); ?>
    </head>

    <body <?php body_class(); ?>>

    <?php wp_body_open(); ?>

    <header class="site-header">
        <div class="site-header__inner">
            <a class="site-logo" href="<?php echo esc_url(home_url('/')); ?>">
                <?php bloginfo('name'); ?>
            </a>

            <nav class="site-nav">
                <?php
                wp_nav_menu([
                    'theme_location' => 'primary',
                    'container'      => false,
                    'menu_class'     => 'menu',
                ]);
                ?>
            </nav>
        </div>
    </header>
