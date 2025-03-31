
# Portfolio - Daniil Minevich

![License](https://img.shields.io/badge/license-MIT-blue.svg)  
![WordPress](https://img.shields.io/badge/WordPress-6.7.2-blue.svg)  
![PHP](https://img.shields.io/badge/PHP-%3E%3D8.1-blue.svg)

Bienvenue sur le dépôt de mon portfolio personnel ! Ce projet est un site WordPress construit avec **Bedrock** (une structure moderne pour WordPress) et **Sage** (un thème starter avancé). Il met en avant mes compétences, mes projets, mes formations, et mes expériences professionnelles dans un design inspiré d'un terminal.

## 📖 Aperçu

Ce portfolio est conçu pour présenter mon parcours en tant que développeur full stack. Il inclut :
- Une page d'accueil avec des sections dynamiques (Langues, Compétences, Formations, Expériences, Projets, Centres d'intérêt).
- Un Custom Post Type (CPT) `portfolio` pour afficher mes projets, avec des filtres par catégorie.
- Une interface utilisateur stylée comme un terminal, avec des animations et une navigation fluide.

Le projet utilise **Advanced Custom Fields (ACF)** pour gérer les champs personnalisés et **Sage** pour un templating moderne avec Blade.

## 🚀 Fonctionnalités

- **Structure Bedrock** : Organisation moderne des dossiers et gestion des dépendances via Composer.
- **Thème Sage** : Templating avec Blade, compilation des assets avec Yarn/Webpack.
- **Custom Post Type** : Gestion des projets via un CPT `portfolio` avec taxonomie `portfolio_category`.
- **Champs ACF** : Champs personnalisés pour les projets (Client, Date, URL) et les sections de la page d'accueil.
- **Design Terminal** : Interface utilisateur inspirée d'un terminal avec animations (effet de frappe, barre de chargement).
- **Filtres dynamiques** : Filtrage des projets par catégorie.
- **Responsive** : Design adapté à tous les appareils.

## 📋 Prérequis

Avant de commencer, assurez-vous d'avoir les outils suivants installés :

- **PHP** : >= 8.1
- **Composer** : Pour gérer les dépendances PHP.
- **Node.js et Yarn** : Pour compiler les assets du thème Sage.
- **MySQL** : Pour la base de données WordPress.
- **Serveur local** : XAMPP, MAMP, ou tout autre serveur local (par exemple, Local by Flywheel).
- **Advanced Custom Fields Pro** : Nécessaire pour les champs avancés comme `gallery` et `repeater`. (Optionnel : version gratuite d'ACF avec des fonctionnalités limitées.)

## 🛠️ Installation

Suivez ces étapes pour installer et configurer le projet localement.

### 1. Cloner le dépôt
```bash
git clone https://github.com/ton-utilisateur/portfolio-daniil.git
cd portfolio-daniil
```

### 2. Installer les dépendances PHP
Assurez-vous que Composer est installé, puis exécutez :
```bash
composer install
```

### 3. Configurer l'environnement
1. Copie le fichier `.env.example` pour créer un fichier `.env` :
   ```bash
   cp .env.example .env
   ```
2. Modifie le fichier `.env` avec tes informations de base de données :
   ```
   DB_NAME=daniilp
   DB_USER=root
   DB_PASSWORD=
   DB_HOST=localhost

   WP_ENV=development
   WP_HOME=http://localhost/portfolio-daniil
   WP_SITEURL=${WP_HOME}/wp
   ```

### 4. Installer WordPress
1. Crée une base de données MySQL (par exemple, `portfolio_daniil`).
2. Accède à ton site dans un navigateur (par exemple, `http://localhost/portfolio-daniil`) et suis les instructions d'installation de WordPress.

### 5. Activer le thème Sage
1. Va dans l'admin WordPress (`http://localhost/portfolio-daniil/wp-admin`).
2. Va dans **Apparence > Thèmes** et active le thème Sage (par exemple, `nom-de-ton-thème`).

### 6. Compiler les assets du thème
Dans le dossier du thème (`web/app/themes/nom-de-ton-thème`), exécute :
```bash
cd web/app/themes/nom-de-ton-thème
yarn
yarn build
```

Pour travailler en mode développement avec rechargement automatique :
```bash
yarn start
```

### 7. Configurer ACF Pro (optionnel mais recommandé)
Ce projet utilise des champs avancés (comme `gallery` et `repeater`) qui nécessitent ACF Pro.
1. Ajoute le dépôt Composer pour ACF Pro dans `composer.json` :
   ```json
   "repositories": [
       {
           "type": "composer",
           "url": "https://wpackagist.org",
           "only": ["wpackagist-plugin/*", "wpackagist-theme/*"]
       },
       {
           "type": "composer",
           "url": "https://composer.advancedcustomfields.com"
       }
   ],
   ```
2. Ajoute tes identifiants dans `auth.json` :
   ```json
   {
       "http-basic": {
           "composer.advancedcustomfields.com": {
               "username": "ton-email@example.com",
               "password": "ta-cle-de-licence-acf-pro"
           }
       }
   }
   ```
3. Ajoute ACF Pro à `composer.json` :
   ```json
   "require": {
       "wp-premium/advanced-custom-fields-pro": "^6.3"
   }
   ```
4. Exécute :
   ```bash
   composer update
   ```

Si tu utilises la version gratuite d'ACF, certains champs (comme `gallery` et `repeater`) ne fonctionneront pas. Modifie `app/Fields/PortfolioFields.php` pour utiliser des champs simples (voir la documentation du projet).

### 8. Ajouter du contenu
1. Va dans **Portfolio > Ajouter un projet** pour créer des projets.
    - Exemple : Titre = "Site e-commerce", Client = "Entreprise XYZ", Date = "15/03/2024", URL = `https://example.com`.
2. Va dans **Pages > Toutes les pages**, édite la page d'accueil, et remplis les sections (Langues, Compétences, etc.).
    - Exemple : Langues = "Français - C2, Anglais - B2", Compétences = "PHP, JavaScript".

## 📂 Structure du projet

```
├── composer.json              # Dépendances PHP
├── web/                       # Dossier public
│   ├── app/                   # Plugins, thèmes, uploads
│   │   ├── plugins/           # Plugins WordPress
│   │   ├── themes/            # Thèmes WordPress
│   │   │   └── nom-de-ton-thème/  # Thème Sage
│   │   │       ├── app/       # Logique PHP (setup, champs ACF)
│   │   │       ├── resources/ # Assets (SCSS, JS, Blade)
│   │   │       └── public/    # Assets compilés
│   └── wp/                    # Core WordPress
├── .env                       # Variables d'environnement
└── vendor/                    # Dépendances Composer
```

## 🖥️ Développement

- **Ajouter des champs ACF** : Modifie `app/Fields/PortfolioFields.php` pour ajouter ou modifier des champs personnalisés.
- **Personnaliser le thème** : Édite les fichiers Blade dans `resources/views/` (par exemple, `front-page.blade.php`).
- **Compiler les assets** : Utilise `yarn build` ou `yarn start` pour recompiler les styles et scripts.

## 🤝 Contribuer

Les contributions sont les bienvenues ! Si tu veux contribuer :
1. Fork ce dépôt.
2. Crée une branche pour ta fonctionnalité (`git checkout -b feature/nouvelle-fonctionnalite`).
3. Commit tes changements (`git commit -m "Ajoute une nouvelle fonctionnalité"`).
4. Push ta branche (`git push origin feature/nouvelle-fonctionnalite`).
5. Ouvre une Pull Request.

## 📜 Licence

Ce projet est sous licence [MIT](LICENSE).

## 📧 Contact

- **Nom** : Daniil Minevich
