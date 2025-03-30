<?php
// Fichier: web/app/themes/nom-de-ton-thème/app/setup.php

namespace App;

use Roots\Sage\Container;

add_action('init', function () {
    $labels = [
        'name'                  => 'Portfolio',
        'singular_name'         => 'Projet',
        'menu_name'             => 'Portfolio',
        'add_new'               => 'Ajouter un projet',
        'add_new_item'          => 'Ajouter un nouveau projet',
        'edit_item'             => 'Modifier le projet',
        'new_item'              => 'Nouveau projet',
        'view_item'             => 'Voir le projet',
        'search_items'          => 'Rechercher des projets',
        'not_found'             => 'Aucun projet trouvé',
        'not_found_in_trash'    => 'Aucun projet trouvé dans la corbeille',
        'all_items'             => 'Tous les projets',
    ];

    $args = [
        'labels'                => $labels,
        'public'                => true,
        'has_archive'           => true,
        'menu_icon'             => 'dashicons-portfolio',
        'menu_position'         => 5,
        'supports'              => ['title', 'editor', 'thumbnail', 'excerpt'],
        'rewrite'               => ['slug' => 'portfolio', 'with_front' => false],
        'show_in_rest'          => true,
    ];

    register_post_type('portfolio', $args);

    $category_labels = [
        'name'                  => 'Catégories de projet',
        'singular_name'         => 'Catégorie de projet',
        'search_items'          => 'Rechercher des catégories',
        'all_items'             => 'Toutes les catégories',
        'parent_item'           => 'Catégorie parente',
        'parent_item_colon'     => 'Catégorie parente:',
        'edit_item'             => 'Modifier la catégorie',
        'update_item'           => 'Mettre à jour la catégorie',
        'add_new_item'          => 'Ajouter une nouvelle catégorie',
        'new_item_name'         => 'Nom de la nouvelle catégorie',
        'menu_name'             => 'Catégories',
    ];

    $category_args = [
        'hierarchical'          => true,
        'labels'                => $category_labels,
        'show_ui'               => true,
        'show_admin_column'     => true,
        'query_var'             => true,
        'rewrite'               => ['slug' => 'categorie-projet'],
        'show_in_rest'          => true,
    ];

    register_taxonomy('portfolio_category', ['portfolio'], $category_args);
});

add_action('after_setup_theme', function () {
    add_theme_support('post-thumbnails');
    add_image_size('portfolio-thumbnail', 400, 300, true);
    add_image_size('portfolio-full', 1200, 800, false);
});

add_action('after_switch_theme', function () {
    flush_rewrite_rules();
});