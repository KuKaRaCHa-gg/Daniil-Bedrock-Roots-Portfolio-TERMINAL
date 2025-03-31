# Thème Rétro-Terminal - KuKaRaCHa7_gg

## Description
Ce projet est un thème enfant WordPress basé sur "Twenty Twenty", développé par Daniil Minevich (KuKaRaCHa7_gg) dans le cadre de mon BUT Informatique à l’IUT de Laval et de mes expériences professionnelles (stages chez ESIEA et ASGL Conseil). Le thème adopte un style rétro-terminal avec un fond noir, du texte vert néon (#00FF00), des animations glitch, et un curseur personnalisé. Il met en avant mes compétences, expériences, et portfolio.

## Structure des fichiers
```
twentytwenty-enfant-terminal/
├── js/
│   ├── portfolio-filter.js    # Filtrage dynamique du portfolio
│   ├── scripts.js            # Scripts généraux (inclut le curseur personnalisé)
│   └── terminal.js           # Animations rétro-terminal (code flottant)
├── archive-portfolio.php     # Archive pour le portfolio
├── cpt-portfolio.php         # Custom Post Type pour le portfolio
├── footer.php                # Pied de page personnalisé
├── front-page.php            # Page d'accueil personnalisée
├── functions.php             # Chargement des scripts, styles, et CPT
├── header.php                # En-tête personnalisé
├── single-blog_personnel.php # Template pour articles personnels
├── single-centre_interet.php # Template pour centres d'intérêt
├── single-competences.php    # Template pour compétences
├── single-experience.php     # Template pour expériences
├── single-formation.php      # Template pour formations
├── single-languages.php      # Template pour langages
├── single-portfolio.php      # Template pour projets portfolio
└── style.css                 # Styles rétro-terminal
```

### Détails des fichiers
1. **`js/portfolio-filter.js` (2704 octets)** :
   - Script pour filtrer dynamiquement les projets du portfolio (ex. par catégorie).
   - Utilisé sur `archive-portfolio.php` et `single-portfolio.php`.

2. **`js/scripts.js` (10092 octets)** :
   - Contient le curseur personnalisé avec traînée (vert néon).
   - Exemple clé : `initCustomCursor()` (voir "Installation").
   - Autres fonctionnalités générales du site.

3. **`js/terminal.js` (3895 octets)** :
   - Animations rétro : snippets de code flottants sur la page d’accueil.
   - Effets visuels inspirés des terminaux CRT.

4. **`archive-portfolio.php` (8535 octets)** :
   - Affiche une liste de projets portfolio avec filtres (lié à `portfolio-filter.js`).

5. **`cpt-portfolio.php` (13202 octets)** :
   - Définit un Custom Post Type (CPT) "Portfolio" pour gérer les projets.

6. **`footer.php` (3009 octets)** :
   - Pied de page personnalisé avec éléments rétro (ex. crédits).

7. **`front-page.php` (24504 octets)** :
   - Page d’accueil avec design rétro et animations (ex. code flottant).

8. **`functions.php` (22558 octets)** :
   - Charge les styles (`style.css`) et scripts JS (`scripts.js`, `portfolio-filter.js`, `terminal.js`).
   - Enregistre le CPT "Portfolio" via `cpt-portfolio.php`.

9. **`header.php` (1028 octets)** :
   - En-tête minimal avec styles rétro.

10. **`single-blog_personnel.php` (2013 octets)** :
    - Template pour articles personnels.

11. **`single-centre_interet.php` (1305 octets)** :
    - Template pour centres d’intérêt.

12. **`single-competences.php` (4485 octets)** :
    - Affiche mes compétences (ex. snippets Java, Python).

13. **`single-experience.php` (2754 octets)** :
    - Liste mes stages et TP (ESIEA, ASGL Conseil).

14. **`single-formation.php` (2066 octets)** :
    - Détaille ma formation (BUT Informatique).

15. **`single-languages.php` (2119 octets)** :
    - Présente les langages maîtrisés.

16. **`single-portfolio.php` (3223 octets)** :
    - Template pour un projet portfolio individuel.

17. **`style.css` (17842 octets)** :
    - Styles rétro : `--main-text: #00FF00`, animations (`glitch`, `neon-pulse`).

## Étapes réalisées
1. **Thème enfant** :
   - Création à partir de "Twenty Twenty" avec `style.css` et `functions.php`.
2. **Design rétro** :
   - Ajout de styles néon et animations dans `style.css`.
3. **Animations JS** :
   - `terminal.js` pour le code flottant, `scripts.js` pour le curseur.
4. **Portfolio** :
   - CPT via `cpt-portfolio.php`, affichage via `archive-portfolio.php` et `single-portfolio.php`.
5. **Templates personnalisés** :
   - Pages spécifiques pour compétences, expériences, etc., via les fichiers `single-*.php`.
6. **Intégration** :
   - Tests sur `http://localhost/DaniilP/web/wp/`.

## Difficultés rencontrées
1. **Perte du curseur** :
   - Code initial perdu, recréé dans `scripts.js` avec traînée.
2. **Chargement des scripts** :
   - `portfolio-filter.js` ne se chargeait pas ; résolu avec `wp_enqueue_script` dans `functions.php`.
3. **Performance** :
   - Animations lourdes sur `front-page.php` ; optimisées en réduisant les fréquences dans `terminal.js`.
4. **Templates multiples** :
   - Confusion entre templates (`single-competences.php`, `single-experience.php`, etc.) ; corrigée en nommant clairement chaque fichier.

## Installation et lancement
### Prérequis
- WordPress installé (ex. `http://localhost/DaniilP/web/wp/`).
- Thème "Twenty Twenty" actif comme parent.
- Serveur local (ex. XAMPP).

### Étapes
1. **Copier le thème** :
   - Placez le dossier `twentytwenty-enfant-terminal` dans `wp-content/themes/`.
2. **Activer le thème** :
   - Dans `wp-admin` > Apparence > Thèmes, activez "Twenty Twenty Enfant Terminal".
3. **Configurer `functions.php`** :
   - Assurez-vous que les scripts et styles sont chargés :
     ```php
     function twentytwenty_enfant_terminal_scripts() {
         wp_enqueue_style('child-style', get_stylesheet_uri(), array('twenty-twenty-style'), '1.0.0');
         wp_enqueue_script('scripts', get_stylesheet_directory_uri() . '/js/scripts.js', array(), '1.0.0', true);
         wp_enqueue_script('portfolio-filter', get_stylesheet_directory_uri() . '/js/portfolio-filter.js', array(), '1.0.0', true);
         wp_enqueue_script('terminal', get_stylesheet_directory_uri() . '/js/terminal.js', array(), '1.0.0', true);
     }
     add_action('wp_enqueue_scripts', 'twentytwenty_enfant_terminal_scripts');
     ```
4. **Créer les pages** :
   - Dans `wp-admin` > Pages > Ajouter, créez :
     - "Compétences" (modèle "Compétences").
     - "Expérience" (modèle "Expérience").
     - "Formation" (modèle "Formation").
     - "Languages" (modèle "Languages").
     - "Portfolio" (utilise `single-portfolio.php` et `archive-portfolio.php`).
     - Etc., selon vos templates.
   - Publiez chaque page.
5**Lancer le projet** :
   - Visitez `http://localhost/DaniilP/web/wp/` pour la page d’accueil.
   - Accédez aux permaliens des pages (ex. `http://localhost/DaniilP/web/wp/competences/`).

## Utilisation
- **Accueil** : Animations rétro (code flottant via `terminal.js`) et curseur personnalisé.
- **Portfolio** : Filtrage des projets avec `portfolio-filter.js`.
- **Autres pages** : Contenus structurés par templates personnalisés.

## Auteur
- **Daniil Minevich (KuKaRaCHa7_gg)**
- Contact : daniil.minevich2005@gmail.com


### Corrections apportées
1. **Ajout de `functions.php` dans "Détails des fichiers"** :
   - Il manquait dans votre version initiale (point 8 sauté).
2. **Étapes d’installation complétées** :
   - Ajout de l’étape 3 pour configurer `functions.php` avec tous les scripts JS.
   - Instructions précises pour créer les pages avec leurs modèles correspondants.
3. **Cohérence** :
   - Alignement des descriptions avec l’arborescence fournie (ex. tailles en octets conservées).

