<?php
get_header();
?>

<main class="main">
	<section class="hero">
    <?php
    $hero_fields = function_exists('get_fields') ? get_fields() : [];
    $hero_fields = is_array($hero_fields) ? $hero_fields : [];

    $hero_title_before = $hero_fields['hero_title_before'] ?? 'Ready to take your';
    $hero_title_highlight = $hero_fields['hero_title_highlight'] ?? 'Business Growth';
    $hero_title_after = $hero_fields['hero_title_after'] ?? 'to the next level?';
    $hero_description = $hero_fields['hero_description'] ?? 'Lorem ipsum dolor sit amet, consectetur adipiscing elit- et ut massa libero egestas malesuada viverra gravida libero cursus nulla leo pulvinar.';
    $hero_button = $hero_fields['hero_button'] ?? [];
    $hero_button = is_array($hero_button) ? $hero_button : [];
    $hero_brands_title = $hero_fields['hero_brands_title'] ?? 'Trusted by Leading Brands';
    $hero_illustration_id = absint($hero_fields['hero_illustration'] ?? 0);

    ?>
        <div class="hero__container container">
            <div class="hero__wrap">
                <div class="hero__content">
                    <h1 class="hero__title">
                        <?php echo esc_html($hero_title_before); ?>
                        <span><?php echo esc_html($hero_title_highlight); ?></span>
                        <?php echo esc_html($hero_title_after); ?>
                    </h1>

                    <p class="hero__text"><?php echo esc_html($hero_description); ?></p>

                    <a
                        href="<?php echo esc_url($hero_button['url'] ?? home_url('/')); ?>"
                        class="hero__button button button--secondary"
                        <?php if (!empty($hero_button['target'])) : ?>
                            target="<?php echo esc_attr($hero_button['target']); ?>"
                        <?php endif; ?>>
                        <svg aria-hidden="true" viewBox="0 0 28 28" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <circle cx="14" cy="14" r="14"/>
                            <path d="M12 9L16.6667 13.6667L12 18.3333" stroke-width="1.55439" stroke-linecap="round" stroke-linejoin="round"/>
                        </svg>

                        <?php echo esc_html($hero_button['title'] ?? 'Start your Free Trial'); ?>
                    </a>
                </div>

                <div class="hero__cta">
                    <h2 class="hero__brands"><?php echo esc_html($hero_brands_title); ?></h2>

                    <div class="hero__links">
                    <?php
                    for ($brand_number = 1; $brand_number <= 4; $brand_number++) :
                        $brand_show_key = 'hero_brand_' . $brand_number . '_show';
                        $brand_image_key = 'hero_brand_' . $brand_number . '_image';
                        $brand_name_key = 'hero_brand_' . $brand_number . '_name';
                        $brand_link_key = 'hero_brand_' . $brand_number . '_link';

                        $brand_show = array_key_exists($brand_show_key, $hero_fields)
                            ? (bool) $hero_fields[$brand_show_key]
                            : true;

                        $brand_image_id = absint($hero_fields[$brand_image_key] ?? 0);
                        $brand_name = $hero_fields[$brand_name_key] ?? '';
                        $brand_link = $hero_fields[$brand_link_key] ?? [];
                        $brand_link = is_array($brand_link) ? $brand_link : [];
                        $brand_url = $brand_link['url'] ?? '';
                        $brand_target = $brand_link['target'] ?? '';

                        if (!$brand_show || !$brand_image_id) {
                            continue;
                        }
                        ?>
                            <?php if ($brand_url) : ?>
                            <a
                                href="<?php echo esc_url($brand_url); ?>"
                                class="hero__link"
                                <?php if ($brand_target) : ?>
                                    target="<?php echo esc_attr($brand_target); ?>"
                                    <?php if ($brand_target === '_blank') : ?>
                                        rel="noopener noreferrer"
                                    <?php endif; ?>
                                <?php endif; ?>
                            >
                                <?php echo wp_get_attachment_image($brand_image_id, 'full', false, ['alt' => $brand_name]); ?>
                            </a>

                            <?php else : ?>
                                <?php echo wp_get_attachment_image($brand_image_id, 'full', false, ['alt' => $brand_name]); ?>
                            <?php endif; ?>
                    <?php endfor; ?>
                    </div>
                </div>
            </div>

            <div class="hero__illustration">
                <div>
                    <div>
                        <?php if ($hero_illustration_id) : ?>
                            <?php echo wp_get_attachment_image($hero_illustration_id, 'full', false, ['alt' => '']); ?>
                        <?php else : ?>
                            <img src="<?php echo esc_url(get_theme_file_uri('/src/assets/images/hero-illustration.png')); ?>" alt="">
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="services">
        <div class="services__container container">
            <div class="section-header section-header--big section-header--center">
                <h2 class="section-header__title">Our Services</h2>
                <h3 class="section-header__subtitle">High-impact services for your business</h3>
            </div>

            <div class="services__content">
                <article class="service service--dark">
                    <div class="service__icon">
                        <svg aria-hidden="true" viewBox="0 0 31 31" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M27.0864 8.85779L9.59966 26.3445L1.18457 29.7032L4.54331 21.2882L22.03 3.80144L23.6 2.23142C24.9963 0.835149 27.2601 0.835149 28.6564 2.23142C30.0527 3.62769 30.0527 5.8915 28.6564 7.28777L27.0864 8.85779ZM9.59966 26.3445L8.92691 21.9599L4.54331 21.2882M27.0864 8.85779L22.03 3.80144" stroke-width="2.36842" stroke-linecap="round" stroke-linejoin="round"/>
                        </svg>
                    </div>

                    <div class="service__content">
                        <h4 class="service__title">Content Marketing</h4>
                        <p class="service__text">Our team creates engaging and shareable content that resonates with your audience, drives organic traffic</p>
                    </div>
                </article>

                <article class="service">
                    <div class="service__icon">
                        <svg aria-hidden="true" viewBox="0 0 34 34" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M15.3919 5.56402L8.62929 7.34366C7.83414 7.55291 7.43656 7.65753 7.13458 7.90162C7.03533 7.98185 6.94484 8.07234 6.86462 8.17159C6.62053 8.47356 6.51591 8.87114 6.30666 9.66628L2.48853 24.1752C1.51297 27.8823 1.02518 29.7359 1.79096 30.9128C2.03212 31.2834 2.34818 31.5995 2.7188 31.8406C3.8957 32.6064 5.74927 32.1186 9.45641 31.1431L23.9653 27.3249C24.7605 27.1157 25.158 27.0111 25.46 26.767C25.5593 26.6867 25.6497 26.5963 25.73 26.497C25.9741 26.195 26.0787 25.7975 26.2879 25.0023L28.0676 18.2397M15.3919 5.56402L28.0676 18.2397M15.3919 5.56402L18.5195 2.43638C19.4798 1.47612 19.9599 0.995989 20.5411 0.903948C20.7287 0.874223 20.9199 0.874223 21.1076 0.903948C21.6887 0.995989 22.1689 1.47612 23.1291 2.43638L31.1952 10.5025C32.1555 11.4627 32.6356 11.9429 32.7276 12.524C32.7574 12.7117 32.7574 12.9029 32.7276 13.0905C32.6356 13.6717 32.1555 14.1518 31.1952 15.1121L28.0676 18.2397" stroke-width="1.7633" stroke-linecap="round" stroke-linejoin="round"/>
                            <path d="M12.9018 20.7379C11.5892 19.4253 11.5892 17.2971 12.9018 15.9845C14.2144 14.6719 16.3426 14.6719 17.6552 15.9845C18.9678 17.2971 18.9678 19.4253 17.6552 20.7379C16.3426 22.0505 14.2144 22.0505 12.9018 20.7379ZM12.9018 20.7379L8.14844 25.4913" stroke-width="2.71622" stroke-linecap="round" stroke-linejoin="round"/>
                        </svg>
                    </div>

                    <div class="service__content">
                        <h4 class="service__title">Graphic Design</h4>
                        <p class="service__text">Unlock the power of visual storytelling with our expert graphic design services tailored to elevate your brand and captivate.</p>
                    </div>
                </article>

                <article class="service service--dark">
                    <div class="service__icon">
                        <svg aria-hidden="true" viewBox="0 0 35 35" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M14.351 8.81945C14.05 10.4528 13.7645 13.5783 13.7645 15.2394C13.7645 16.9006 13.8399 20.0797 14.351 21.6594M14.351 8.81945L17.6882 5.89545C21.8388 2.25869 23.9142 0.440311 25.6871 0.793463C26.2386 0.903311 26.7574 1.13852 27.2034 1.48091C28.6374 2.58166 28.6374 5.34092 28.6374 10.8594V19.5813C28.6374 25.0187 28.6374 27.7374 27.2168 28.8384C26.7749 29.1808 26.2594 29.4181 25.7119 29.5311C23.9518 29.8944 21.8878 28.1276 17.76 24.594C15.864 22.9711 14.455 21.7607 14.351 21.6594M14.351 8.81945C13.6207 8.76837 10.3402 8.76735 7.18424 8.77959C4.56904 8.78974 3.26144 8.79482 2.32446 9.44583C1.96302 9.69696 1.6471 10.0141 1.39737 10.3765C0.75 11.316 0.75 12.6287 0.75 15.2541C0.75 17.8918 0.75 19.2107 1.4013 20.1521C1.65254 20.5152 1.97014 20.8325 2.33354 21.0834C3.27559 21.7337 4.58965 21.7324 7.21777 21.7297C10.3634 21.7265 13.6233 21.7103 14.351 21.6594M4.46886 21.7222L4.42845 31.1272C4.42191 32.6479 5.65323 33.8838 7.17389 33.8831C8.68882 33.8823 9.91649 32.6539 9.91649 31.139V21.7231M32.3557 7.76755C34.2148 13.3715 34.2148 17.1074 32.3557 22.7113" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                        </svg>
                    </div>

                    <div class="service__content">
                        <h4 class="service__title">Digital Marketing</h4>
                        <p class="service__text">Elevate your brand's online presence with our data-driven digital marketing strategies. From SEO and content marketing</p>
                    </div>
                </article>

                <article class="service">
                    <div class="service__icon">
                        <svg aria-hidden="true" viewBox="0 0 35 35" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M27.1723 11.8429C27.1723 13.6511 25.6591 15.1169 23.7924 15.1169C21.9256 15.1169 20.4124 13.6511 20.4124 11.8429C20.4124 10.0348 21.9256 8.56899 23.7924 8.56899C25.6591 8.56899 27.1723 10.0348 27.1723 11.8429Z" stroke-width="1.65"/>
                            <path d="M14.6181 11.8429C14.6181 13.6511 13.1048 15.1169 11.2381 15.1169C9.37141 15.1169 7.85814 13.6511 7.85814 11.8429C7.85814 10.0348 9.37141 8.56899 11.2381 8.56899C13.1048 8.56899 14.6181 10.0348 14.6181 11.8429Z" stroke-width="1.65"/>
                            <path d="M15.5838 23.0678C15.5838 24.876 14.0705 26.3418 12.2038 26.3418C10.3371 26.3418 8.82385 24.876 8.82385 23.0678C8.82385 21.2597 10.3371 19.7939 12.2038 19.7939C14.0705 19.7939 15.5838 21.2597 15.5838 23.0678Z" stroke-width="1.65"/>
                            <path d="M33.8198 13.0336C33.6194 4.7183 21.5293 -0.48694 12.7241 1.11367C3.9189 2.71428 -0.34093 11.3906 1.09816 19.7939C2.49734 27.9642 11.721 33.825 17.5152 33.825C23.3095 33.825 28.138 31.0188 24.0641 27.6748C22.9307 26.7966 22.0076 25.6905 21.3585 24.4331C20.3848 22.5468 22.1466 19.8538 24.3155 20.0389C28.7173 20.4146 33.9761 19.5178 33.8198 13.0336Z" stroke-width="1.65"/>
                        </svg>
                    </div>

                    <div class="service__content">
                        <h4 class="service__title">Web Design</h4>
                        <p class="service__text">We specialize in creating visually stunning, user-friendly websites that align with your brand identity and deliver an exceptional.</p>
                    </div>
                </article>

                <article class="service service--dark">
                    <div class="service__icon">
                        <svg aria-hidden="true" viewBox="0 0 32 33" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M24.7791 3.30603C25.579 4.01344 26.0542 4.8972 26.0544 5.85578C26.0545 6.81437 25.5797 7.69794 24.7801 8.40503M29.3836 0.750046C30.5163 2.28661 31.1541 4.02132 31.1544 5.85723C31.1548 7.68769 30.5215 9.41731 29.3957 10.95M14.5791 10.95C11.7624 10.95 9.4791 8.6667 9.4791 5.85005C9.4791 3.03339 11.7624 0.750046 14.5791 0.750046C17.3958 0.750046 19.6791 3.03339 19.6791 5.85005C19.6791 8.6667 17.3958 10.95 14.5791 10.95ZM6.65556 31.35H22.5026C26.7712 31.35 29.6264 26.9565 27.8928 23.0559C25.9994 18.7956 21.7746 16.05 17.1125 16.05H12.0457C7.38364 16.05 3.15885 18.7956 1.2654 23.0559C-0.468216 26.9565 2.38703 31.35 6.65556 31.35Z" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                        </svg>
                    </div>

                    <div class="service__content">
                        <h4 class="service__title">IT Consulting</h4>
                        <p class="service__text">IT consulting, or information technology consulting, refers to the practice of providing advisory and implementation services</p>
                    </div>
                </article>

                <article class="service">
                    <div class="service__icon">
                        <svg aria-hidden="true" viewBox="0 0 34 32" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M10.9041 15.8021L7.12636 10.7848L8.87017 8.76848C9.75826 7.74163 10.2023 7.22821 10.772 6.90605C10.9602 6.79965 11.1571 6.7096 11.3607 6.63689C11.977 6.41671 12.6558 6.41671 14.0134 6.41671H16.5708M7.00158 2.88956L3.54156 6.56583C1.86446 8.34775 1.02591 9.23872 0.818377 10.3145C0.750935 10.664 0.73325 11.0214 0.765848 11.376C0.866156 12.4669 1.61265 13.4363 3.10563 15.3751L11.1831 25.8646C13.3681 28.7021 14.4606 30.1208 15.8836 30.3841C16.3379 30.4681 16.8037 30.4681 17.258 30.3841C18.681 30.1208 19.7735 28.7021 21.9585 25.8646L30.036 15.3751C31.529 13.4363 32.2754 12.4669 32.3758 11.376C32.4084 11.0214 32.3907 10.664 32.3232 10.3145C32.1157 9.23872 31.2771 8.34776 29.6 6.56583L26.14 2.88957C25.2593 1.95376 24.8189 1.48585 24.2701 1.19353C24.0886 1.0969 23.8996 1.01523 23.7049 0.949353C23.1159 0.750046 22.4734 0.750046 21.1883 0.750046H11.9533C10.6682 0.750046 10.0257 0.750046 9.43667 0.949353C9.24197 1.01523 9.05297 1.0969 8.87155 1.19353C8.32272 1.48585 7.88234 1.95376 7.00158 2.88956Z" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                        </svg>
                    </div>

                    <div class="service__content">
                        <h4 class="service__title">Brand Identity</h4>
                        <p class="service__text">It involves creating a unique and recognizable identity that sets the brand apart from competitors and resonates with the target audience.</p>
                    </div>
                </article>
            </div>
        </div>
    </section>

    <section class="about">
        <div class="about__container container">
            <div class="about__illustrations">
                <div class="about__illustration">
                    <img src="<?php echo esc_url(get_theme_file_uri('/src/assets/images/about-illustration-1.png')); ?>" alt="">
                </div>

                <div class="about__illustration">
                    <img src="<?php echo esc_url(get_theme_file_uri('/src/assets/images/about-illustration-2.png')); ?>" alt="">
                </div>

                <div class="about__illustration">
                    <img src="<?php echo esc_url(get_theme_file_uri('/src/assets/images/about-illustration-3.png')); ?>" alt="">
                </div>
            </div>

            <div class="about__content">
                <div class="section-header section-header--light section-header--small">
                    <h2 class="section-header__title">About us</h2>
                    <h3 class="section-header__subtitle">The core mission behind all our work</h3>
                </div>

                <p class="about__text">
                    Lorem ipsum dolor sit amet, consectetur adipiscing elit metus ut tortor purus tincidunt sed lectus ut eros, turpis tincidunt id.
                </p>

                <div class="about__numbers">
                    <div class="about__number">
                        <span>330 +</span>

                        <p>Companies helped</p>
                    </div>

                    <div class="about__number">
                        <span>230 +</span>

                        <p>Revenue generated</p>
                    </div>
                </div>

                <a href="/" class="about__button button button--secondary">
                    <svg aria-hidden="true" viewBox="0 0 28 28" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <circle cx="14" cy="14" r="14"/>
                        <path d="M12 9L16.6667 13.6667L12 18.3333" stroke-width="1.55439" stroke-linecap="round" stroke-linejoin="round"/>
                    </svg>

                    Start your Free Trial
                </a>
            </div>
        </div>
    </section>

    <section class="process">
        <div class="process__container container">
            <div class="section-header section-header--center section-header--medium">
                <h2 class="section-header__title">Process</h2>
                <h3 class="section-header__subtitle">Process that moves things forward</h3>
            </div>

            <ol class="process__steps">
                <li class="process__step">
                    <article class="step">
                        <div class="step__header">
                            <span class="step__icon">
                                <svg aria-hidden="true" viewBox="0 0 32 46" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M23.2386 35.1278H8.50527M23.2386 35.1278V37.5833C23.2386 39.8716 23.2386 41.0158 22.8648 41.9183C22.3663 43.1217 21.4103 44.0777 20.2069 44.5762C19.3044 44.95 18.1602 44.95 15.8719 44.95C13.5836 44.95 12.4395 44.95 11.537 44.5762C10.3336 44.0777 9.37756 43.1217 8.87911 41.9183C8.50527 41.0158 8.50527 39.8716 8.50527 37.5833V35.1278M23.2386 35.1278V32.6543C23.2386 31.8677 23.4859 31.101 23.9455 30.4626L28.1211 24.6632C35.3098 14.6789 28.1749 0.75 15.8719 0.75C3.56897 0.75 -3.5659 14.6789 3.62278 24.6632L7.79836 30.4626C8.25798 31.101 8.50527 31.8677 8.50527 32.6543V35.1278M12.1886 21.6222L15.8719 27.7611L19.5553 21.6222" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                                </svg>
                            </span>

                            <h4 class="step__title">Ideate</h2>
                        </div>

                        <p class="step__text">The ideation process is a crucial phase in the design process where creative thinking and brainstorming</p>

                        <span class="step__arrow">
                        </span>
                    </article>
                </li>

                <li class="process__step">
                    <article class="step">
                        <div class="step__header">
                            <span class="step__icon">
                                <svg aria-hidden="true" viewBox="0 0 36 30" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M0.75 14.9208C0.75 10.519 0.75 8.31805 1.46913 6.58193C2.42796 4.26709 4.26709 2.42796 6.58193 1.46913C8.31805 0.75 10.519 0.75 14.9208 0.75H20.5892C24.991 0.75 27.1919 0.75 28.9281 1.46913C31.2429 2.42796 33.082 4.26709 34.0409 6.58193C34.76 8.31805 34.76 10.519 34.76 14.9208C34.76 19.3227 34.76 21.5236 34.0409 23.2597C33.082 25.5746 31.2429 27.4137 28.9281 28.3725C27.1919 29.0917 24.991 29.0917 20.5892 29.0917H14.9208C10.519 29.0917 8.31805 29.0917 6.58193 28.3725C4.26709 27.4137 2.42796 25.5746 1.46913 23.2597C0.75 21.5236 0.75 19.3227 0.75 14.9208Z" stroke-width="1.5" stroke-linejoin="round"/>
                                    <path d="M0.75 7.36304L7.31554 12.4693C11.755 15.9221 13.9748 17.6485 16.5104 17.9856C17.337 18.0955 18.1745 18.0955 19.0011 17.9856C21.5367 17.6483 23.7563 15.9218 28.1957 12.4689L34.76 7.36304" stroke-width="1.5" stroke-linejoin="round"/>
                                </svg>
                            </span>

                            <h4 class="step__title">Research</h2>
                        </div>

                        <p class="step__text">Research is a critical component of the design process, helping designers understand the problem</p>

                        <span class="step__arrow">
                        </span>
                    </article>
                </li>

                <li class="process__step">
                    <article class="step">
                        <div class="step__header">
                            <span class="step__icon">
                                <svg aria-hidden="true" viewBox="0 0 32 32" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M0.75 5.28597H4.04889M4.04889 5.28597C4.04889 7.79112 6.07971 9.82194 8.58486 9.82194C11.09 9.82194 13.1208 7.79112 13.1208 5.28597M4.04889 5.28597C4.04889 2.78082 6.07971 0.75 8.58486 0.75C11.09 0.75 13.1208 2.78082 13.1208 5.28597M13.1208 5.28597L30.44 5.28597M0.75 25.904H4.04889M4.04889 25.904C4.04889 23.3989 6.07971 21.3681 8.58486 21.3681C11.09 21.3681 13.1208 23.3989 13.1208 25.904M4.04889 25.904C4.04889 28.4092 6.07971 30.44 8.58486 30.44C11.09 30.44 13.1208 28.4092 13.1208 25.904M13.1208 25.904L30.44 25.904M30.44 15.595H27.1411M27.1411 15.595C27.1411 18.1001 25.1103 20.131 22.6051 20.131C20.1 20.131 18.0692 18.1001 18.0692 15.595M27.1411 15.595C27.1411 13.0899 25.1103 11.059 22.6051 11.059C20.1 11.059 18.0692 13.0899 18.0692 15.595M18.0692 15.595L0.75 15.595" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                                </svg>
                            </span>

                            <h4 class="step__title">Create</h2>
                        </div>

                        <p class="step__text">Designing a process involves several key steps to ensure clarity, efficiency, successfull implementation</p>

                        <span class="step__arrow">
                        </span>
                    </article>
                </li>

                <li class="process__step">
                    <article class="step">
                        <div class="step__header">
                            <span class="step__icon">
                                <svg aria-hidden="true" viewBox="0 0 32 32" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M16.7809 11.6182L10.1832 18.216L7.29662 15.3295M24.2034 14.0924L17.6057 20.6902L15.9562 19.0407M30.587 15.7419C30.587 23.9405 23.9406 30.5869 15.742 30.5869C7.54331 30.5869 0.896973 23.9405 0.896973 15.7419C0.896973 7.54318 7.54331 0.896851 15.742 0.896851C23.9406 0.896851 30.587 7.54318 30.587 15.7419Z" stroke-width="1.7936" stroke-linecap="round" stroke-linejoin="round"/>
                                </svg>
                            </span>

                            <h4 class="step__title">Testing</h2>
                        </div>

                        <p class="step__text">Testing is a crucial phase in the design process to ensure that the product or system meets the specified requirements</p>
                    </article>
                </li>
            </ol>
        </div>
    </section>

    <section class="projects">
        <div class="projects__container container">
            <h2 class="projects__title title">Recent Showcase</h2>

            <div class="projects__content">
                <a href="/" class="projects__button button">
                    <svg aria-hidden="true" viewBox="0 0 28 28" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <circle cx="14" cy="14" r="14"/>
                        <path d="M12 9L16.6667 13.6667L12 18.3333" stroke-width="1.55439" stroke-linecap="round" stroke-linejoin="round"/>
                    </svg>

                    Start your Free Trial
                </a>

                <ul class="projects__list">
                    <li class="projects__item">
                        <a href="/" class="project">
                            <div class="project__illustration">
                                <img src="<?php echo esc_url(get_theme_file_uri('/src/assets/images/project-web.png')); ?>" alt="">
                            </div>

                            <div class="project__content">
                                <h4 class="project__title">Web UI design</h4>
                                <p class="project__text">Creative  UI design</p>
                            </div>
                        </a>
                    </li>

                    <li class="projects__item">
                        <a href="/" class="project">
                            <div class="project__illustration">
                                <img src="<?php echo esc_url(get_theme_file_uri('/src/assets/images/project-strategy.png')); ?>" alt="">
                            </div>

                            <div class="project__content">
                                <h4 class="project__title">To design Digital Strategy</h4>
                                <p class="project__text">Social Media Marketing</p>
                            </div>
                        </a>
                    </li>

                    <li class="projects__item">
                        <a href="/" class="project">
                            <div class="project__illustration">
                                <img src="<?php echo esc_url(get_theme_file_uri('/src/assets/images/project-design.png')); ?>" alt="">
                            </div>

                            <div class="project__content">
                                <h4 class="project__title">UI Design</h4>
                                <p class="project__text">Creative Rebranding for logo</p>
                            </div>
                        </a>
                    </li>

                    <li class="projects__item">
                        <a href="/" class="project">
                            <div class="project__illustration">
                                <img src="<?php echo esc_url(get_theme_file_uri('/src/assets/images/project-ui.png')); ?>" alt="">
                            </div>

                            <div class="project__content">
                                <h4 class="project__title">UI Design</h4>
                                <p class="project__text">Creative Rebranding for logo</p>
                            </div>
                        </a>
                    </li>
                </ul>
            </div>
        </div>
    </section>

    <section class="testimonies">
        <div class="testimonies__container container">
            <ul id="testimonials-slider" class="testimonies__list"
            aria-roledescription="carousel"
            aria-label="Testimonials"
            tabindex="0">
                <li class="testimonies__item">
                    <div class="testimony">
                        <img src="<?php echo esc_url(get_theme_file_uri('/src/assets/images/project-web.png')); ?>" alt="" class="testimony__photo">

                        <blockquote class="testimony__quote">“Be genuine in your assessment, and provide constructive feedback to benefit both potential customers and the company providing the product or service.”</blockquote>

                        <div class="testimony__infos">
                            <p class="testimony__name">Jacqueline Miller</p>
                            <p class="testimony__position">CEO of an eduport</p>
                        </div>
                    </div>
                </li>
            </ul>

            <div class="testimonies__pagination">
                <button type="button"
                aria-label="Previous testimonial"
                aria-controls="testimonials-slider"
                data-slider-control="previous"
                disabled>
                    <svg aria-hidden="true" viewBox="0 0 10 17" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M0.833008 0.833496L8.23856 8.23905L0.833008 15.6446" stroke-opacity="0.9" stroke-width="1.66667" stroke-linecap="round" stroke-linejoin="round"/>
                    </svg>
                </button>

                <button type="button"
                aria-label="Next testimonial"
                aria-controls="testimonials-slider"
                data-slider-control="next">
                    <svg aria-hidden="true" viewBox="0 0 10 17" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M0.833008 0.833496L8.23856 8.23905L0.833008 15.6446" stroke-opacity="0.9" stroke-width="1.66667" stroke-linecap="round" stroke-linejoin="round"/>
                    </svg>
                </button>
            </div>
        </div>
    </section>
</main>

<?php get_footer(); ?>
