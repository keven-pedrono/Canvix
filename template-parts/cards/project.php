<?php
    $project = $args['project'];

    $project_title = get_the_title($project);
    $project_content = get_the_excerpt($project);
    $project_url = get_permalink($project);
    $project_image = get_the_post_thumbnail($project, 'large');
?>

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
