<?php
    $classes = $args['classes'] ?? '';
    $url = get_theme_mod('canvix_home_cta_url') ?: home_url('/');
    $label = get_theme_mod('canvix_home_cta_label', '');

    if ($label === '' || $url === '') {
        return;
    }
?>
<a
    href="<?php echo esc_url($url); ?>"
    class="button <?php echo esc_attr($classes); ?>"
>
    <svg aria-hidden="true" viewBox="0 0 28 28" fill="none" xmlns="http://www.w3.org/2000/svg">
        <circle cx="14" cy="14" r="14"/>
        <path d="M12 9L16.6667 13.6667L12 18.3333"
              stroke-width="1.55439"
              stroke-linecap="round"
              stroke-linejoin="round"/>
    </svg>

    <?php echo esc_html($label); ?>
</a>
