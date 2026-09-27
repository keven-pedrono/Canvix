<?php

function portfolio_theme_setup() {
    add_theme_support('title-tag');
    add_theme_support('post-thumbnails');

    register_nav_menus([
        'primary' => 'Menu principal',
    ]);
}

add_action('after_setup_theme', 'portfolio_theme_setup');


function portfolio_theme_assets() {
    if (defined('WP_DEBUG') && WP_DEBUG) {
        $vite_server = 'http://127.0.0.1:5173';

        wp_enqueue_style(
            'portfolio-style',
            $vite_server . '/src/scss/main.scss',
            [],
            null
        );

        wp_enqueue_script(
            'portfolio-vite-client',
            $vite_server . '/@vite/client',
            [],
            null,
            false
        );

        add_filter('script_loader_tag', static function ($tag, $handle) {
            if ($handle !== 'portfolio-vite-client') {
                return $tag;
            }

            return str_replace('<script ', '<script type="module" ', $tag);
        }, 10, 2);

        return;
    }

    $style_path = get_theme_file_path('/dist/theme.css');

    if (!file_exists($style_path)) {
        return;
    }

    wp_enqueue_style(
        'portfolio-style',
        get_theme_file_uri('/dist/theme.css'),
        [],
        filemtime($style_path)
    );
}

// function portfolio_register_project_cpt() {
//     register_post_type('project', [
//         'labels' => [
//             'name'          => 'Projets',
//             'singular_name' => 'Projet',
//         ],
//         'public'       => true,
//         'has_archive'  => true,
//         'show_in_rest' => true,
//         'supports'     => [
//             'title',
//             'editor',
//             'thumbnail',
//         ],
//         'rewrite' => [
//             'slug' => 'projects',
//         ],
//     ]);
// }

// function portfolio_register_project_taxonomies() {
//     register_taxonomy('technology', ['project'], [
//         'labels' => [
//             'name'          => 'Technologies',
//             'singular_name' => 'Technologie',
//         ],
//         'public'       => true,
//         'hierarchical' => false,
//         'show_in_rest' => true,
//         'rewrite'      => [
//             'slug' => 'technology',
//         ],
//     ]);
// }

// function portfolio_modify_project_archive($query) {
//     if (
//         ! is_admin()
//         && $query->is_main_query()
//         && $query->is_post_type_archive('project')
//     ) {
//         $query->set('posts_per_page', 2);
//         $query->set('orderby', 'date');
//         $query->set('order', 'DESC');
//     }
// }

// function portfolio_add_blocks() {
//     register_block_type(get_template_directory() . '/blocks/project-meta');
// }

add_action('wp_enqueue_scripts', 'portfolio_theme_assets');
// add_action('pre_get_posts', 'portfolio_modify_project_archive');
// add_action('init', 'portfolio_register_project_taxonomies');
// add_action('init', 'portfolio_register_project_cpt');
// add_action('init', 'portfolio_add_blocks');
