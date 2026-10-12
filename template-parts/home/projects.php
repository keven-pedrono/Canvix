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
                <?php get_template_part('template-parts/components/home-cta', null, [
                    'classes' => 'projects__button',
                ]); ?>

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
