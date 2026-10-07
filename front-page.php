<?php get_header(); ?>

<main class="main">
    <?php
        get_template_part('template-parts/home/hero');
        get_template_part('template-parts/home/services');
        get_template_part('template-parts/home/about');
        get_template_part('template-parts/home/process');
        get_template_part('template-parts/home/projects');
        get_template_part('template-parts/home/testimonials');
    ?>
</main>

<?php get_footer(); ?>
