<?php get_header(); ?>

<main class="main">
	<section class="hero">
        <div class="hero__container container">
            <div class="hero__wrap">
                <div class="hero__content">
                    <h1 class="hero__title">
                    Ready to take your
                    <span>Business Growth</span>
                    to the next level?
                    </h1>

                    <p class="hero__text">Lorem ipsum dolor sit amet, consectetur adipiscing elit- et ut massa libero egestas malesuada viverra gravida libero cursus nulla leo pulvinar.</p>

                    <a href="/" class="hero__button button button--secondary">
                        <svg viewBox="0 0 28 28" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <circle cx="14" cy="14" r="14"/>
                            <path d="M12 9L16.6667 13.6667L12 18.3333" stroke-width="1.55439" stroke-linecap="round" stroke-linejoin="round"/>
                        </svg>

                        Start your Free Trial
                    </a>
                </div>

                <div class="hero__cta">
                    <h2 class="hero__brands">Trusted by Leading Brands</h2>

                    <div class="hero__links">
                        <a href="/" target="_blank" class="hero__link">
                            <img src="<?php echo esc_url(get_theme_file_uri('/src/assets/images/greenish.png')); ?>" alt="">
                        </a>

                        <a href="/" target="_blank" class="hero__link">
                            <img src="<?php echo esc_url(get_theme_file_uri('/src/assets/images/automation.png')); ?>" alt="">
                        </a>

                        <a href="/" target="_blank" class="hero__link">
                            <img src="<?php echo esc_url(get_theme_file_uri('/src/assets/images/leafe.png')); ?>" alt="">
                        </a>

                        <a href="/" target="_blank" class="hero__link">
                            <img src="<?php echo esc_url(get_theme_file_uri('/src/assets/images/mindfulness.png')); ?>" alt="">
                        </a>
                    </div>
                </div>
            </div>

            <div class="hero__illustration">
                <div>
                    <div>
                        <img src="<?php echo esc_url(get_theme_file_uri('/src/assets/images/hero-illustration.png')); ?>" alt="">
                    </div>
                </div>

            </div>
        </div>
    </section>
</main>

<?php get_footer(); ?>
