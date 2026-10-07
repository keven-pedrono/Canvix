<?php
get_header();
?>

<main class="main">
    <?php
        $page_id = get_queried_object_id();
        $fields = function_exists('get_fields') ? get_fields($page_id) : [];
        $fields = is_array($fields) ? $fields : [];

        $services = get_posts([
            'post_type'        => 'service',
            'post_status'      => 'publish',
            'numberposts'      => -1,
            'orderby'          => 'menu_order',
            'order'            => 'ASC',
            'suppress_filters' => true,
        ]);

        $process = get_posts([
            'post_type'        => 'process',
            'post_status'      => 'publish',
            'numberposts'      => -1,
            'orderby'          => 'menu_order',
            'order'            => 'ASC',
            'suppress_filters' => true,
        ]);

        $projects = get_posts([
            'post_type'   => 'recent_projects',
            'post_status' => 'publish',
            'numberposts' => 4,
            'orderby'     => [
                'date' => 'DESC',
                'ID' => 'DESC'
            ],
        ]);

        $testimonials = get_posts([
            'post_type'        => 'testimonial',
            'post_status'      => 'publish',
            'numberposts'      => 1,
            'orderby'          => [
                'date' => 'DESC',
                'ID'   => 'DESC',
            ],
        ]);
    ?>

    <section class="hero">
        <?php
            $hero_title_before = $fields['hero_titre_debut'];
            $hero_title_highlight = $fields['hero_titre_milieu'];
            $hero_title_after = $fields['hero_titre_fin'];
            $hero_excerpt = $fields['hero_description'];
            $hero_illustration = get_the_post_thumbnail(get_the_ID(), 'full');

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

                                $brand_image = wp_get_attachment_image($fields[$brand_image_key], 'full', false, ['alt' => $brand_name]);
                                $brand_name = $fields[$brand_name_key];
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

    <?php if ($services) : ?>
    <section class="services">
        <div class="services__container container">
            <div class="section-header section-header--big section-header--center">
                <h2 class="section-header__title">Our Services</h2>
                <h3 class="section-header__subtitle">High-impact services for your business</h3>
            </div>

            <div class="services__content">
                <?php
                    foreach ($services as $service_index => $service) :
                        $service_title = get_the_title($service);
                        $service_content = get_the_excerpt($service);
                        $service_image = get_the_post_thumbnail($service, 'medium');
                        $service_variant = $service_index % 2 === 0 ? ' service--dark' : '';
                ?>
                    <article class="service<?php echo esc_attr($service_variant); ?>">
                        <?php if ($service_image) : ?>
                            <div class="service__icon">
                                <?php echo $service_image;?>
                            </div>
                        <?php endif; ?>

                        <?php if ($service_title || $service_content) : ?>
                            <div class="service__content">
                                <?php if ($service_title) : ?>
                                    <h4 class="service__title"><?php echo esc_html(wp_html_excerpt($service_title, 20, '…')); ?></h4>
                                <?php endif; ?>

                                <?php if ($service_title) : ?>
                                    <p class="service__text"><?php echo esc_html(wp_html_excerpt($service_content, 170, '…')); ?></p>
                                <?php endif; ?>
                            </div>
                        <?php endif; ?>
                    </article>
                <?php endforeach; ?>
            </div>
        </div>
    </section>
    <?php endif; ?>

    <?php
        $about_page = get_page_by_path('about');

        if ($about_page) :
    ?>
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

    <?php if ($process) : ?>
    <section class="process">
        <div class="process__container container">
            <div class="section-header section-header--center section-header--medium">
                <h2 class="section-header__title">Process</h2>
                <h3 class="section-header__subtitle">Process that moves things forward</h3>
            </div>

            <ol class="process__steps">
                <?php foreach ($process as $process_index => $process_step) : ?>
                    <?php
                        $process_title = get_the_title($process_step);
                        $process_content = get_the_excerpt($process_step);
                        $process_image = get_the_post_thumbnail($process_step, 'medium');
                    ?>

                    <li class="process__step">
                        <article class="step">
                            <?php if ($process_image || $process_title) : ?>
                                <div class="step__header">
                                    <?php if ($process_image) : ?>
                                        <span class="step__icon">
                                            <?php echo $process_image ?>
                                        </span>
                                    <?php endif; ?>

                                    <?php if ($process_title) : ?>
                                        <h4 class="step__title"><?php echo esc_html($process_title); ?></h4>
                                    <?php endif; ?>
                                </div>
                            <?php endif; ?>

                            <?php if ($process_content) : ?>
                                <p class="step__text"><?php echo esc_html($process_content); ?></p>
                            <?php endif; ?>

                            <?php if ($process_index < count($process) - 1) : ?>
                                <span class="step__arrow" aria-hidden="true"></span>
                            <?php endif; ?>
                        </article>
                    </li>
                <?php endforeach; ?>
            </ol>
        </div>
    </section>
    <?php endif; ?>

    <?php if ($projects) : ?>
    <section class="projects">
        <div class="projects__container container">
            <h2 class="projects__title title">Recent Showcase</h2>

            <div class="projects__content">
                <a href="<?php echo esc_url(get_theme_mod('canvix_home_cta_url', home_url('/'))); ?>" class="projects__button button">
                    <svg aria-hidden="true" viewBox="0 0 28 28" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <circle cx="14" cy="14" r="14"/>
                        <path d="M12 9L16.6667 13.6667L12 18.3333" stroke-width="1.55439" stroke-linecap="round" stroke-linejoin="round"/>
                    </svg>

                    <?php echo esc_html(get_theme_mod('canvix_home_cta_label')); ?>
                </a>

                <ul class="projects__list">
                    <?php foreach ($projects as $project) : ?>
                        <?php
                            $project_title = get_the_title($project);
                            $project_content = get_the_excerpt($project);
                            $project_url = get_permalink($project);
                            $project_image = get_the_post_thumbnail($project, 'large');
                        ?>

                        <li class="projects__item">
                            <a href="<?php echo esc_url($project_url); ?>" class="project">
                                <?php if ($project_image) : ?>
                                    <div class="project__illustration">
                                        <?php echo $project_image; ?>
                                    </div>
                                <?php endif; ?>

                                <?php if ($project_title || $project_content) : ?>
                                    <div class="project__content">
                                        <?php if ($project_title) : ?>
                                            <h3 class="project__title"><?php echo esc_html($project_title); ?></h3>
                                        <?php endif; ?>

                                        <?php if ($project_content) : ?>
                                            <p class="project__text"><?php echo esc_html($project_content); ?></p>
                                        <?php endif; ?>
                                    </div>
                                <?php endif; ?>
                            </a>
                        </li>
                    <?php endforeach; ?>
                </ul>
            </div>
        </div>
    </section>
    <?php endif; ?>

    <?php if ($testimonials) : ?>
    <section class="testimonies">
        <div class="testimonies__container container">
            <ul id="testimonials-slider" class="testimonies__list"
                aria-roledescription="carousel"
                aria-label="Testimonials"
                tabindex="0">
                <?php foreach ($testimonials as $testimonial) : ?>
                    <?php
                        $testimonial_name = get_the_title($testimonial);
                        $testimonial_position = function_exists('get_field') ? get_field('testimonial_position', $testimonial->ID) : '';
                        $testimonial_content = get_the_excerpt($testimonial);
                        $testimonial_image = get_the_post_thumbnail($testimonial, 'medium', ['class' => 'testimony__photo', 'alt'   => '',]);
                    ?>
                    <li class="testimonies__item">
                        <article class="testimony">
                            <?php if ($testimonial_image) : ?>
                                <?php echo $testimonial_image;?>
                            <?php endif; ?>

                            <?php if ($testimonial_content) : ?>
                                <blockquote class="testimony__quote">
                                    “<?php echo esc_html($testimonial_content); ?>”
                                </blockquote>
                            <?php endif; ?>

                            <?php if ($testimonial_name || $testimonial_position) : ?>
                                <div class="testimony__infos">
                                    <?php if ($testimonial_name) : ?>
                                        <p class="testimony__name"><?php echo esc_html($testimonial_name); ?></p>
                                    <?php endif; ?>

                                    <?php if ($testimonial_position) : ?>
                                        <p class="testimony__position"><?php echo esc_html($testimonial_position); ?></p>
                                    <?php endif; ?>
                                </div>
                            <?php endif; ?>
                        </article>
                    </li>
                <?php endforeach; ?>
            </ul>

            <?php if (count($testimonials) > 1) : ?>
                <div class="testimonies__pagination">
                    <button type="button"
                    aria-label="Previous testimonial"
                    aria-controls="testimonials-slider"
                    data-slider-control="previous"
                    disabled>
                        <svg aria-hidden="true" viewBox="0 0 10 17" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M0.833008 0.833496L8.23856 8.23905L0.833008 15.6446" stroke-opacity="0.9" stroke-width="1.66667" stroke-linecap="round" stroke-linejoin="round"/>
                        </svg>
                    </button>

                    <button type="button"
                    aria-label="Next testimonial"
                    aria-controls="testimonials-slider"
                    data-slider-control="next">
                        <svg aria-hidden="true" viewBox="0 0 10 17" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M0.833008 0.833496L8.23856 8.23905L0.833008 15.6446" stroke-opacity="0.9" stroke-width="1.66667" stroke-linecap="round" stroke-linejoin="round"/>
                        </svg>
                    </button>
                </div>
            <?php endif; ?>
        </div>
    </section>
    <?php endif; ?>
</main>

<?php get_footer(); ?>
