<?php
/**
 * Fichier de fonctions pour le thème enfant Twenty Twenty Terminal
 *
 * @package Twenty_Twenty_Enfant_Terminal
 */

// Inclure le fichier du CPT Portfolio
require_once get_stylesheet_directory() . '/cpt-portfolio.php';

/**
 * Configuration du thème
 */
function twentytwenty_enfant_theme_setup() {
    // Enregistrer un emplacement de menu pour le footer
    register_nav_menu('footer', __('Menu Footer', 'twentytwenty-enfant-terminal'));

    // Ajouter le support des formats de post spécifiques
    add_theme_support('post-thumbnails');
    add_image_size('portfolio-thumbnail', 600, 400, true);
    add_image_size('portfolio-large', 1200, 800, false);
}
add_action('after_setup_theme', 'twentytwenty_enfant_theme_setup');

/**
 * Enqueue des styles et scripts
 */
function twentytwenty_enfant_enqueue_scripts() {
    // Styles
    wp_enqueue_style('twentytwenty-style', get_template_directory_uri() . '/style.css');
    wp_enqueue_style('twentytwenty-enfant-style', get_stylesheet_uri(), array('twentytwenty-style'), wp_get_theme()->get('Version'));

    // Scripts
    wp_enqueue_script('terminal-script', get_stylesheet_directory_uri() . '/js/terminal.js', array('jquery'), '1.0.0', true);
    wp_enqueue_script('portfolio-filter', get_stylesheet_directory_uri() . '/js/portfolio-filter.js', array('jquery'), '1.0.0', true);

    // Script pour l'animation de retour en haut de page
    wp_add_inline_script('terminal-script', '
        document.addEventListener("DOMContentLoaded", function() {
            // Bouton retour en haut
            const backToTopButton = document.querySelector(".back-to-top");
            if (backToTopButton) {
                window.addEventListener("scroll", function() {
                    if (window.scrollY > 300) {
                        backToTopButton.classList.add("visible");
                    } else {
                        backToTopButton.classList.remove("visible");
                    }
                });
                
                backToTopButton.addEventListener("click", function(e) {
                    e.preventDefault();
                    window.scrollTo({
                        top: 0,
                        behavior: "smooth"
                    });
                });
            }
        });
    ');
}
add_action('wp_enqueue_scripts', 'twentytwenty_enfant_enqueue_scripts');

/**
 * Personnalisation de l'extrait "Lire la suite"
 */
function twentytwenty_enfant_excerpt_more($more) {
    return '... <a class="portfolio-more" href="' . get_permalink() . '">cd /voir-plus</a>';
}
add_filter('excerpt_more', 'twentytwenty_enfant_excerpt_more');

/**
 * Modification de la longueur des extraits
 */
function twentytwenty_enfant_excerpt_length($length) {
    return 25; // Nombre de mots
}
add_filter('excerpt_length', 'twentytwenty_enfant_excerpt_length');

/**
 * Ajout d'une classe à l'élément de menu actif
 */
function twentytwenty_enfant_nav_class($classes, $item) {
    if (in_array('current-menu-item', $classes)) {
        $classes[] = 'active';
    }
    return $classes;
}
add_filter('nav_menu_css_class', 'twentytwenty_enfant_nav_class', 10, 2);

/**
 * Configuration des champs personnalisés ACF
 */
function register_portfolio_acf_fields() {
    if (!function_exists('acf_add_local_field_group')) {
        return;
    }

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
                'key' => 'field_github_url',
                'label' => 'Lien GitHub',
                'name' => 'github_url',
                'type' => 'url',
                'instructions' => 'URL du dépôt GitHub (si disponible)',
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
                    array(
                        'key' => 'field_skill_level',
                        'label' => 'Niveau',
                        'name' => 'skill_level',
                        'type' => 'range',
                        'instructions' => 'Niveau de maîtrise (1-100)',
                        'required' => 0,
                        'min' => 1,
                        'max' => 100,
                        'step' => 1,
                        'default_value' => 50,
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
                        'type' => 'textarea',
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
                    array(
                        'key' => 'field_project_link',
                        'label' => 'Lien du projet',
                        'name' => 'project_link',
                        'type' => 'url',
                        'instructions' => 'URL du projet (si disponible)',
                        'required' => 0,
                    ),
                ),
            ),
            // Information de contact
            array(
                'key' => 'field_contact_info',
                'label' => 'Informations de contact',
                'name' => 'contact_info',
                'type' => 'group',
                'instructions' => 'Vos informations de contact',
                'required' => 0,
                'sub_fields' => array(
                    array(
                        'key' => 'field_email',
                        'label' => 'Email',
                        'name' => 'email',
                        'type' => 'email',
                        'instructions' => 'Votre adresse email',
                        'required' => 0,
                    ),
                    array(
                        'key' => 'field_phone',
                        'label' => 'Téléphone',
                        'name' => 'phone',
                        'type' => 'text',
                        'instructions' => 'Votre numéro de téléphone',
                        'required' => 0,
                    ),
                    array(
                        'key' => 'field_linkedin',
                        'label' => 'LinkedIn',
                        'name' => 'linkedin',
                        'type' => 'url',
                        'instructions' => 'URL de votre profil LinkedIn',
                        'required' => 0,
                    ),
                    array(
                        'key' => 'field_github',
                        'label' => 'GitHub',
                        'name' => 'github',
                        'type' => 'url',
                        'instructions' => 'URL de votre profil GitHub',
                        'required' => 0,
                    ),
                ),
            ),
        ),
        'location' => array(
            array(
                array(
                    'param' => 'page_type',
                    'operator' => '==',
                    'value' => 'front_page',
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
add_action('acf/init', 'register_portfolio_acf_fields');

/**
 * Ajout de shortcodes personnalisés
 */
function terminal_command_shortcode($atts, $content = null) {
    $atts = shortcode_atts(array(
        'prompt' => 'root@portfolio:~#',
    ), $atts);

    return '<div class="terminal-command"><span class="prompt">' . esc_html($atts['prompt']) . '</span> ' . esc_html($content) . '</div>';
}
add_shortcode('terminal', 'terminal_command_shortcode');

/**
 * Personnalisation du thème pour l'admin
 */
function twentytwenty_enfant_admin_customization() {
    echo '<style>
        #adminmenu .wp-menu-image {
            filter: hue-rotate(120deg) brightness(1.2);
        }
        #wpadminbar {
            background-color: #002200;
        }
        .wp-core-ui .button-primary {
            background-color: #00BB00;
            border-color: #008800;
        }
        .wp-core-ui .button-primary:hover {
            background-color: #00CC00;
            border-color: #00AA00;
        }
    </style>';
}
add_action('admin_head', 'twentytwenty_enfant_admin_customization');

/**
 * Personnalisation de la page de connexion
 */
function twentytwenty_enfant_login_customization() {
    echo '<style>
        body.login {
            background-color: #000;
            font-family: "Courier New", Courier, monospace;
        }
        .login h1 a {
            background-image: none;
            padding-bottom: 10px;
            width: auto;
            height: auto;
            text-indent: 0;
            font-size: 24px;
            line-height: 1.5;
            font-weight: normal;
            color: #00FF00;
            text-decoration: none;
        }
        .login h1:before {
            content: "Terminal Login";
            display: block;
            text-align: center;
            font-family: "Courier New", Courier, monospace;
            color: #00FF00;
        }
        .login form {
            background-color: #002200;
            border: 1px solid #00FF00;
            box-shadow: 0 0 15px rgba(0, 255, 0, 0.2);
        }
        .login label {
            color: #00FF00;
        }
        .login input[type="text"], .login input[type="password"] {
            background-color: #000;
            border: 1px solid #00FF00;
            color: #00FF00;
            font-family: "Courier New", Courier, monospace;
        }
        .login .button.button-primary {
            background-color: #00FF00;
            border-color: #00CC00;
            color: #000;
            text-shadow: none;
            box-shadow: none;
        }
        .login .button.button-primary:hover {
            background-color: #00CC00;
        }
    </style>
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            document.title = "Terminal Login | ' . get_bloginfo('name') . '";
            var logo = document.querySelector(".login h1 a");
            if (logo) {
                logo.innerHTML = "$ ssh user@' . $_SERVER['HTTP_HOST'] . '";
                logo.href = "' . home_url() . '";
            }
        });
    </script>';
}
add_action('login_head', 'twentytwenty_enfant_login_customization');

/**
 * Utiliser le logo du thème à la place du logo WordPress
 */
function twentytwenty_enfant_login_logo_url() {
    return home_url();
}
add_filter('login_headerurl', 'twentytwenty_enfant_login_logo_url');

function twentytwenty_enfant_login_logo_title() {
    return 'Terminal - ' . get_bloginfo('name');
}
add_filter('login_headertext', 'twentytwenty_enfant_login_logo_title');