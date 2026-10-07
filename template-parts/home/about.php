<?php
    $about_page = get_page_by_path('about');
?>

<?php if ($about_page) : ?>
    <section class="about">
        <?php
            $about_fields = ($about_page && function_exists('get_fields')) ? get_fields($about_page->ID) : [];
            $about_title = get_the_title($about_page);
            $about_subtitle = $about_fields['sous_titre'];
            $about_excerpt = $about_fields['extrait'];

            $about_metric_1_label = $about_fields['libelle_nombre_1'];
            $about_metric_1_value = $about_fields['nombre_1'];

            $about_metric_2_label = $about_fields['libelle_nombre_2'];
            $about_metric_2_value = $about_fields['nombre_2'];

            $about_illustration_1 = get_the_post_thumbnail($about_page, 'large');
            $about_illustration_2 = wp_get_attachment_image($about_fields['illustration_secondaire'], 'large');
            $about_illustration_3 = wp_get_attachment_image($about_fields['illustration_tertiaire'], 'large');
        ?>

        <div class="about__container container">
            <?php if ($about_illustration_1 && $about_illustration_2 && $about_illustration_3) : ?>
                <div class="about__illustrations">
                    <div class="about__illustration">
                        <?php echo $about_illustration_3; ?>
                    </div>

                    <div class="about__illustration">
                        <?php echo $about_illustration_2; ?>
                    </div>

                    <div class="about__illustration">
                        <?php echo $about_illustration_1; ?>
                    </div>
                </div>
            <?php endif; ?>

            <div class="about__content">
                <?php if ($about_title || $about_subtitle) : ?>
                    <div class="section-header section-header--light section-header--small">
                        <?php if ($about_title) : ?>
                            <h2 class="section-header__title"><?php echo esc_html($about_title); ?></h2>
                        <?php endif; ?>

                        <?php if ($about_subtitle) : ?>
                            <h3 class="section-header__subtitle"><?php echo esc_html($about_subtitle); ?></h3>
                        <?php endif; ?>
                    </div>
                <?php endif; ?>

                <?php if ($about_excerpt) : ?>
                    <p class="about__text"><?php echo esc_html($about_excerpt); ?></p>
                <?php endif; ?>

                <?php if (($about_metric_1_label && $about_metric_1_value) || ($about_metric_2_label && $about_metric_2_value)) : ?>
                    <div class="about__numbers">
                        <?php if ($about_metric_1_label || $about_metric_1_value) : ?>
                            <div class="about__number">
                                <?php if ($about_metric_1_value) : ?>
                                    <span><?php echo esc_html($about_metric_1_value); ?> +</span>
                                <?php endif; ?>

                                <?php if ($about_metric_1_label) : ?>
                                    <p><?php echo esc_html($about_metric_1_label); ?></p>
                                <?php endif; ?>
                            </div>
                        <?php endif; ?>

                        <?php if ($about_metric_2_label || $about_metric_2_value) : ?>
                            <div class="about__number">
                                <?php if ($about_metric_2_value) : ?>
                                    <span><?php echo esc_html($about_metric_2_value); ?> +</span>
                                <?php endif; ?>

                                <?php if ($about_metric_2_label) : ?>
                                    <p><?php echo esc_html($about_metric_2_label); ?></p>
                                <?php endif; ?>
                            </div>
                        <?php endif; ?>
                    </div>
                <?php endif; ?>

                <a href="<?php echo esc_url(get_theme_mod('canvix_home_cta_url', home_url('/'))); ?>" class="about__button button button--secondary">
                    <svg aria-hidden="true" viewBox="0 0 28 28" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <circle cx="14" cy="14" r="14"/>
                        <path d="M12 9L16.6667 13.6667L12 18.3333" stroke-width="1.55439" stroke-linecap="round" stroke-linejoin="round"/>
                    </svg>

                    <?php echo esc_html(get_theme_mod('canvix_home_cta_label')); ?>
                </a>
            </div>
        </div>
    </section>
<?php endif; ?>
