<?php
/** Install the bundled demonstration on a new WordPress site: wp eval-file wp-content/themes/canvix/demo/import.php */
if (!defined('WP_CLI') || !WP_CLI) {
    if (!headers_sent()) { http_response_code(403); }
    exit('Run this file with WP-CLI.');
}
if (is_multisite() || get_stylesheet() !== 'canvix' || !function_exists('acf_import_field_group')) {
    WP_CLI::error('Utiliser un WordPress simple avec le thème Canvix et ACF activés.');
}
if (get_option('canvix_demo_import_state') === 'complete') {
    WP_CLI::success('La démonstration est déjà importée. Aucun contenu modifié.');
    return;
}
if (get_option('canvix_demo_import_state')) {
    WP_CLI::error('Un import précédent est incomplet. Repartir d’un site vierge pour réessayer.');
}
$decode = static function ($name) {
    $data = json_decode(file_get_contents(__DIR__ . '/' . $name), true);
    if (!is_array($data)) { WP_CLI::error('Export JSON invalide : ' . $name); }
    return $data;
};
$data = $decode('content.json');
$groups = $decode('acf-fields.json');
if (($data['format'] ?? '') !== 'canvix-demo-v1') { WP_CLI::error('Format de démonstration inconnu.'); }
// Preserve existing sites: only the default WordPress pages/posts may be present.
$existing = get_posts(['post_type'=>['post','page','projects','service','process','testimonial','attachment','nav_menu_item'], 'post_status'=>'any', 'numberposts'=>-1]);
$default_pages = ['sample-page','page-d-exemple','privacy-policy','politique-de-confidentialite'];
foreach ($existing as $post) {
    $default_page = $post->post_type === 'page' && in_array($post->post_name, $default_pages, true);
    $default_post = $post->post_type === 'post' && in_array($post->post_name, ['hello-world','bonjour-tout-le-monde'], true);
    if (!$default_page && !$default_post) {
        WP_CLI::error('Import réservé à un site vierge : des contenus ou médias existent déjà.');
    }
}
if (acf_get_field_groups() || wp_get_nav_menus()) { WP_CLI::error('Import réservé à un site sans groupes ACF ni menus.'); }
$uploads = wp_upload_dir();
if ($uploads['error']) { WP_CLI::error($uploads['error']); }
$media_root = realpath(__DIR__ . '/media');
$media_files = [];
foreach ($data['media'] as $media) {
    $files = [$media['file']];
    foreach ($media['metadata']['sizes'] ?? [] as $size) { $files[] = dirname($media['file']) . '/' . $size['file']; }
    if (!empty($media['metadata']['original_image'])) { $files[] = dirname($media['file']) . '/' . $media['metadata']['original_image']; }
    foreach (array_unique($files) as $relative) {
        $source = realpath(__DIR__ . '/media/' . $relative);
        if (!$media_root || !$source || !str_starts_with(wp_normalize_path($source), wp_normalize_path($media_root) . '/') || !preg_match('~^\d{4}/\d{2}/[^/\\\\]+$~', $relative)) {
            WP_CLI::error('Chemin de média absent ou invalide.');
        }
        $destination = $uploads['basedir'] . '/' . $relative;
        if (file_exists($destination)) { WP_CLI::error('Un fichier média existe déjà : ' . basename($relative)); }
        $media_files[$relative] = $source;
    }
}
$admins = get_users(['role'=>'administrator','number'=>1,'fields'=>'ID']);
if (!$admins) { WP_CLI::error('Créer un administrateur WordPress avant l’import.'); }
$author = (int)$admins[0];
$must = static function ($result) {
    if (is_wp_error($result)) { WP_CLI::error($result->get_error_message()); }
    return $result;
};
$ids = [];
$terms = [];
$url_map = [];
$translate = static function ($value) use (&$translate, &$url_map, &$ids, $data) {
    if (is_array($value)) { return array_map($translate, $value); }
    if (!is_string($value)) { return $value; }
    $value = strtr($value, $url_map);
    $value = str_replace($data['source_url'], untrailingslashit(home_url()), $value);
    return preg_replace_callback('/([?&](?:attachment_id|page_id|p)=)(\d+)/', static function ($match) use (&$ids) {
        return $match[1] . ($ids[(int)$match[2]] ?? $match[2]);
    }, $value);
};
update_option('canvix_demo_import_state', 'running', false);
foreach ($data['posts'] as $post) {
    $ids[$post['id']] = (int)$must(wp_insert_post(wp_slash([
        'post_type'=>$post['type'], 'post_status'=>'publish', 'post_author'=>$author,
        'post_name'=>$post['slug'], 'post_title'=>$post['title'], 'post_content'=>'',
        'post_excerpt'=>'', 'post_date'=>$post['date'], 'menu_order'=>$post['menu_order'],
        'comment_status'=>'closed', 'ping_status'=>'closed',
    ]), true));
}
foreach ($media_files as $relative=>$source) {
    $destination = $uploads['basedir'] . '/' . $relative;
    if (!wp_mkdir_p(dirname($destination)) || !copy($source, $destination)) { WP_CLI::error('Impossible de copier un média.'); }
}
foreach ($data['media'] as $media) {
    $path = $uploads['basedir'] . '/' . $media['file'];
    $url = $uploads['baseurl'] . '/' . $media['file'];
    $id = (int)$must(wp_insert_attachment(wp_slash([
        'post_title'=>$media['title'], 'post_name'=>$media['slug'], 'post_excerpt'=>$media['caption'],
        'post_mime_type'=>$media['mime'], 'post_status'=>'inherit', 'post_author'=>$author, 'guid'=>$url,
    ]), $path, $ids[$media['parent']] ?? 0, true));
    $ids[$media['id']] = $id;
    wp_update_attachment_metadata($id, $media['metadata']);
    update_post_meta($id, '_wp_attachment_image_alt', wp_slash($media['alt']));
    $url_map[$media['url']] = $url;
    $old_directory = trailingslashit(dirname($media['url']));
    foreach ($media['metadata']['sizes'] ?? [] as $size) {
        $url_map[$old_directory . $size['file']] = trailingslashit(dirname($url)) . $size['file'];
    }
    if (!empty($media['metadata']['original_image'])) {
        $name = $media['metadata']['original_image'];
        $url_map[$old_directory . $name] = trailingslashit(dirname($url)) . $name;
    }
}
foreach ($data['categories'] as $term) {
    $existing_term = get_term_by('slug', $term['slug'], 'category');
    $created = $existing_term ? ['term_id'=>$existing_term->term_id] : $must(wp_insert_term($term['name'], 'category', ['slug'=>$term['slug']]));
    $terms[$term['id']] = (int)$created['term_id'];
}
foreach ($data['categories'] as $term) {
    if ($term['parent']) { $must(wp_update_term($terms[$term['id']], 'category', ['parent'=>$terms[$term['parent']]])); }
}
foreach ($groups as $group) {
    foreach ($group['location'] as &$rules) {
        foreach ($rules as &$rule) {
            if (in_array($rule['param'], ['page','post'], true) && isset($ids[(int)$rule['value']])) { $rule['value'] = (string)$ids[(int)$rule['value']]; }
        }
        unset($rule);
    }
    unset($rules);
    if (!acf_import_field_group($group)) { WP_CLI::error('Impossible d’importer un groupe ACF.'); }
}
$remap_blocks = static function ($blocks) use (&$remap_blocks, &$ids) {
    foreach ($blocks as &$block) {
        if (in_array($block['blockName'], ['core/image','core/cover','core/file','core/video','core/audio'], true) && isset($block['attrs']['id'])) {
            $block['attrs']['id'] = $ids[(int)$block['attrs']['id']] ?? $block['attrs']['id'];
        }
        if ($block['blockName'] === 'core/gallery' && isset($block['attrs']['ids'])) {
            $block['attrs']['ids'] = array_map(static fn($id)=>$ids[(int)$id] ?? $id, $block['attrs']['ids']);
        }
        if ($block['blockName'] === 'core/media-text' && isset($block['attrs']['mediaId'])) {
            $block['attrs']['mediaId'] = $ids[(int)$block['attrs']['mediaId']] ?? $block['attrs']['mediaId'];
        }
        $block['innerBlocks'] = $remap_blocks($block['innerBlocks']);
    }
    return $blocks;
};
foreach ($data['posts'] as $post) {
    $content = $translate($post['content']);
    $content = preg_replace_callback('/\bwp-image-(\d+)\b/', static fn($m)=>'wp-image-' . ($ids[(int)$m[1]] ?? $m[1]), $content);
    $content = serialize_blocks($remap_blocks(parse_blocks($content)));
    $id = $ids[$post['id']];
    $must(wp_update_post(wp_slash(['ID'=>$id,'post_content'=>$content,'post_excerpt'=>$translate($post['excerpt']),'post_parent'=>$ids[$post['parent']] ?? 0]), true));
    if ($post['thumbnail']) { set_post_thumbnail($id, $ids[$post['thumbnail']]); }
    foreach ($post['acf'] as $field) {
        $value = $translate($field['value']);
        if (in_array($field['type'], ['image','file','post_object','relationship','gallery'], true)) {
            $value = is_array($value) ? array_map(static fn($old)=>$ids[(int)$old] ?? $old, $value) : ($ids[(int)$value] ?? $value);
        }
        update_field($field['key'], $value, $id);
    }
    if ($post['categories']) { $must(wp_set_post_terms($id, array_map(static fn($old)=>$terms[$old], $post['categories']), 'category')); }
}
$locations = [];
foreach ($data['menus'] as $menu) {
    $menu_id = (int)$must(wp_create_nav_menu($menu['name']));
    $item_ids = [];
    foreach ($menu['items'] as $item) {
        $item_ids[$item['id']] = (int)$must(wp_update_nav_menu_item($menu_id, 0, wp_slash([
            'menu-item-title'=>$item['title'], 'menu-item-status'=>'publish', 'menu-item-type'=>$item['type'],
            'menu-item-object'=>$item['object'], 'menu-item-object-id'=>$item['type']==='post_type' ? ($ids[$item['object_id']] ?? 0) : ($item['type']==='taxonomy' ? ($terms[$item['object_id']] ?? 0) : 0),
            'menu-item-url'=>$translate($item['url']), 'menu-item-position'=>$item['order'], 'menu-item-target'=>$item['target'], 'menu-item-classes'=>implode(' ', $item['classes']),
        ])));
    }
    foreach ($menu['items'] as $item) {
        if ($item['parent']) { update_post_meta($item_ids[$item['id']], '_menu_item_menu_item_parent', $item_ids[$item['parent']]); }
    }
    $locations[$menu['location']] = $menu_id;
}
set_theme_mod('nav_menu_locations', $locations);
foreach ($data['theme_mods'] as $key=>$value) { set_theme_mod($key, $key==='custom_logo' ? ($ids[(int)$value] ?? 0) : $translate($value)); }
foreach ($data['options'] as $key=>$value) {
    if (in_array($key, ['blogname','blogdescription','permalink_structure','posts_per_page'], true)) { update_option($key, $value); }
}
update_option('show_on_front', 'page');
update_option('page_on_front', $ids[$data['home_id']]);
flush_rewrite_rules(false);
update_option('canvix_demo_import_state', 'complete', false);
WP_CLI::success(sprintf('Démonstration importée : %d contenus, %d médias, %d groupes ACF et %d menus.', count($data['posts']), count($data['media']), count($groups), count($data['menus'])));
