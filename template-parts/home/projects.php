<?php
    $projects = get_posts([
        'post_type'   => 'recent_projects',
        'post_status' => 'publish',
        'numberposts' => 4,
        'orderby'     => [
            'date' => 'DESC',
            'ID' => 'DESC'
        ],
    ]);
?>

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
