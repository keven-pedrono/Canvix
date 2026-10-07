<?php
get_header();
?>

<main class="main">
    <?php
        $fields = function_exists('get_fields') ? get_fields() : [];
        $fields = is_array($fields) ? $fields : [];

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
            $hero_title_before = $fields['hero_title_before'];
            $hero_title_highlight = $fields['hero_title_highlight'];
            $hero_title_after = $fields['hero_title_after'];
            $hero_description = $fields['hero_description'];
            $hero_button = $fields['hero_button'];
            $hero_button = is_array($hero_button) ? $hero_button : [];
            $hero_brands_title = $fields['hero_brands_title'];
            $hero_illustration_id = absint($fields['hero_illustration']);
        ?>

        <div class="hero__container container">
            <div class="hero__wrap">
                <div class="hero__content">
                    <h1 class="hero__title">
                        <?php echo esc_html($hero_title_before); ?>
                        <span><?php echo esc_html($hero_title_highlight); ?></span>
                        <?php echo esc_html($hero_title_after); ?>
                    </h1>

                    <p class="hero__text"><?php echo esc_html($hero_description); ?></p>

                    <a
                        href="<?php echo esc_url($hero_button['url'] ?? home_url('/')); ?>"
                        class="hero__button button button--secondary"
                        <?php if (!empty($hero_button['target'])) : ?>
                            target="<?php echo esc_attr($hero_button['target']); ?>"
                        <?php endif; ?>>
                        <svg aria-hidden="true" viewBox="0 0 28 28" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <circle cx="14" cy="14" r="14"/>
                            <path d="M12 9L16.6667 13.6667L12 18.3333" stroke-width="1.55439" stroke-linecap="round" stroke-linejoin="round"/>
                        </svg>

                        <?php echo esc_html($hero_button['title'] ?? 'Start your Free Trial'); ?>
                    </a>
                </div>

                <div class="hero__cta">
                    <h2 class="hero__brands"><?php echo esc_html($hero_brands_title); ?></h2>

                    <div class="hero__links">
                    <?php
                    for ($brand_number = 1; $brand_number <= 4; $brand_number++) :
                        $brand_show_key = 'hero_brand_' . $brand_number . '_show';
                        $brand_image_key = 'hero_brand_' . $brand_number . '_image';
                        $brand_name_key = 'hero_brand_' . $brand_number . '_name';
                        $brand_link_key = 'hero_brand_' . $brand_number . '_link';

                        $brand_show = array_key_exists($brand_show_key, $fields)
                            ? (bool) $fields[$brand_show_key]
                            : true;

                        $brand_image_id = absint($fields[$brand_image_key] ?? 0);
                        $brand_name = $fields[$brand_name_key] ?? '';
                        $brand_link = $fields[$brand_link_key] ?? [];
                        $brand_link = is_array($brand_link) ? $brand_link : [];
                        $brand_url = $brand_link['url'] ?? '';
                        $brand_target = $brand_link['target'] ?? '';

                        if (!$brand_show || !$brand_image_id) {
                            continue;
                        }
                        ?>
                            <?php if ($brand_url) : ?>
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
                                <?php echo wp_get_attachment_image($brand_image_id, 'full', false, ['alt' => $brand_name]); ?>
                            </a>

                            <?php else : ?>
                                <?php echo wp_get_attachment_image($brand_image_id, 'full', false, ['alt' => $brand_name]); ?>
                            <?php endif; ?>
                    <?php endfor; ?>
                    </div>
                </div>
            </div>

            <div class="hero__illustration">
                <div>
                    <div>
                        <?php if ($hero_illustration_id) : ?>
                            <?php echo wp_get_attachment_image($hero_illustration_id, 'full', false, ['alt' => '']); ?>
                        <?php else : ?>
                            <img src="<?php echo esc_url(get_theme_file_uri('/src/assets/images/hero-illustration.png')); ?>" alt="">
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="services">
        <div class="services__container container">
            <div class="section-header section-header--big section-header--center">
                <h2 class="section-header__title">Our Services</h2>
                <h3 class="section-header__subtitle">High-impact services for your business</h3>
            </div>

            <div class="services__content">
                <?php
                $services = get_posts([
                    'post_type'        => 'service',
                    'post_status'      => 'publish',
                    'numberposts'      => -1,
                    'orderby'          => 'menu_order',
                    'order'            => 'ASC',
                    'suppress_filters' => true,
                ]);

                foreach ($services as $service_index => $service) :
                    $service_image_id = get_field('service_image', $service->ID);
                    $service_variant = $service_index % 2 === 0 ? ' service--dark' : '';
                ?>
                    <article class="service<?php echo esc_attr($service_variant); ?>">
                        <div class="service__icon">
                        <?php if ($service_image_id) :
                            echo wp_get_attachment_image(
                                $service_image_id,
                                'full',
                                false,
                                [
                                    'class'       => 'service__icon-image',
                                    'alt'         => '',
                                    'aria-hidden' => 'true',
                                ]
                            );
                            ?>
                        <?php endif; ?>
                        </div>

                        <div class="service__content">
                            <h4 class="service__title"><?php echo esc_html(wp_html_excerpt(get_the_title($service), 20, '…')); ?></h4>
                            <p class="service__text"><?php echo esc_html(wp_html_excerpt(get_the_excerpt($service), 170, '…')); ?></p>
                        </div>
                    </article>
                <?php endforeach; ?>
            </div>
        </div>
    </section>

    <section class="about">
        <?php
            $about_title = $fields['titre'];
            $about_subtitle = $fields['sous-titre'];
            $about_description = $fields['description'];
            $about_metric_1_value = $fields['chiffre_1'];
            $about_metric_1_label = $fields['libelle_du_chiffre_1'];
            $about_metric_2_value = $fields['chiffre_2'];
            $about_metric_2_label = $fields['libelle_du_chiffre_2'];
            $about_button = $fields['bouton_about_us'];
            $about_button = is_array($about_button) ? $about_button : [];
            $about_illustration_1_id = absint($fields['illustration_1']);
            $about_illustration_2_id = absint($fields['illustration_2']);
            $about_illustration_3_id = absint($fields['illustration_3']);
        ?>

        <div class="about__container container">
            <div class="about__illustrations">
                <div class="about__illustration">
                    <?php if ($about_illustration_1_id) : ?>
                        <?php echo wp_get_attachment_image($about_illustration_1_id, 'full', false, ['alt' => '']); ?>
                    <?php else : ?>
                        <img src="<?php echo esc_url(get_theme_file_uri('/src/assets/images/about-illustration-1.png')); ?>" alt="">
                    <?php endif; ?>
                </div>

                <div class="about__illustration">
                    <?php if ($about_illustration_2_id) : ?>
                        <?php echo wp_get_attachment_image($about_illustration_2_id, 'full', false, ['alt' => '']); ?>
                    <?php else : ?>
                        <img src="<?php echo esc_url(get_theme_file_uri('/src/assets/images/about-illustration-2.png')); ?>" alt="">
                    <?php endif; ?>
                </div>

                <div class="about__illustration">
                    <?php if ($about_illustration_3_id) : ?>
                        <?php echo wp_get_attachment_image($about_illustration_3_id, 'full', false, ['alt' => '']); ?>
                    <?php else : ?>
                        <img src="<?php echo esc_url(get_theme_file_uri('/src/assets/images/about-illustration-3.png')); ?>" alt="">
                    <?php endif; ?>
                </div>
            </div>

            <div class="about__content">
                <div class="section-header section-header--light section-header--small">
                    <h2 class="section-header__title"><?php echo esc_html($about_title); ?></h2>
                    <h3 class="section-header__subtitle"><?php echo esc_html($about_subtitle); ?></h3>
                </div>

                <p class="about__text"><?php echo esc_html($about_description); ?></p>

                <div class="about__numbers">
                    <div class="about__number">
                        <span><?php echo esc_html($about_metric_1_value); ?></span>

                        <p><?php echo esc_html($about_metric_1_label); ?></p>
                    </div>

                    <div class="about__number">
                        <span><?php echo esc_html($about_metric_2_value); ?></span>

                        <p><?php echo esc_html($about_metric_2_label); ?></p>
                    </div>
                </div>

                <a
                    href="<?php echo esc_url($about_button['url'] ?? home_url('/')); ?>"
                    class="about__button button button--secondary"
                    <?php if (!empty($about_button['target'])) : ?>
                        target="<?php echo esc_attr($about_button['target']); ?>"
                        <?php if ($about_button['target'] === '_blank') : ?>
                            rel="noopener noreferrer"
                        <?php endif; ?>
                    <?php endif; ?>
                >
                    <svg aria-hidden="true" viewBox="0 0 28 28" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <circle cx="14" cy="14" r="14"/>
                        <path d="M12 9L16.6667 13.6667L12 18.3333" stroke-width="1.55439" stroke-linecap="round" stroke-linejoin="round"/>
                    </svg>

                    <?php echo esc_html($about_button['title']); ?>
                </a>
            </div>
        </div>
    </section>

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
                    ?>

                    <li class="process__step">
                        <article class="step">
                            <?php if (has_post_thumbnail($process_step) || $process_title) : ?>
                                <div class="step__header">
                                <?php if (has_post_thumbnail($process_step)) : ?>
                                    <span class="step__icon">
                                        <?php echo get_the_post_thumbnail($process_step, 'small'); ?>
                                    </span>
                                <?php endif; ?>

                                <?php if ($process_title) : ?>
                                    <h4 class="step__title"><?php echo esc_html($process_title); ?></h4>
                                <?php endif; ?>
                            <?php endif; ?>
                            </div>

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
                <a href="/" class="projects__button button">
                    <svg aria-hidden="true" viewBox="0 0 28 28" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <circle cx="14" cy="14" r="14"/>
                        <path d="M12 9L16.6667 13.6667L12 18.3333" stroke-width="1.55439" stroke-linecap="round" stroke-linejoin="round"/>
                    </svg>

                    Start your Free Trial
                </a>

                <ul class="projects__list">
                    <?php foreach ($projects as $project) : ?>
                        <?php
                            $project_title = get_the_title($project);
                            $project_content = get_the_excerpt($project);
                            $project_url = get_permalink($project);
                        ?>

                        <li class="projects__item">
                            <a href="<?php echo esc_url($project_url); ?>" class="project">
                                <?php if (has_post_thumbnail($project)) : ?>
                                    <div class="project__illustration">
                                        <?php echo get_the_post_thumbnail($project, 'large'); ?>
                                    </div>
                                <?php endif; ?>

                                <?php if ($project_title || $project_content) : ?>
                                    <div class="project__content">
                                        <?php if ($project_title) : ?>
                                            <h4 class="project__title"><?php echo esc_html($project_title); ?></h4>
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
                        $testimonial_content = get_the_content(null, false, $testimonial);
                    ?>
                    <li class="testimonies__item">
                        <article class="testimony">
                            <?php if (has_post_thumbnail($testimonial)) : ?>
                                <?php echo get_the_post_thumbnail($testimonial, 'medium', ['class' => 'testimony__photo', 'alt'   => '',]);?>
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
