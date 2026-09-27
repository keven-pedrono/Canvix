<?php get_header(); ?>

<main class="site-main">
	<?php if (have_posts()) : ?>
		<?php while (have_posts()) : the_post(); ?>
			<article <?php post_class(); ?>>
				<?php the_title('<h1 class="entry-title">', '</h1>'); ?>
				<?php the_content(); ?>
			</article>
		<?php endwhile; ?>
	<?php else : ?>
		<h1 class="entry-title"><?php bloginfo('name'); ?></h1>
	<?php endif; ?>
</main>

<?php get_footer(); ?>
