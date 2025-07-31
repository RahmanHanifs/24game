<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
    <meta charset="<?php bloginfo('charset'); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>

<header class="site-header">
    <div class="header-top">
        <div class="container">
            <div class="header-top-content">
                <div class="logo-section">
                    <?php if (has_custom_logo()) : ?>
                        <?php the_custom_logo(); ?>
                    <?php else : ?>
                        <img src="<?php echo get_template_directory_uri(); ?>/assets/images/logo-undip.png" alt="Logo Undip">
                    <?php endif; ?>
                    <div class="logo-text">
                        <h1>UNIVERSITAS DIPONEGORO</h1>
                        <h2>FAKULTAS HUKUM</h2>
                    </div>
                </div>
                
                <nav class="top-navigation">
                    <?php
                    wp_nav_menu(array(
                        'theme_location' => 'primary',
                        'menu_class' => 'top-menu',
                        'container' => false
                    ));
                    ?>
                </nav>
            </div>
        </div>
    </div>
    
    <div class="header-main">
        <div class="container">
            <nav class="main-navigation">
                <?php
                wp_nav_menu(array(
                    'theme_location' => 'secondary',
                    'menu_class' => 'main-menu',
                    'container' => false
                ));
                ?>
                <div class="search-toggle">
                    <button id="search-toggle" aria-label="Search">
                        <i class="fas fa-search"></i>
                    </button>
                </div>
            </nav>
        </div>
    </div>
    
    <div class="search-overlay" id="search-overlay">
        <div class="search-container">
            <?php get_search_form(); ?>
            <button class="search-close" id="search-close">&times;</button>
        </div>
    </div>
</header>

<div class="social-media-sidebar">
    <a href="#" class="social-link youtube" target="_blank">
        <i class="fab fa-youtube"></i>
    </a>
    <a href="https://instagram.com/badaneksekutifmahasiswa" class="social-link instagram" target="_blank">
        <i class="fab fa-instagram"></i>
    </a>
    <a href="#" class="social-link tiktok" target="_blank">
        <i class="fab fa-tiktok"></i>
    </a>
</div>
