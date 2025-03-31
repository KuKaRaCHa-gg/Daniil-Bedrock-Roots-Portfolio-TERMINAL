<?php
namespace App;

function register_custom_post_types() {
    $post_types = [
        'portfolio' => [
            'labels' => [
                'name'          => 'Portfolio',
                'singular_name' => 'Projet',
                'menu_name'     => 'Portfolio',
                'add_new'       => 'Ajouter un projet',
                'add_new_item'  => 'Ajouter un nouveau projet',
                'edit_item'     => 'Modifier le projet',
                'view_item'     => 'Voir le projet',
                'all_items'     => 'Tous les projets',
            ],
            'args' => [
                'public'       => true,
                'has_archive'  => true,
                'supports'     => ['title', 'editor', 'thumbnail', 'excerpt'],
                'rewrite'      => ['slug' => 'portfolio'],
                'show_in_rest' => true,
                'menu_icon'    => 'dashicons-portfolio',
            ],
            'taxonomies' => [
                'portfolio_category' => [
                    'labels' => [
                        'name'          => 'Catégories de projet',
                        'singular_name' => 'Catégorie de projet',
                        'menu_name'     => 'Catégories',
                    ],
                    'args' => [
                        'hierarchical'      => true,
                        'show_ui'           => true,
                        'show_admin_column' => true,
                        'query_var'         => true,
                        'rewrite'           => ['slug' => 'categorie-projet'],
                        'show_in_rest'      => true,
                    ]
                ],
            ],
        ],
        'competences' => [
            'labels' => [
                'name'          => 'Compétences',
                'singular_name' => 'Compétence',
                'menu_name'     => 'Compétences',
            ],
            'args' => [
                'public'       => true,
                'has_archive'  => true,
                'supports'     => ['title', 'editor', 'thumbnail'],
                'rewrite'      => ['slug' => 'competences'],
                'show_in_rest' => true,
                'menu_icon'    => 'dashicons-hammer',
            ],
        ],
        'languages' => [
            'labels' => [
                'name'          => 'Langues',
                'singular_name' => 'Langue',
                'menu_name'     => 'Langues',
            ],
            'args' => [
                'public'       => true,
                'has_archive'  => true,
                'supports'     => ['title', 'editor'],
                'rewrite'      => ['slug' => 'langues'],
                'show_in_rest' => true,
                'menu_icon'    => 'dashicons-translation',
            ],
        ],
        'centre_interet' => [
            'labels' => [
                'name'          => 'Centres d\'intérêt',
                'singular_name' => 'Centre d\'intérêt',
                'menu_name'     => 'Centres d\'intérêt',
            ],
            'args' => [
                'public'       => true,
                'has_archive'  => false,
                'supports'     => ['title', 'editor'],
                'rewrite'      => ['slug' => 'centres-interet'],
                'show_in_rest' => true,
                'menu_icon'    => 'dashicons-heart',
            ],
        ],
        'formation' => [
            'labels' => [
                'name'          => 'Formations',
                'singular_name' => 'Formation',
                'menu_name'     => 'Formations',
            ],
            'args' => [
                'public'       => true,
                'has_archive'  => false,
                'supports'     => ['title', 'editor'],
                'rewrite'      => ['slug' => 'formations'],
                'show_in_rest' => true,
                'menu_icon'    => 'dashicons-welcome-learn-more',
            ],
        ],
        'experience' => [
            'labels' => [
                'name'          => 'Expériences',
                'singular_name' => 'Expérience',
                'menu_name'     => 'Expériences',
            ],
            'args' => [
                'public'       => true,
                'has_archive'  => false,
                'supports'     => ['title', 'editor'],
                'rewrite'      => ['slug' => 'experiences'],
                'show_in_rest' => true,
                'menu_icon'    => 'dashicons-businessperson',
            ],
        ],
        'info_personnel' => [
            'labels' => [
                'name'          => 'Informations personnelles',
                'singular_name' => 'Information personnelle',
                'menu_name'     => 'Infos perso',
            ],
            'args' => [
                'public'       => false,
                'has_archive'  => false,
                'supports'     => ['title', 'editor'],
                'rewrite'      => ['slug' => 'infos-personnelles'],
                'show_in_rest' => true,
                'menu_icon'    => 'dashicons-id',
            ],
        ],
        'blog_personnel' => [
            'labels' => [
                'name'          => 'Blog personnel',
                'singular_name' => 'Article de blog',
                'menu_name'     => 'Blog perso',
            ],
            'args' => [
                'public'       => true,
                'has_archive'  => true,
                'supports'     => ['title', 'editor', 'thumbnail'],
                'rewrite'      => ['slug' => 'blog'],
                'show_in_rest' => true,
                'menu_icon'    => 'dashicons-edit',
            ],
        ],
    ];

    foreach ($post_types as $post_type => $data) {
        $labels = array_merge(
            ['menu_name' => $data['labels']['name']],
            $data['labels']
        );
        $args = array_merge(
            $data['args'],
            ['labels' => $labels]
        );
        register_post_type($post_type, $args);

        if (isset($data['taxonomies'])) {
            foreach ($data['taxonomies'] as $taxonomy => $tax_data) {
                register_taxonomy(
                    $taxonomy,
                    $post_type,
                    array_merge(
                        $tax_data['args'],
                        ['labels' => $tax_data['labels']]
                    )
                );
            }
        }
    }
}

add_action('init', __NAMESPACE__ . '\\register_custom_post_types');

// Ajout de champs ACF pour Portfolio et Compétences
function register_cpt_acf_fields() {
    if (!function_exists('acf_add_local_field_group')) {
        return;
    }

    // Groupe pour Portfolio (inchangé)
    acf_add_local_field_group(array(
        'key' => 'group_portfolio_details',
        'title' => 'Détails du projet',
        'fields' => array(
            array(
                'key' => 'field_client',
                'label' => 'Client',
                'name' => 'client',
                'type' => 'text',
            ),
            array(
                'key' => 'field_date',
                'label' => 'Date de réalisation',
                'name' => 'date_realisation',
                'type' => 'date_picker',
                'display_format' => 'd/m/Y',
                'return_format' => 'd/m/Y',
            ),
            array(
                'key' => 'field_project_url',
                'label' => 'Lien du projet',
                'name' => 'project_url',
                'type' => 'url',
            ),
            array(
                'key' => 'field_technologies',
                'label' => 'Technologies utilisées',
                'name' => 'technologies',
                'type' => 'repeater',
                'sub_fields' => array(
                    array(
                        'key' => 'field_tech_name',
                        'label' => 'Nom',
                        'name' => 'tech_name',
                        'type' => 'text',
                    ),
                ),
            ),
            array(
                'key' => 'field_code_snippet',
                'label' => 'Code Exécutable',
                'name' => 'code_snippet',
                'type' => 'textarea',
                'instructions' => 'Ajoutez du code HTML, CSS ou JS à exécuter (pas de PHP).',
                'rows' => 6,
            ),
        ),
        'location' => array(
            array(
                array(
                    'param' => 'post_type',
                    'operator' => '==',
                    'value' => 'portfolio',
                ),
            ),
        ),
    ));

    // Groupe pour Compétences (sans le champ skill_level)
    acf_add_local_field_group(array(
        'key' => 'group_competences_details',
        'title' => 'Détails de la compétence',
        'fields' => array(
            array(
                'key' => 'field_skill_code',
                'label' => 'Code Exécutable',
                'name' => 'skill_code',
                'type' => 'textarea',
                'instructions' => 'Ajoutez du code HTML, CSS, JS ou autre pour démontrer la compétence.',
                'rows' => 6,
            ),
        ),
        'location' => array(
            array(
                array(
                    'param' => 'post_type',
                    'operator' => '==',
                    'value' => 'competences',
                ),
            ),
        ),
    ));
}
add_action('acf/init', __NAMESPACE__ . '\\register_cpt_acf_fields');

// Colonnes d'administration pour Portfolio (inchangé)
function customize_portfolio_admin_columns($columns) {
    $new_columns = [
        'cb' => $columns['cb'],
        'title' => $columns['title'],
        'thumbnail' => 'Image',
        'client' => 'Client',
        'date_realisation' => 'Date de réalisation',
        'portfolio_category' => 'Catégories',
        'technologies' => 'Technologies',
        'code_snippet' => 'Code',
        'date' => $columns['date'],
    ];
    return $new_columns;
}
add_filter('manage_portfolio_posts_columns', __NAMESPACE__ . '\\customize_portfolio_admin_columns');

function display_portfolio_custom_columns($column, $post_id) {
    switch ($column) {
        case 'thumbnail':
            if (has_post_thumbnail($post_id)) {
                echo get_the_post_thumbnail($post_id, [50, 50]);
            } else {
                echo 'Aucune image';
            }
            break;
        case 'client':
            echo esc_html(get_field('client', $post_id) ?: '—');
            break;
        case 'date_realisation':
            echo esc_html(get_field('date_realisation', $post_id) ?: '—');
            break;
        case 'portfolio_category':
            $terms = get_the_terms($post_id, 'portfolio_category');
            if ($terms && !is_wp_error($terms)) {
                $term_names = array_map(function($term) {
                    return esc_html($term->name);
                }, $terms);
                echo implode(', ', $term_names);
            } else {
                echo '—';
            }
            break;
        case 'technologies':
            if ($technologies = get_field('technologies', $post_id)) {
                $tech_names = array_map(function($tech) {
                    return esc_html($tech['tech_name']);
                }, $technologies);
                echo implode(', ', $tech_names);
            } else {
                echo '—';
            }
            break;
        case 'code_snippet':
            $code = get_field('code_snippet', $post_id);
            echo $code ? '<pre>' . esc_html(substr($code, 0, 50)) . '...</pre>' : '—';
            break;
    }
}
add_action('manage_portfolio_posts_custom_column', __NAMESPACE__ . '\\display_portfolio_custom_columns', 10, 2);

// Colonnes d'administration pour Compétences (mise à jour pour supprimer skill_level)
function customize_competences_admin_columns($columns) {
    $new_columns = [
        'cb' => $columns['cb'],
        'title' => $columns['title'],
        'thumbnail' => 'Image',
        'skill_code' => 'Code',
        'date' => $columns['date'],
    ];
    return $new_columns;
}

function display_competences_custom_columns($column, $post_id) {
    switch ($column) {
        case 'thumbnail':
            if (has_post_thumbnail($post_id)) {
                echo get_the_post_thumbnail($post_id, [50, 50]);
            } else {
                echo 'Aucune image';
            }
            break;
        case 'skill_code':
            $code = get_field('skill_code', $post_id);
            echo $code ? '<pre>' . esc_html(substr($code, 0, 50)) . '...</pre>' : '—';
            break;
    }
}
add_action('manage_competences_posts_custom_column', __NAMESPACE__ . '\\display_competences_custom_columns', 10, 2);