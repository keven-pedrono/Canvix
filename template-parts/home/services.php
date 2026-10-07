<?php
    $services = get_posts([
        'post_type'        => 'service',
        'post_status'      => 'publish',
        'numberposts'      => -1,
        'orderby'          => 'menu_order',
        'order'            => 'ASC',
        'suppress_filters' => true,
    ]);
?>

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
                    <div class="services__item">
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
                    </div>
                <?php endforeach; ?>
            </div>
        </div>
    </section>
<?php endif; ?>
