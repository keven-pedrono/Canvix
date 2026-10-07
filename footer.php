        <footer class="footer">
            <?php
                $locations = get_nav_menu_locations();
                $menu_pages = wp_get_nav_menu_object($locations['footer_pages']);
                $menu_utilities = wp_get_nav_menu_object($locations['footer_utilities']);

                $logo = get_theme_mod('custom_logo');
                $site_name = get_bloginfo('name');
                $excerpt = get_theme_mod('canvix_footer_excerpt');

                $copyright = get_theme_mod('canvix_footer_copyright');
                $address = get_theme_mod('canvix_footer_address');
                $phone = get_theme_mod('canvix_footer_phone', '');
                $phone_href = preg_replace('/[^0-9+]/', '', $phone);

                $facebook_url = get_theme_mod('canvix_footer_facebook_url', '');
                $instagram_url = get_theme_mod('canvix_footer_instagram_url', '');
                $linkedin_url = get_theme_mod('canvix_footer_linkedin_url', '');
            ?>

            <div class="footer__container container">
                <div class="footer__top">
                    <?php if (($logo && $site_name) || $excerpt) : ?>
                        <div class="footer__content">
                            <?php if ($logo && $site_name) : ?>
                                <a href="<?php echo esc_url(home_url('/')); ?>" class="footer__logo">
                                    <?php echo wp_get_attachment_image($logo, 'full', false, ['alt' => '',]);?>

                                    <span>
                                        <?php echo esc_html($site_name);?>
                                    </span>
                                </a>
                            <?php endif; ?>

                            <?php if ($excerpt) : ?>
                                <p class="footer__text"><?php echo esc_html($excerpt);?></p>
                            <?php endif; ?>
                        </div>
                    <?php endif; ?>

                    <?php if ($menu_pages) : ?>
                        <div class="footer__pages">
                            <h2 class="footer__title"><?php echo esc_html($menu_pages->name); ?></h2>

                            <?php
                                wp_nav_menu([
                                    'theme_location' => 'footer_pages',
                                    'container'      => false,
                                ]);
                            ?>
                        </div>
                    <?php endif; ?>

                    <?php if ($menu_utilities) : ?>
                        <div class="footer__utilities">
                            <h2 class="footer__title"><?php echo esc_html($menu_utilities->name); ?></h2>

                            <?php
                                wp_nav_menu([
                                    'theme_location' => 'footer_utilities',
                                    'container'      => false,
                                ]);
                            ?>
                        </div>
                    <?php endif; ?>

                    <div class="footer__subscribe">
                        <h2 class="footer__title">Subscribe</h2>

                        <form action="submit" class="footer__form">
                            <label for="footer-email">
                                <span class="visually-hidden">Adresse e-mail</span>

                                <input
                                    type="email"
                                    id="footer-email"
                                    name="email"
                                    autocomplete="email"
                                    required
                                    placeholder="Enter your email here"
                                />
                            </label>

                            <button type="submit" class="button">
                                Subscribe
                            </button>
                        </form>
                    </div>
                </div>

                <div class="footer__bottom">
                    <?php if ($copyright) : ?>
                        <div class="footer__copyright">
                            <h2 class="footer__title">Copyright by</h2>

                            <p>Designed by <?php echo esc_html($copyright);?></p>
                        </div>
                    <?php endif; ?>

                    <?php if ($phone) : ?>
                        <div class="footer__contact">
                            <h2 class="footer__title">Contact Us</h2>

                            <a href="<?php echo esc_attr('tel:' . $phone_href);?>"><?php echo esc_html($phone);?></a>
                        </div>
                    <?php endif; ?>

                    <?php if ($address) : ?>
                        <div class="footer__adress">
                            <h2 class="footer__title">Address</h2>

                            <address><?php echo esc_html($address);?></address>
                        </div>
                    <?php endif; ?>

                    <?php if ($facebook_url || $instagram_url || $linkedin_url) : ?>
                        <ul class="footer__socials">
                            <?php if ($facebook_url) : ?>
                                <li class="footer__social">
                                    <a href="<?php echo esc_url($facebook_url); ?>" target="_blank" rel="noopener noreferrer" aria-label="Facebook">
                                        <svg aria-hidden="true" viewBox="0 0 14 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                            <path d="M6.51 22.35H6.99C7.88994 22.35 8.3399 22.35 8.65534 22.1208C8.75722 22.0468 8.84681 21.9572 8.92082 21.8553C9.15 21.5399 9.15 21.0899 9.15 20.19V13.35H10.65C11.4927 13.35 11.914 13.35 12.2167 13.1478C12.3477 13.0602 12.4602 12.9477 12.5478 12.8167C12.75 12.514 12.75 12.0927 12.75 11.25C12.75 10.4073 12.75 9.98598 12.5478 9.68332C12.4602 9.55229 12.3477 9.43979 12.2167 9.35224C11.914 9.15 11.4927 9.15 10.65 9.15H9.15V6.75C9.15 6.19087 9.15 5.91131 9.24135 5.69078C9.36314 5.39675 9.59675 5.16314 9.89078 5.04134C10.1113 4.95 10.3909 4.95 10.95 4.95C11.5091 4.95 11.7887 4.95 12.0092 4.85866C12.3033 4.73686 12.5369 4.50325 12.6587 4.20922C12.75 3.98869 12.75 3.70913 12.75 3.15V2.61667C12.75 1.99487 12.75 1.68397 12.6376 1.44286C12.5183 1.18717 12.3128 0.981661 12.0571 0.86243C11.816 0.75 11.5051 0.75 10.8833 0.75C8.70703 0.75 7.61888 0.75 6.77501 1.14351C5.88009 1.56081 5.16081 2.28009 4.74351 3.175C4.35 4.01888 4.35 5.10703 4.35 7.28333V9.15H2.85C2.00732 9.15 1.58598 9.15 1.28332 9.35224C1.15229 9.43979 1.03979 9.55229 0.952236 9.68332C0.75 9.98598 0.75 10.4073 0.75 11.25C0.75 12.0927 0.75 12.514 0.952236 12.8167C1.03979 12.9477 1.15229 13.0602 1.28332 13.1478C1.58598 13.35 2.00732 13.35 2.85 13.35H4.35V20.19C4.35 21.0899 4.35 21.5399 4.57918 21.8553C4.6532 21.9572 4.74278 22.0468 4.84466 22.1208C5.1601 22.35 5.61006 22.35 6.51 22.35Z" stroke-width="1.5" stroke-linejoin="round"/>
                                        </svg>
                                    </a>
                                </li>
                            <?php endif; ?>

                            <?php if ($instagram_url) : ?>
                                <li class="footer__social">
                                    <a href="<?php echo esc_url($instagram_url); ?>" target="_blank" rel="noopener noreferrer" aria-label="Instagram">
                                        <svg aria-hidden="true" viewBox="0 0 25 25" fill="none" xmlns="http://www.w3.org/2000/svg">
                                            <path d="M19.3594 4.76025C19.7099 4.7603 19.9941 5.0445 19.9941 5.39502C19.9941 5.7455 19.7099 6.02974 19.3594 6.02979C19.0089 6.02979 18.7247 5.74553 18.7246 5.39502C18.7246 5.04447 19.0088 4.76025 19.3594 4.76025Z" stroke-width="1.26944"/>
                                            <path d="M0.952148 10.0922C0.952148 6.28409 0.952148 4.38006 1.92192 3.04528C2.23511 2.61421 2.61421 2.23511 3.04528 1.92192C4.38006 0.952148 6.28409 0.952148 10.0921 0.952148H14.6621C18.4702 0.952148 20.3742 0.952148 21.709 1.92192C22.1401 2.23511 22.5192 2.61421 22.8324 3.04528C23.8021 4.38006 23.8021 6.28409 23.8021 10.0921V14.6621C23.8021 18.4702 23.8021 20.3742 22.8324 21.709C22.5192 22.1401 22.1401 22.5192 21.709 22.8324C20.3742 23.8021 18.4702 23.8021 14.6622 23.8021H10.0922C6.28409 23.8021 4.38006 23.8021 3.04528 22.8324C2.61421 22.5192 2.23511 22.1401 1.92192 21.709C0.952148 20.3742 0.952148 18.4702 0.952148 14.6622V10.0922Z" stroke-width="1.90417" stroke-linejoin="round"/>
                                            <path d="M17.4549 12.3771C17.4549 15.1815 15.1815 17.4549 12.3771 17.4549C9.57277 17.4549 7.29937 15.1815 7.29937 12.3771C7.29937 9.57277 9.57277 7.29937 12.3771 7.29937C15.1815 7.29937 17.4549 9.57277 17.4549 12.3771Z "stroke-width="1.90417" stroke-linejoin="round"/>
                                        </svg>
                                    </a>
                                </li>
                            <?php endif; ?>

                            <?php if ($linkedin_url) : ?>
                                <li class="footer__social">
                                    <a href="<?php echo esc_url($linkedin_url); ?>" target="_blank" rel="noopener noreferrer" aria-label="LinkedIn">
                                        <svg aria-hidden="true" viewBox="0 0 25 25" fill="none" xmlns="http://www.w3.org/2000/svg">
                                            <path d="M10.843 10.2085V17.8252V14.5722C10.843 12.1622 12.7967 10.2085 15.2067 10.2085C16.6527 10.2085 17.8249 11.3807 17.8249 12.8267V17.8252M6.3999 10.2085V17.8252" stroke-width="1.375" stroke-linecap="round" stroke-linejoin="round"/>
                                            <path d="M7.66975 6.4003C7.66975 7.1014 7.1014 7.66975 6.4003 7.66975C5.69921 7.66975 5.13086 7.1014 5.13086 6.4003C5.13086 5.69921 5.69921 5.13086 6.4003 5.13086C7.1014 5.13086 7.66975 5.69921 7.66975 6.4003Z"/>
                                            <path d="M0.6875 7.28751C0.6875 4.5377 0.6875 3.16279 1.38777 2.19895C1.61393 1.88767 1.88767 1.61393 2.19895 1.38777C3.16279 0.6875 4.5377 0.6875 7.2875 0.6875H16.9375C19.6873 0.6875 21.0622 0.6875 22.026 1.38777C22.3373 1.61393 22.6111 1.88767 22.8372 2.19895C23.5375 3.16279 23.5375 4.5377 23.5375 7.2875V16.9375C23.5375 19.6873 23.5375 21.0622 22.8372 22.026C22.6111 22.3373 22.3373 22.6111 22.026 22.8372C21.0622 23.5375 19.6873 23.5375 16.9375 23.5375H7.28751C4.5377 23.5375 3.16279 23.5375 2.19895 22.8372C1.88767 22.6111 1.61393 22.3373 1.38777 22.026C0.6875 21.0622 0.6875 19.6873 0.6875 16.9375V7.28751Z"stroke-width="1.375" stroke-linejoin="round"/>
                                        </svg>
                                    </a>
                                </li>
                            <?php endif; ?>
                        </ul>
                    <?php endif; ?>
                </div>
            </div>
        </footer>

        <?php wp_footer(); ?>

    </body>
</html>
