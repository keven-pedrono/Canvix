<!doctype html>
<html <?php language_attributes(); ?>>
    <head>
        <meta charset="<?php bloginfo('charset'); ?>">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <?php wp_head(); ?>
    </head>

    <body <?php body_class(); ?>>

    <?php wp_body_open(); ?>

    <header class="header <?php echo is_front_page() ? 'header--home' : ''; ?>">
        <div class="header__container container">
            <a href="<?php echo esc_url(home_url('/')); ?>" class="header__logo main-logo">
                <?php
                    $logo = get_theme_mod('custom_logo');

                    if ($logo) {
                        echo wp_get_attachment_image($logo, 'full', false, ['alt' => '',]);
                    }
                ?>

                <span>
                    <?php echo esc_html(get_bloginfo('name')); ?>
                </span>
            </a>

            <nav class="menu" aria-label="Navigation principale">
                <?php
                    wp_nav_menu([
                        'theme_location' => 'primary',
                        'container'      => false,
                        'menu_class'     => 'menu__list',
                    ]);
                ?>
            </nav>

            <a href="<?php echo esc_url(get_theme_mod('canvix_header_cta_url', home_url('/'))); ?>" class="header__cta button button--header">
                <?php echo esc_html(get_theme_mod('canvix_header_cta_label', 'Get in touch')); ?>
            </a>
        </div>
    </header>
