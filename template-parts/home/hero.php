<?php
    $fields = function_exists('get_fields') ? get_fields() : [];
    $fields = is_array($fields) ? $fields : [];
?>

<section class="hero">
    <?php
        $hero_title_before = $fields['hero_titre_debut'];
        $hero_title_highlight = $fields['hero_titre_milieu'];
        $hero_title_after = $fields['hero_titre_fin'];
        $hero_excerpt = $fields['hero_description'];
        $hero_illustration = get_the_post_thumbnail($page_id, 'full');

        $brands_title = $fields['partenaires_titre'];
    ?>

    <div class="hero__container container">
        <div class="hero__wrap">
            <?php if ($hero_title_highlight || $hero_excerpt) : ?>
                <div class="hero__content">
                    <?php if ($hero_title_before && $hero_title_highlight && $hero_title_after) : ?>
                        <h1 class="hero__title">
                            <?php echo esc_html($hero_title_before); ?>
                            <span><?php echo esc_html($hero_title_highlight); ?></span>
                            <?php echo esc_html($hero_title_after); ?>
                        </h1>
                    <?php endif; ?>

                    <?php if ($hero_excerpt) : ?>
                        <p class="hero__text"><?php echo esc_html($hero_excerpt); ?></p>
                    <?php endif; ?>

                    <a href="<?php echo esc_url(get_theme_mod('canvix_home_cta_url', home_url('/'))); ?>" class="hero__button button button--secondary">
                        <svg aria-hidden="true" viewBox="0 0 28 28" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <circle cx="14" cy="14" r="14"/>
                            <path d="M12 9L16.6667 13.6667L12 18.3333" stroke-width="1.55439" stroke-linecap="round" stroke-linejoin="round"/>
                        </svg>

                        <?php echo esc_html(get_theme_mod('canvix_home_cta_label')); ?>
                    </a>
                </div>
            <?php endif; ?>

            <div class="hero__cta">
                <?php if ($brands_title) : ?>
                    <h2 class="hero__brands"><?php echo esc_html($brands_title); ?></h2>

                    <div class="hero__links">
                        <?php for ($brand_number = 1; $brand_number <= 4; $brand_number++) :
                            $brand_name_key = 'partenaire_' . $brand_number . '_nom';
                            $brand_image_key = 'partenaire_' . $brand_number . '_image';
                            $brand_link_key = 'partenaire_' . $brand_number . '_lien';
                            $brand_show_key = 'partenaire_' . $brand_number . '_afficher';

                            $brand_show = array_key_exists($brand_show_key, $fields)
                                ? (bool) $fields[$brand_show_key]
                                : true;

                            $brand_name = $fields[$brand_name_key];
                            $brand_image = wp_get_attachment_image($fields[$brand_image_key], 'full', false, ['alt' => $brand_name]);
                            $brand_link = is_array($fields[$brand_link_key]) ? $fields[$brand_link_key] : [];
                            $brand_url = $brand_link['url'] ?? '';
                            $brand_target = $brand_link['target'] ?? '';

                            if (!$brand_show || !$brand_image) {
                                continue;
                            }

                            if ($brand_url) : ?>
                                <a
                                    href="<?php echo esc_url($brand_url); ?>"
                                    class="hero__link"
                                    <?php if ($brand_target) : ?>
                                        target="<?php echo esc_attr($brand_target); ?>"
                                        <?php if ($brand_target === '_blank') : ?>
                                            rel="noopener noreferrer"
                                        <?php endif; ?>
                                    <?php endif; ?>
                                >
                                    <?php echo $brand_image; ?>
                                </a>

                            <?php else : ?>
                                <?php echo $brand_image; ?>
                            <?php endif; ?>
                        <?php endfor; ?>
                    </div>
                <?php endif; ?>
            </div>
        </div>

        <?php if ($hero_illustration) : ?>
            <div class="hero__illustration">
                <div>
                    <div>
                        <?php echo $hero_illustration; ?>
                    </div>
                </div>
            </div>
        <?php endif; ?>
    </div>
</section>
