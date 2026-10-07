<?php
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
