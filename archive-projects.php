<?php get_header(); ?>

<main class="main">
    <section class="archives">
        <div class="archives__container container">
            <div class="archives__header">
                <h1 class="archives__title"><?php post_type_archive_title(); ?></h1>
            </div>

            <?php if (have_posts()) : ?>
                <ul class="archives__list">
                    <?php while (have_posts()) : the_post(); ?>
                        <li>
                            <?php get_template_part('template-parts/cards/project', null, ['project' => get_post()]); ?>
                        </li>
                    <?php endwhile; ?>
                </ul>

                <?php the_posts_pagination([
                    'prev_text' => 'Précédent',
                    'next_text' => 'Suivant',
                ]); ?>

            <?php else : ?>
                <p>Aucun projet pour le moment.</p>
            <?php endif; ?>

            <div class="archives__footer">
                <h2>Enough talk, let's get to work</h2>

                <a href="<?php echo esc_url(get_theme_mod('canvix_home_cta_url', home_url('/'))); ?>" class="archives__button button button--border">
                    Get in touch
                </a>
            </div>
        </div>
    </section>
</main>

<?php get_footer(); ?>
