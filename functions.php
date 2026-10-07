<?php

// Conserver les groupes de champs ACF en base uniquement pour le moment.
add_filter('acf/settings/json', '__return_false');

function canvix_theme_setup() {
    add_theme_support('title-tag');
    add_theme_support('post-thumbnails');

    register_nav_menus([
        'primary' => 'Menu principal',
    ]);
}

add_action('after_setup_theme', 'canvix_theme_setup');


function canvix_register_service_post_type() {
    register_post_type('service', [
        'labels' => [
            'name'               => 'Services',
            'singular_name'      => 'Service',
            'add_new_item'       => 'Ajouter un service',
            'edit_item'          => 'Modifier le service',
            'new_item'           => 'Nouveau service',
            'view_item'          => 'Voir le service',
            'search_items'       => 'Rechercher des services',
            'not_found'          => 'Aucun service trouvé',
            'not_found_in_trash' => 'Aucun service dans la corbeille',
            'all_items'          => 'Tous les services',
            'menu_name'          => 'Services',
        ],
        'public'             => false,
        'show_ui'            => true,
        'show_in_menu'       => true,
        'show_in_rest'       => true,
        'publicly_queryable' => false,
        'has_archive'        => false,
        'rewrite'            => false,
        'supports'           => [
            'title',
            'excerpt',
            'page-attributes',
        ],
    ]);
}

add_action('init', 'canvix_register_service_post_type');


function canvix_register_process_post_type() {
    register_post_type('process', [
        'labels' => [
            'name'               => 'Process',
            'singular_name'      => 'Étape du process',
            'add_new_item'       => 'Ajouter une étape',
            'edit_item'          => 'Modifier l’étape',
            'new_item'           => 'Nouvelle étape',
            'view_item'          => 'Voir l’étape',
            'search_items'       => 'Rechercher des étapes',
            'not_found'          => 'Aucune étape trouvée',
            'not_found_in_trash' => 'Aucune étape dans la corbeille',
            'all_items'          => 'Toutes les étapes',
            'menu_name'          => 'Process',
        ],
        'public'             => false,
        'show_ui'            => true,
        'show_in_menu'       => true,
        'show_in_rest'       => true,
        'publicly_queryable' => false,
        'has_archive'        => false,
        'rewrite'            => false,
        'supports'           => [
            'title',
            'excerpt',
            'thumbnail',
            'page-attributes',
        ],
    ]);
}

add_action('init', 'canvix_register_process_post_type');


function canvix_register_projects_post_type() {
    register_post_type('recent_projects', [
        'labels' => [
            'name'               => 'Projets',
            'singular_name'      => 'Projet',
            'add_new_item'       => 'Ajouter un projet',
            'edit_item'          => 'Modifier le projet',
            'new_item'           => 'Nouveau projet',
            'view_item'          => 'Voir le projet',
            'search_items'       => 'Rechercher des projets',
            'not_found'          => 'Aucun projet trouvé',
            'not_found_in_trash' => 'Aucun projet dans la corbeille',
            'all_items'          => 'Tous les projets',
            'menu_name'          => 'Projets',
        ],
        'public'             => true,
        'show_ui'            => true,
        'show_in_menu'       => true,
        'show_in_rest'       => true,
        'publicly_queryable' => true,
        'has_archive'        => false,
        'rewrite'            => [
            'slug'       => 'projects',
            'with_front' => false,
        ],
        'menu_icon'          => 'dashicons-portfolio',
        'supports'           => [
            'title',
            'editor',
            'excerpt',
            'thumbnail',
        ],
    ]);
}

add_action('init', 'canvix_register_projects_post_type');


function canvix_register_testimonial_post_type() {
    register_post_type('testimonial', [
        'labels' => [
            'name'               => 'Témoignages',
            'singular_name'      => 'Témoignage',
            'add_new_item'       => 'Ajouter un témoignage',
            'edit_item'          => 'Modifier le témoignage',
            'new_item'           => 'Nouveau témoignage',
            'view_item'          => 'Voir le témoignage',
            'search_items'       => 'Rechercher des témoignages',
            'not_found'          => 'Aucun témoignage trouvé',
            'not_found_in_trash' => 'Aucun témoignage dans la corbeille',
            'all_items'          => 'Tous les témoignages',
            'menu_name'          => 'Témoignages',
        ],
        'public'             => false,
        'show_ui'            => true,
        'show_in_menu'       => true,
        'show_in_rest'       => true,
        'publicly_queryable' => false,
        'has_archive'        => false,
        'rewrite'            => false,
        'menu_icon'          => 'dashicons-format-quote',
        'supports'           => [
            'title',
            'editor',
            'thumbnail',
        ],
    ]);
}

add_action('init', 'canvix_register_testimonial_post_type');


function canvix_customize_register($wp_customize) {
    $wp_customize->add_section('canvix_header_cta', [
        'title'    => 'Bouton du header',
        'priority' => 30,
    ]);

    $wp_customize->add_setting('canvix_header_cta_label', [
        'default'           => 'Get in touch',
        'sanitize_callback' => 'sanitize_text_field',
    ]);

    $wp_customize->add_control('canvix_header_cta_label', [
        'label'   => 'Texte du bouton',
        'section' => 'canvix_header_cta',
        'type'    => 'text',
    ]);

    $wp_customize->add_setting('canvix_header_cta_url', [
        'default'           => home_url('/'),
        'sanitize_callback' => 'esc_url_raw',
    ]);

    $wp_customize->add_control('canvix_header_cta_url', [
        'label'   => 'URL du bouton',
        'section' => 'canvix_header_cta',
        'type'    => 'url',
    ]);
}

add_action('customize_register', 'canvix_customize_register');


function canvix_theme_assets() {
    if (defined('WP_DEBUG') && WP_DEBUG) {
        $vite_server = 'http://127.0.0.1:5173';

        wp_enqueue_style(
            'canvix-style',
            $vite_server . '/src/scss/main.scss',
            [],
            null
        );

        wp_enqueue_script(
            'canvix-vite-client',
            $vite_server . '/@vite/client',
            [],
            null,
            false
        );

        add_filter('script_loader_tag', static function ($tag, $handle) {
            if ($handle !== 'canvix-vite-client') {
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
        'canvix-style',
        get_theme_file_uri('/dist/theme.css'),
        [],
        filemtime($style_path)
    );
}

// function canvix_register_project_cpt() {
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

// function canvix_register_project_taxonomies() {
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

// function canvix_modify_project_archive($query) {
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

// function canvix_add_blocks() {
//     register_block_type(get_template_directory() . '/blocks/project-meta');
// }

add_action('wp_enqueue_scripts', 'canvix_theme_assets');
// add_action('pre_get_posts', 'canvix_modify_project_archive');
// add_action('init', 'canvix_register_project_taxonomies');
// add_action('init', 'canvix_register_project_cpt');
// add_action('init', 'canvix_add_blocks');
