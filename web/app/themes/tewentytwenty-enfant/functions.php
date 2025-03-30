<?php
// Fichier: functions.php
// Inclure le fichier du CPT Portfolio
require_once get_stylesheet_directory() . '/cpt-portfolio.php';

// Personnalisation de l'extrait "Lire la suite"
function twenty_twenty_enfant_excerpt_more($more) {
    return '... <a class="portfolio-more" href="' . get_permalink() . '">cd /voir-plus</a>';
}
add_filter('excerpt_more', 'twenty_twenty_enfant_excerpt_more');

// Configuration des champs personnalisés ACF
function register_portfolio_acf_fields() {
    if (function_exists('acf_add_local_field_group')) {
        // Groupe pour les projets (Portfolio)
        acf_add_local_field_group(array(
            'key' => 'group_portfolio_details',
            'title' => 'Détails du projet',
            'fields' => array(
                array(
                    'key' => 'field_client',
                    'label' => 'Client',
                    'name' => 'client',
                    'type' => 'text',
                    'instructions' => 'Nom du client',
                    'required' => 0,
                ),
                array(
                    'key' => 'field_date',
                    'label' => 'Date de réalisation',
                    'name' => 'date_realisation',
                    'type' => 'date_picker',
                    'instructions' => 'Date de réalisation du projet',
                    'required' => 0,
                    'display_format' => 'd/m/Y',
                    'return_format' => 'd/m/Y',
                ),
                array(
                    'key' => 'field_project_url',
                    'label' => 'Lien du projet',
                    'name' => 'project_url',
                    'type' => 'url',
                    'instructions' => 'URL du projet en ligne',
                    'required' => 0,
                ),
                array(
                    'key' => 'field_gallery',
                    'label' => 'Galerie',
                    'name' => 'gallery',
                    'type' => 'gallery',
                    'instructions' => 'Images du projet',
                    'required' => 0,
                    'min' => 0,
                    'max' => '',
                    'insert' => 'append',
                    'library' => 'all',
                ),
                array(
                    'key' => 'field_technologies',
                    'label' => 'Technologies utilisées',
                    'name' => 'technologies',
                    'type' => 'repeater',
                    'instructions' => 'Ajouter les technologies utilisées',
                    'required' => 0,
                    'min' => 0,
                    'max' => 0,
                    'layout' => 'table',
                    'button_label' => 'Ajouter une technologie',
                    'sub_fields' => array(
                        array(
                            'key' => 'field_tech_name',
                            'label' => 'Nom',
                            'name' => 'tech_name',
                            'type' => 'text',
                            'instructions' => '',
                            'required' => 1,
                        ),
                    ),
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
            'menu_order' => 0,
            'position' => 'normal',
            'style' => 'default',
            'label_placement' => 'top',
            'instruction_placement' => 'label',
            'hide_on_screen' => '',
        ));

        // Groupe pour les sections de la page d'accueil
        acf_add_local_field_group(array(
            'key' => 'group_portfolio_page',
            'title' => 'Sections du Portfolio',
            'fields' => array(
                // Langues
                array(
                    'key' => 'field_languages',
                    'label' => 'Langues',
                    'name' => 'languages',
                    'type' => 'repeater',
                    'instructions' => 'Ajouter les langues que vous parlez',
                    'required' => 0,
                    'min' => 0,
                    'max' => 0,
                    'layout' => 'table',
                    'button_label' => 'Ajouter une langue',
                    'sub_fields' => array(
                        array(
                            'key' => 'field_language_name',
                            'label' => 'Langue',
                            'name' => 'language_name',
                            'type' => 'text',
                            'instructions' => 'Nom de la langue (ex. Français)',
                            'required' => 1,
                        ),
                        array(
                            'key' => 'field_language_level',
                            'label' => 'Niveau',
                            'name' => 'language_level',
                            'type' => 'text',
                            'instructions' => 'Niveau de maîtrise (ex. Courant, A2)',
                            'required' => 1,
                        ),
                    ),
                ),
                // Compétences
                array(
                    'key' => 'field_skills',
                    'label' => 'Compétences',
                    'name' => 'skills',
                    'type' => 'repeater',
                    'instructions' => 'Ajouter vos compétences',
                    'required' => 0,
                    'min' => 0,
                    'max' => 0,
                    'layout' => 'table',
                    'button_label' => 'Ajouter une compétence',
                    'sub_fields' => array(
                        array(
                            'key' => 'field_skill_name',
                            'label' => 'Nom',
                            'name' => 'skill_name',
                            'type' => 'text',
                            'instructions' => 'Nom de la compétence (ex. Java)',
                            'required' => 1,
                        ),
                    ),
                ),
                // Centres d'intérêt
                array(
                    'key' => 'field_interests',
                    'label' => 'Centres d\'intérêt',
                    'name' => 'interests',
                    'type' => 'repeater',
                    'instructions' => 'Ajouter vos centres d\'intérêt',
                    'required' => 0,
                    'min' => 0,
                    'max' => 0,
                    'layout' => 'table',
                    'button_label' => 'Ajouter un centre d\'intérêt',
                    'sub_fields' => array(
                        array(
                            'key' => 'field_interest_name',
                            'label' => 'Nom',
                            'name' => 'interest_name',
                            'type' => 'text',
                            'instructions' => 'Nom du centre d\'intérêt (ex. Musculation)',
                            'required' => 1,
                        ),
                    ),
                ),
                // Formations
                array(
                    'key' => 'field_educations',
                    'label' => 'Formations',
                    'name' => 'educations',
                    'type' => 'repeater',
                    'instructions' => 'Ajouter vos formations',
                    'required' => 0,
                    'min' => 0,
                    'max' => 0,
                    'layout' => 'table',
                    'button_label' => 'Ajouter une formation',
                    'sub_fields' => array(
                        array(
                            'key' => 'field_education_title',
                            'label' => 'Titre',
                            'name' => 'education_title',
                            'type' => 'text',
                            'instructions' => 'Titre de la formation (ex. BUT Informatique)',
                            'required' => 1,
                        ),
                        array(
                            'key' => 'field_education_institution',
                            'label' => 'Établissement',
                            'name' => 'education_institution',
                            'type' => 'text',
                            'instructions' => 'Nom de l\'établissement (ex. IUT de Laval)',
                            'required' => 1,
                        ),
                        array(
                            'key' => 'field_education_period',
                            'label' => 'Période',
                            'name' => 'education_period',
                            'type' => 'text',
                            'instructions' => 'Période (ex. 2023 - Présent)',
                            'required' => 1,
                        ),
                        array(
                            'key' => 'field_education_details',
                            'label' => 'Détails',
                            'name' => 'education_details',
                            'type' => 'text',
                            'instructions' => 'Détails supplémentaires (ex. Mention Assez Bien)',
                            'required' => 0,
                        ),
                    ),
                ),
                // Expériences
                array(
                    'key' => 'field_experiences',
                    'label' => 'Expériences',
                    'name' => 'experiences',
                    'type' => 'repeater',
                    'instructions' => 'Ajouter vos expériences professionnelles',
                    'required' => 0,
                    'min' => 0,
                    'max' => 0,
                    'layout' => 'table',
                    'button_label' => 'Ajouter une expérience',
                    'sub_fields' => array(
                        array(
                            'key' => 'field_experience_title',
                            'label' => 'Titre',
                            'name' => 'experience_title',
                            'type' => 'text',
                            'instructions' => 'Titre de l\'expérience (ex. Stagiaire en administration informatique)',
                            'required' => 1,
                        ),
                        array(
                            'key' => 'field_experience_company',
                            'label' => 'Entreprise',
                            'name' => 'experience_company',
                            'type' => 'text',
                            'instructions' => 'Nom de l\'entreprise (ex. ESIÉA)',
                            'required' => 1,
                        ),
                        array(
                            'key' => 'field_experience_period',
                            'label' => 'Période',
                            'name' => 'experience_period',
                            'type' => 'text',
                            'instructions' => 'Période (ex. 2019)',
                            'required' => 1,
                        ),
                        array(
                            'key' => 'field_experience_description',
                            'label' => 'Description',
                            'name' => 'experience_description',
                            'type' => 'textarea',
                            'instructions' => 'Description des tâches (une tâche par ligne)',
                            'required' => 0,
                        ),
                    ),
                ),
                // Projets (non-CPT, pour la section "Projets")
                array(
                    'key' => 'field_projects',
                    'label' => 'Projets (non-CPT)',
                    'name' => 'projects',
                    'type' => 'repeater',
                    'instructions' => 'Ajouter vos projets (non liés au CPT Portfolio)',
                    'required' => 0,
                    'min' => 0,
                    'max' => 0,
                    'layout' => 'table',
                    'button_label' => 'Ajouter un projet',
                    'sub_fields' => array(
                        array(
                            'key' => 'field_project_title',
                            'label' => 'Titre',
                            'name' => 'project_title',
                            'type' => 'text',
                            'instructions' => 'Titre du projet',
                            'required' => 1,
                        ),
                        array(
                            'key' => 'field_project_description',
                            'label' => 'Description',
                            'name' => 'project_description',
                            'type' => 'textarea',
                            'instructions' => 'Description du projet (une ligne par tâche)',
                            'required' => 0,
                        ),
                    ),
                ),
            ),
            'location' => array(
                array(
                    array(
                        'param' => 'page_template',
                        'operator' => '==',
                        'value' => 'front-page.php',
                    ),
                ),
            ),
            'menu_order' => 0,
            'position' => 'normal',
            'style' => 'default',
            'label_placement' => 'top',
            'instruction_placement' => 'label',
            'hide_on_screen' => '',
        ));
    }
}
add_action('acf/init', 'register_portfolio_acf_fields');

// Enqueue styles and scripts
add_action('wp_enqueue_scripts', function () {
    wp_enqueue_style('tewentytwenty-enfant-style', get_stylesheet_uri());
    // Ajout d'un script pour le filtre par technologie
    wp_enqueue_script('portfolio-filter', get_stylesheet_directory_uri() . '/assets/js/portfolio-filter.js', array('jquery'), '1.0.0', true);
});

// Enregistrer un emplacement de menu pour le footer
function register_footer_menu() {
    register_nav_menu('footer', __('Footer Menu', 'twentytwenty-enfant-terminal'));
}
add_action('after_setup_theme', 'register_footer_menu');