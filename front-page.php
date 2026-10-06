<?php
get_header();
?>

<main class="main">
    <?php
        $fields = function_exists('get_fields') ? get_fields() : [];
        $fields = is_array($fields) ? $fields : [];
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

    <section class="process">
        <div class="process__container container">
            <div class="section-header section-header--center section-header--medium">
                <h2 class="section-header__title">Process</h2>
                <h3 class="section-header__subtitle">Process that moves things forward</h3>
            </div>

            <ol class="process__steps">
                <li class="process__step">
                    <article class="step">
                        <div class="step__header">
                            <span class="step__icon">
                                <svg aria-hidden="true" viewBox="0 0 32 46" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M23.2386 35.1278H8.50527M23.2386 35.1278V37.5833C23.2386 39.8716 23.2386 41.0158 22.8648 41.9183C22.3663 43.1217 21.4103 44.0777 20.2069 44.5762C19.3044 44.95 18.1602 44.95 15.8719 44.95C13.5836 44.95 12.4395 44.95 11.537 44.5762C10.3336 44.0777 9.37756 43.1217 8.87911 41.9183C8.50527 41.0158 8.50527 39.8716 8.50527 37.5833V35.1278M23.2386 35.1278V32.6543C23.2386 31.8677 23.4859 31.101 23.9455 30.4626L28.1211 24.6632C35.3098 14.6789 28.1749 0.75 15.8719 0.75C3.56897 0.75 -3.5659 14.6789 3.62278 24.6632L7.79836 30.4626C8.25798 31.101 8.50527 31.8677 8.50527 32.6543V35.1278M12.1886 21.6222L15.8719 27.7611L19.5553 21.6222" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                                </svg>
                            </span>

                            <h4 class="step__title">Ideate</h2>
                        </div>

                        <p class="step__text">The ideation process is a crucial phase in the design process where creative thinking and brainstorming</p>

                        <span class="step__arrow">
                        </span>
                    </article>
                </li>

                <li class="process__step">
                    <article class="step">
                        <div class="step__header">
                            <span class="step__icon">
                                <svg aria-hidden="true" viewBox="0 0 36 30" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M0.75 14.9208C0.75 10.519 0.75 8.31805 1.46913 6.58193C2.42796 4.26709 4.26709 2.42796 6.58193 1.46913C8.31805 0.75 10.519 0.75 14.9208 0.75H20.5892C24.991 0.75 27.1919 0.75 28.9281 1.46913C31.2429 2.42796 33.082 4.26709 34.0409 6.58193C34.76 8.31805 34.76 10.519 34.76 14.9208C34.76 19.3227 34.76 21.5236 34.0409 23.2597C33.082 25.5746 31.2429 27.4137 28.9281 28.3725C27.1919 29.0917 24.991 29.0917 20.5892 29.0917H14.9208C10.519 29.0917 8.31805 29.0917 6.58193 28.3725C4.26709 27.4137 2.42796 25.5746 1.46913 23.2597C0.75 21.5236 0.75 19.3227 0.75 14.9208Z" stroke-width="1.5" stroke-linejoin="round"/>
                                    <path d="M0.75 7.36304L7.31554 12.4693C11.755 15.9221 13.9748 17.6485 16.5104 17.9856C17.337 18.0955 18.1745 18.0955 19.0011 17.9856C21.5367 17.6483 23.7563 15.9218 28.1957 12.4689L34.76 7.36304" stroke-width="1.5" stroke-linejoin="round"/>
                                </svg>
                            </span>

                            <h4 class="step__title">Research</h2>
                        </div>

                        <p class="step__text">Research is a critical component of the design process, helping designers understand the problem</p>

                        <span class="step__arrow">
                        </span>
                    </article>
                </li>

                <li class="process__step">
                    <article class="step">
                        <div class="step__header">
                            <span class="step__icon">
                                <svg aria-hidden="true" viewBox="0 0 32 32" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M0.75 5.28597H4.04889M4.04889 5.28597C4.04889 7.79112 6.07971 9.82194 8.58486 9.82194C11.09 9.82194 13.1208 7.79112 13.1208 5.28597M4.04889 5.28597C4.04889 2.78082 6.07971 0.75 8.58486 0.75C11.09 0.75 13.1208 2.78082 13.1208 5.28597M13.1208 5.28597L30.44 5.28597M0.75 25.904H4.04889M4.04889 25.904C4.04889 23.3989 6.07971 21.3681 8.58486 21.3681C11.09 21.3681 13.1208 23.3989 13.1208 25.904M4.04889 25.904C4.04889 28.4092 6.07971 30.44 8.58486 30.44C11.09 30.44 13.1208 28.4092 13.1208 25.904M13.1208 25.904L30.44 25.904M30.44 15.595H27.1411M27.1411 15.595C27.1411 18.1001 25.1103 20.131 22.6051 20.131C20.1 20.131 18.0692 18.1001 18.0692 15.595M27.1411 15.595C27.1411 13.0899 25.1103 11.059 22.6051 11.059C20.1 11.059 18.0692 13.0899 18.0692 15.595M18.0692 15.595L0.75 15.595" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                                </svg>
                            </span>

                            <h4 class="step__title">Create</h2>
                        </div>

                        <p class="step__text">Designing a process involves several key steps to ensure clarity, efficiency, successfull implementation</p>

                        <span class="step__arrow">
                        </span>
                    </article>
                </li>

                <li class="process__step">
                    <article class="step">
                        <div class="step__header">
                            <span class="step__icon">
                                <svg aria-hidden="true" viewBox="0 0 32 32" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M16.7809 11.6182L10.1832 18.216L7.29662 15.3295M24.2034 14.0924L17.6057 20.6902L15.9562 19.0407M30.587 15.7419C30.587 23.9405 23.9406 30.5869 15.742 30.5869C7.54331 30.5869 0.896973 23.9405 0.896973 15.7419C0.896973 7.54318 7.54331 0.896851 15.742 0.896851C23.9406 0.896851 30.587 7.54318 30.587 15.7419Z" stroke-width="1.7936" stroke-linecap="round" stroke-linejoin="round"/>
                                </svg>
                            </span>

                            <h4 class="step__title">Testing</h2>
                        </div>

                        <p class="step__text">Testing is a crucial phase in the design process to ensure that the product or system meets the specified requirements</p>
                    </article>
                </li>
            </ol>
        </div>
    </section>

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
                    <li class="projects__item">
                        <a href="/" class="project">
                            <div class="project__illustration">
                                <img src="<?php echo esc_url(get_theme_file_uri('/src/assets/images/project-web.png')); ?>" alt="">
                            </div>

                            <div class="project__content">
                                <h4 class="project__title">Web UI design</h4>
                                <p class="project__text">Creative  UI design</p>
                            </div>
                        </a>
                    </li>

                    <li class="projects__item">
                        <a href="/" class="project">
                            <div class="project__illustration">
                                <img src="<?php echo esc_url(get_theme_file_uri('/src/assets/images/project-strategy.png')); ?>" alt="">
                            </div>

                            <div class="project__content">
                                <h4 class="project__title">To design Digital Strategy</h4>
                                <p class="project__text">Social Media Marketing</p>
                            </div>
                        </a>
                    </li>

                    <li class="projects__item">
                        <a href="/" class="project">
                            <div class="project__illustration">
                                <img src="<?php echo esc_url(get_theme_file_uri('/src/assets/images/project-design.png')); ?>" alt="">
                            </div>

                            <div class="project__content">
                                <h4 class="project__title">UI Design</h4>
                                <p class="project__text">Creative Rebranding for logo</p>
                            </div>
                        </a>
                    </li>

                    <li class="projects__item">
                        <a href="/" class="project">
                            <div class="project__illustration">
                                <img src="<?php echo esc_url(get_theme_file_uri('/src/assets/images/project-ui.png')); ?>" alt="">
                            </div>

                            <div class="project__content">
                                <h4 class="project__title">UI Design</h4>
                                <p class="project__text">Creative Rebranding for logo</p>
                            </div>
                        </a>
                    </li>
                </ul>
            </div>
        </div>
    </section>

    <section class="testimonies">
        <div class="testimonies__container container">
            <ul id="testimonials-slider" class="testimonies__list"
            aria-roledescription="carousel"
            aria-label="Testimonials"
            tabindex="0">
                <li class="testimonies__item">
                    <div class="testimony">
                        <img src="<?php echo esc_url(get_theme_file_uri('/src/assets/images/project-web.png')); ?>" alt="" class="testimony__photo">

                        <blockquote class="testimony__quote">“Be genuine in your assessment, and provide constructive feedback to benefit both potential customers and the company providing the product or service.”</blockquote>

                        <div class="testimony__infos">
                            <p class="testimony__name">Jacqueline Miller</p>
                            <p class="testimony__position">CEO of an eduport</p>
                        </div>
                    </div>
                </li>
            </ul>

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
        </div>
    </section>
</main>

<?php get_footer(); ?>
