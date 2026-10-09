<?php
    $projects = get_posts([
        'post_type'   => 'projects',
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
                        <li class="projects__item">
                            <?php get_template_part('template-parts/cards/project', null, ['project' => $project]); ?>
                        </li>
                    <?php endforeach; ?>
                </ul>
            </div>
        </div>
    </section>
<?php endif; ?>
