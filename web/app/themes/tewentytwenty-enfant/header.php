<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
    <meta charset="<?php bloginfo('charset'); ?>">
    <title><?php bloginfo('name'); ?> > <?php wp_title(); ?></title>
    <?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>
<header id="site-header" role="banner">
    <div class="header-inner">
        <div class="header-titles">
            <h1 class="site-title typing-effect"><?php bloginfo('name'); ?> <span class="cursor-blink"></span></h1>
            <div class="site-description"><?php bloginfo('description'); ?></div>
        </div>
        <div class="header-navigation-wrapper">
            <?php
            wp_nav_menu(array(
                'theme_location' => 'primary',
                'menu_id' => 'primary-menu',
                'container' => false,
            ));
            ?>
            <!-- Barre de recherche -->
            <div class="header-search">
                <?php get_search_form(); ?>
            </div>
        </div>
    </div>
</header>