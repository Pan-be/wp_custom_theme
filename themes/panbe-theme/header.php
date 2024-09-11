<!DOCTYPE html>
<html <?php language_attributes(); ?>>

<head>
    <meta charset="<?php bloginfo('charset'); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?php wp_head(); ?>
</head>

<body <?php body_class( !is_front_page() || is_home() ? 'sub_page' : '' ); ?>>
    <div style="min-height:100dvh; display:flex; flex-direction:column; justify-content:space-between;">
        <div class="hero_area">
            <!-- header section strats -->
            <header class="header_section">
                <div class="container-fluid">
                    <nav class="navbar navbar-expand-lg custom_nav-container pt-3">
                        <a class="navbar-brand" href="<?php echo site_url() ?>">
                            <span>
                                Esigned
                            </span>
                        </a>
                        <button class="navbar-toggler" type="button" data-toggle="collapse"
                            data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
                            aria-expanded="false" aria-label="Toggle navigation">
                            <span class="navbar-toggler-icon"></span>
                        </button>

                        <div class="collapse navbar-collapse" id="navbarSupportedContent">
                            <div class="d-flex ml-auto flex-column flex-lg-row align-items-center">
                                <!-- <ul class="navbar-nav  ">
                                <li class="nav-item active">
                                    <a class="nav-link" href="index.html">Home <span
                                            class="sr-only">(current)</span></a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="<?php echo site_url('/about') ?>"> About </a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="do.html"> What we do </a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="portfolio.html"> Portfolio </a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="contact.html">Contact us</a>
                                </li>
                            </ul> -->
                                <?php
                                wp_nav_menu(
                                    array('theme_location' => 'headerMenuLocation',
                                    'menu_class' => 'navbar-nav',
                                    'containter' => false,
                                    'walker' => new WP_Bootstrap_Navwalker())
                                );
                            ?>
                                <div class="user_option">
                                    <?php if(is_user_logged_in(  )) { ?>

                                    <a href=<?php echo esc_url(site_url('/my-notes')); ?>
                                        class="btn btn-warning text-white mr-2">My Notes</a>

                                    <a href="<?php echo wp_logout_url(); ?>" title="logout">
                                        <?php echo get_avatar(get_current_user_id(), 60); ?>
                                    </a>

                                    <?php } else { ?>
                                    <a href="<?php echo esc_url(site_url('/wp-login.php')); ?>"
                                        title="log in or sign in">
                                        <img src="<?php echo get_theme_file_uri( 'images/user.png' ) ?>" alt="">
                                    </a>

                                    <?php }
                                    
                                    ?>
                                    <div class="form-inline my-2 my-lg-0 ml-0 ml-lg-4 mb-3 mb-lg-0">
                                        <a href="<?php echo esc_url(site_url('/search')) ?>"
                                            class="btn my-2 my-sm-0 nav_search-btn" id="search"></a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </nav>
                </div>
            </header>
            <!-- end header section -->