<?php get_header(); ?>

<?php if (have_posts()) : ?>
    <?php while (have_posts()) : the_post(); ?>
        <?php
            $project_title = get_the_title();
            $project_image = get_the_post_thumbnail(get_the_ID(), 'full');

            $project_categories = get_the_terms(get_the_ID(), 'category');
            $project_category = ($project_categories && ! is_wp_error($project_categories))
                ? ($project_categories[0]->name ?? '')
                : '';
            $project_category_label = 'Categorie';

            $project_client = function_exists('get_field')
                ? (get_field('client_projet') ?? '')
                : '';
            $project_client_label = function_exists('get_field_object')
                ? (get_field_object('client_projet')['label'] ?? '')
                : '';

            $project_date = function_exists('get_field')
                ? (get_field('date_projet') ?? '')
                : '';
            $project_date_label = function_exists('get_field_object')
                ? (get_field_object('date_projet')['label'] ?? '')
                : '';

            $project_location = function_exists('get_field')
                ? (get_field('lieu_projet') ?? '')
                : '';
            $project_location_label = function_exists('get_field_object')
                ? (get_field_object('lieu_projet')['label'] ?? '')
                : '';
        ?>

        <main class="main">
            <section class="single-project">
                <div class="single-project__container container">
                    <article>
                        <?php if ($project_title || $project_image) : ?>
                            <div class="single-project__header">
                                <?php if ($project_title) : ?>
                                    <h1 class="single-project__title"><?php echo esc_html($project_title); ?></h1>
                                <?php endif; ?>

                                <?php if ($project_image) : ?>
                                    <?php echo $project_image; ?>
                                <?php endif; ?>
                            </div>
                        <?php endif; ?>

                        <?php if ($project_category || $project_client || $project_date || $project_location) : ?>
                            <div class="single-project__infos">
                                <?php if ($project_category) : ?>
                                    <div class="single-project__info">
                                        <span><?php echo esc_html($project_category_label); ?> :</span>
                                        <span> <?php echo esc_html($project_category); ?></span>
                                    </div>
                                <?php endif; ?>

                                <?php if ($project_client) : ?>
                                    <div class="single-project__info">
                                        <span><?php echo esc_html($project_client_label); ?> :</span>
                                        <span> <?php echo esc_html($project_client); ?></span>
                                    </div>
                                <?php endif; ?>

                                <?php if ($project_date) : ?>
                                    <div class="single-project__info">
                                        <span><?php echo esc_html($project_date_label); ?> :</span>
                                        <span> <?php echo esc_html($project_date); ?></span>
                                    </div>
                                <?php endif; ?>

                                <?php if ($project_location) : ?>
                                    <div class="single-project__info">
                                        <span><?php echo esc_html($project_location_label); ?> :</span>
                                        <span> <?php echo esc_html($project_location); ?></span>
                                    </div>
                                <?php endif; ?>
                            </div>
                        <?php endif; ?>

                        <?php if (get_the_content()) : ?>
                            <div class="single-project__content">
                                <?php the_content() ?>
                            </div>
                        <?php endif; ?>
                    </article>
                </div>
            </section>

            <?php
                $other_projects = new WP_Query([
                    'post_type'      => 'projects',
                    'post_status'    => 'publish',
                    'posts_per_page' => 3,
                    'post__not_in'   => [get_the_ID()],
                    'orderby'       => 'date',
                    'order'         => 'DESC',
                    'no_found_rows' => true,
                ]);
                ?>

                <?php if ($other_projects->have_posts()) : ?>
                    <section class="other-projects">
                        <div class="other-projects__container container">
                            <h2 class="other-projects__title">Recent Projects</h2>

                            <ul class="other-projects__list">
                                <?php while ($other_projects->have_posts()) :
                                    $other_projects->the_post();
                                ?>
                                    <li>
                                        <?php
                                        get_template_part(
                                            'template-parts/cards/project',
                                            null,
                                            ['project' => get_post()]
                                        );
                                        ?>
                                    </li>
                                <?php endwhile; ?>
                            </ul>
                        </div>
                    </section>
                <?php endif; ?>

                <?php wp_reset_postdata(); ?>
        </main>
    <?php endwhile; ?>
<?php endif; ?>

<?php get_footer(); ?>
