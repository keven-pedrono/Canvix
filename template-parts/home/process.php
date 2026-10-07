<?php
    $process = get_posts([
        'post_type'        => 'process',
        'post_status'      => 'publish',
        'numberposts'      => -1,
        'orderby'          => 'menu_order',
        'order'            => 'ASC',
        'suppress_filters' => true,
    ]);
?>

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
