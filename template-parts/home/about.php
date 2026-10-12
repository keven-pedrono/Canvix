<?php
    $about_page = get_page_by_path('about');
?>

<?php if ($about_page && $about_page->post_status === 'publish') : ?>
    <section class="about">
        <?php
            $about_fields = ($about_page && function_exists('get_fields')) ? get_fields($about_page->ID) : [];
            $about_fields = is_array($about_fields) ? $about_fields : [];

            $about_title = get_the_title($about_page) ?? '';
            $about_subtitle = $about_fields['sous_titre'] ?? '';
            $about_excerpt = $about_fields['extrait'] ?? '';

            $about_metric_1_label = $about_fields['libelle_nombre_1'] ?? '';
            $about_metric_1_value = $about_fields['nombre_1'] ?? '';

            $about_metric_2_label = $about_fields['libelle_nombre_2'] ?? '';
            $about_metric_2_value = $about_fields['nombre_2'] ?? '';

            $about_illustration_1 = get_the_post_thumbnail($about_page, 'large');
            $about_illustration_2 = wp_get_attachment_image($about_fields['illustration_secondaire'] ?? 0, 'large');
            $about_illustration_3 = wp_get_attachment_image($about_fields['illustration_tertiaire'] ?? 0, 'large');
        ?>

        <div class="about__container container">
            <?php if ($about_illustration_1 || $about_illustration_2 || $about_illustration_3) : ?>
                <div class="about__illustrations">
                    <?php if ($about_illustration_3) : ?>
                        <div class="about__illustration">
                            <?php echo $about_illustration_3; ?>
                        </div>
                    <?php endif; ?>

                    <?php if ($about_illustration_2) : ?>
                        <div class="about__illustration">
                            <?php echo $about_illustration_2; ?>
                        </div>
                    <?php endif; ?>

                    <?php if ($about_illustration_1) : ?>
                        <div class="about__illustration">
                            <?php echo $about_illustration_1; ?>
                        </div>
                    <?php endif; ?>
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
                        <?php if ($about_metric_1_label && $about_metric_1_value) : ?>
                            <div class="about__number">
                                <span><?php echo esc_html($about_metric_1_value); ?> +</span>

                                <p><?php echo esc_html($about_metric_1_label); ?></p>
                            </div>
                        <?php endif; ?>

                        <?php if ($about_metric_2_label && $about_metric_2_value) : ?>
                            <div class="about__number">
                                <span><?php echo esc_html($about_metric_2_value); ?> +</span>

                                <p><?php echo esc_html($about_metric_2_label); ?></p>
                            </div>
                        <?php endif; ?>
                    </div>
                <?php endif; ?>

                <?php get_template_part('template-parts/components/home-cta', null, [
                    'classes' => 'about__button button--secondary',
                ]); ?>
            </div>
        </div>
    </section>
<?php endif; ?>
