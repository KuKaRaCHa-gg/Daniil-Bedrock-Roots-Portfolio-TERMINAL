<?php
get_header();
?>

<main id="site-content" class="retro-terminal">
    <!-- Navigation Sticky -->
    <nav class="section-navigation sticky-nav">
        <ul class="section-menu neon-effect">
            <li><a href="#portfolio" class="blink">Portfolio</a></li>
            <li><a href="#welcome">Accueil</a></li>
            <li><a href="#skills">Compétences</a></li>
            <li><a href="#experience">Expériences</a></li>
            <li><a href="#education">Formations</a></li>
            <li><a href="#languages">Langues</a></li>
            <li><a href="#interests">Centres d'intérêt</a></li>
            <li><a href="#contact">Contact</a></li>
        </ul>
    </nav>

    <!-- Welcome Section -->
    <section id="welcome" class="terminal-welcome">
        <div class="terminal-header">
            <span class="command-line">root@portfolio:~# whoami</span>
        </div>
        <div class="terminal-content scanlines">
            <div class="boot-sequence">
                <p>[OK] Initialisation du système...</p>
                <p>[OK] Chargement du profil...</p>
                <div class="loading-bar"></div>
            </div>
            <h1 class="typing-effect">Daniil Minevich <span class="cursor-blink"></span></h1>
            <p class="terminal-message">Développeur Full Stack - Codeur Retro</p>
        </div>
    </section>

    <!-- Portfolio en haut pour capter l'attention -->
    <section id="portfolio" class="terminal-portfolio-section portfolio-section">
        <div class="terminal-header">
            <span class="command-line">root@portfolio:~# dir /portfolio/</span>
        </div>
        <div class="terminal-content scanlines">
            <h2 class="typing-effect">Portfolio <span class="cursor-blink"></span></h2>
            <p class="terminal-message">Mes projets les plus marquants</p>

            <div class="category-filter">
                <?php
                $categories = get_terms(['taxonomy' => 'portfolio_category', 'hide_empty' => true]);
                if (!empty($categories) && !is_wp_error($categories)) :
                    echo '<div class="category-tags neon-effect">';
                    echo '<span class="category-tag active" data-category="all">$ all</span>';
                    foreach ($categories as $category) :
                        echo '<span class="category-tag" data-category="' . esc_attr($category->slug) . '">$ ' . esc_html($category->name) . '</span>';
                    endforeach;
                    echo '</div>';
                endif;
                ?>
            </div>

            <div class="portfolio-grid">
                <?php
                $args = ['post_type' => 'portfolio', 'posts_per_page' => 6, 'orderby' => 'date', 'order' => 'DESC'];
                $portfolio_query = new WP_Query($args);
                if ($portfolio_query->have_posts()) :
                    while ($portfolio_query->have_posts()) : $portfolio_query->the_post();
                        $tech_classes = '';
                        if (function_exists('get_field') && $technologies = get_field('technologies')) {
                            foreach ($technologies as $tech) {
                                $tech_classes .= ' tech-' . sanitize_title($tech['tech_name']);
                            }
                        }
                        $category_classes = '';
                        $terms = get_the_terms(get_the_ID(), 'portfolio_category');
                        if ($terms && !is_wp_error($terms)) {
                            foreach ($terms as $term) {
                                $category_classes .= ' category-' . $term->slug;
                            }
                        }
                        ?>
                        <div class="portfolio-item<?php echo esc_attr($tech_classes . $category_classes); ?>">
                            <div class="project-item retro-box">
                                <?php if (has_post_thumbnail()) : ?>
                                    <div class="portfolio-image">
                                        <a href="<?php the_permalink(); ?>" class="neon-border"><?php the_post_thumbnail('portfolio-thumbnail'); ?></a>
                                    </div>
                                <?php endif; ?>
                                <div class="portfolio-details">
                                    <h3><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
                                    <div class="portfolio-excerpt"><?php the_excerpt(); ?></div>
                                    <?php if ($code_snippet = get_field('code_snippet')) : ?>
                                        <div class="code-preview">
                                            <pre><code><?php echo esc_html(substr($code_snippet, 0, 100)) . '...'; ?></code></pre>
                                        </div>
                                    <?php endif; ?>
                                    <a href="<?php the_permalink(); ?>" class="portfolio-more neon-button">Voir plus</a>
                                </div>
                            </div>
                        </div>
                    <?php endwhile; wp_reset_postdata(); ?>
                    <div class="portfolio-more-link">
                        <a href="<?php echo get_post_type_archive_link('portfolio'); ?>" class="neon-button">$ Tous les projets</a>
                    </div>
                <?php else : ?>
                    <p class="terminal-message error">ERROR 404: Aucun projet disponible.</p>
                <?php endif; ?>
            </div>
        </div>
    </section>

    <!-- Compétences avec Code Exécutable -->
    <section id="skills" class="terminal-portfolio-section skills-section">
        <div class="terminal-header">
            <span class="command-line">root@portfolio:~# skills --list</span>
        </div>
        <div class="terminal-content scanlines">
            <h2>Compétences</h2>
            <?php
            $args = ['post_type' => 'competences', 'posts_per_page' => -1];
            $skills_query = new WP_Query($args);
            if ($skills_query->have_posts()) :
                echo '<div class="skills-grid">';
                while ($skills_query->have_posts()) : $skills_query->the_post();
                    ?>
                    <div class="skill-item retro-box">
                        <h3><?php the_title(); ?></h3>
                        <?php if (has_post_thumbnail()) : ?>
                            <div class="skill-thumbnail neon-border">
                                <?php the_post_thumbnail('thumbnail'); ?>
                            </div>
                        <?php endif; ?>
                        <?php if ($skill_code = get_field('skill_code')) : ?>
                            <div class="code-preview">
                                <pre><code><?php echo esc_html(substr($skill_code, 0, 100)) . '...'; ?></code></pre>
                            </div>
                        <?php endif; ?>
                        <a href="<?php the_permalink(); ?>" class="neon-button">Détails</a>
                    </div>
                <?php
                endwhile;
                echo '</div>';
                wp_reset_postdata();
            else :
                echo '<p class="terminal-message error">ERROR: Aucune compétence trouvée.</p>';
            endif;
            ?>
        </div>
    </section>

    <!-- Expériences -->
    <section id="experience" class="terminal-portfolio-section experience-section">
        <div class="terminal-header">
            <span class="command-line">root@portfolio:~# history -exp</span>
        </div>
        <div class="terminal-content scanlines">
            <h2>Expériences</h2>
            <?php
            $args = ['post_type' => 'experience', 'posts_per_page' => -1, 'orderby' => 'date', 'order' => 'DESC'];
            $experiences_query = new WP_Query($args);
            if ($experiences_query->have_posts()) :
                echo '<div class="experience-list">';
                while ($experiences_query->have_posts()) : $experiences_query->the_post();
                    ?>
                    <div class="experience-item retro-box">
                        <h3><?php the_title(); ?><?php if ($company = get_field('company')) echo ' - ' . esc_html($company); ?></h3>
                        <?php if ($position = get_field('position')) : ?>
                            <p><strong>Poste :</strong> <?php echo esc_html($position); ?></p>
                        <?php endif; ?>
                        <?php if ($period = get_field('period')) : ?>
                            <p><strong>Période :</strong> <?php echo esc_html($period); ?></p>
                        <?php endif; ?>
                        <div class="experience-content">
                            <?php the_content(); ?>
                        </div>
                        <?php if ($technologies = get_field('technologies')) : ?>
                            <div class="experience-technologies">
                                <h3>Technologies utilisées</h3>
                                <div class="technology-tags">
                                    <?php foreach ($technologies as $tech) : ?>
                                        <span class="tech-tag"><?php echo esc_html($tech['tech_name']); ?></span>
                                    <?php endforeach; ?>
                                </div>
                            </div>
                        <?php endif; ?>
                        <a href="<?php the_permalink(); ?>" class="neon-button">Détails</a>
                    </div>
                <?php
                endwhile;
                echo '</div>';
                wp_reset_postdata();
            else :
                echo '<p class="terminal-message error">ERROR: Aucune expérience trouvée.</p>';
            endif;
            ?>
        </div>
    </section>

    <!-- Formations -->
    <section id="education" class="terminal-portfolio-section education-section">
        <div class="terminal-header">
            <span class="command-line">root@portfolio:~# edu --details</span>
        </div>
        <div class="terminal-content scanlines">
            <h2>Formations</h2>
            <?php
            $args = ['post_type' => 'formation', 'posts_per_page' => -1, 'orderby' => 'date', 'order' => 'DESC'];
            $formations_query = new WP_Query($args);
            if ($formations_query->have_posts()) :
                echo '<div class="education-list">';
                while ($formations_query->have_posts()) : $formations_query->the_post();
                    ?>
                    <div class="education-item retro-box">
                        <h3><?php the_title(); ?></h3>
                        <?php if ($school = get_field('school')) : ?>
                            <p><strong>École/Institution :</strong> <?php echo esc_html($school); ?></p>
                        <?php endif; ?>
                        <?php if ($period = get_field('period')) : ?>
                            <p><strong>Période :</strong> <?php echo esc_html($period); ?></p>
                        <?php endif; ?>
                        <?php if ($diploma = get_field('diploma')) : ?>
                            <p><strong>Diplôme :</strong> <?php echo esc_html($diploma); ?></p>
                        <?php endif; ?>
                        <div class="education-content">
                            <?php the_content(); ?>
                        </div>
                        <a href="<?php the_permalink(); ?>" class="neon-button">Détails</a>
                    </div>
                <?php
                endwhile;
                echo '</div>';
                wp_reset_postdata();
            else :
                echo '<p class="terminal-message error">ERROR: Aucune formation trouvée.</p>';
            endif;
            ?>
        </div>
    </section>

    <!-- Langues -->
    <section id="languages" class="terminal-portfolio-section languages-section">
        <div class="terminal-header">
            <span class="command-line">root@portfolio:~# lang --list</span>
        </div>
        <div class="terminal-content scanlines">
            <h2>Langues</h2>
            <?php
            $args = ['post_type' => 'languages', 'posts_per_page' => -1];
            $languages_query = new WP_Query($args);
            if ($languages_query->have_posts()) :
                echo '<div class="languages-list retro-box">';
                while ($languages_query->have_posts()) : $languages_query->the_post();
                    ?>
                    <div class="language-item">
                        <h3><?php the_title(); ?></h3>
                        <?php if ($level = get_field('language_level')) : ?>
                            <p><strong>Niveau :</strong> <?php echo esc_html($level); ?></p>
                        <?php endif; ?>
                        <div class="language-content">
                            <?php the_content(); ?>
                        </div>
                    </div>
                <?php
                endwhile;
                echo '</div>';
                wp_reset_postdata();
            else :
                // Fallback aux champs ACF si aucun CPT n'est encore créé
                if (have_rows('languages')) :
                    echo '<div class="languages-list retro-box">';
                    while (have_rows('languages')) : the_row();
                        ?>
                        <div class="language-item">
                            <?php echo esc_html(get_sub_field('language_name')); ?>
                            (<?php echo esc_html(get_sub_field('language_level')); ?>)
                        </div>
                    <?php
                    endwhile;
                    echo '</div>';
                else :
                    echo '<p class="terminal-message error">ERROR: Aucune langue trouvée.</p>';
                endif;
            endif;
            ?>
        </div>
    </section>

    <!-- Centres d'intérêt -->
    <section id="interests" class="terminal-portfolio-section interests-section">
        <div class="terminal-header">
            <span class="command-line">root@portfolio:~# interests --all</span>
        </div>
        <div class="terminal-content scanlines">
            <h2>Centres d'intérêt</h2>
            <?php
            $args = ['post_type' => 'centre_interet', 'posts_per_page' => -1];
            $interests_query = new WP_Query($args);
            if ($interests_query->have_posts()) :
                echo '<div class="interests-grid">';
                while ($interests_query->have_posts()) : $interests_query->the_post();
                    ?>
                    <div class="interest-item retro-box">
                        <h3><?php the_title(); ?></h3>
                        <div class="interest-content">
                            <?php the_content(); ?>
                        </div>
                    </div>
                <?php
                endwhile;
                echo '</div>';
                wp_reset_postdata();
            else :
                // Fallback aux champs ACF si aucun CPT n'est encore créé
                if (have_rows('interests')) :
                    echo '<div class="interests-grid">';
                    while (have_rows('interests')) : the_row();
                        ?>
                        <div class="interest-item retro-box">
                            <?php echo esc_html(get_sub_field('interest_name')); ?>
                        </div>
                    <?php
                    endwhile;
                    echo '</div>';
                else :
                    echo '<p class="terminal-message error">ERROR: Aucun centre d\'intérêt trouvé.</p>';
                endif;
            endif;
            ?>
        </div>
    </section>

    <!-- Blog personnel -->
    <section id="blog" class="terminal-portfolio-section blog-section">
        <div class="terminal-header">
            <span class="command-line">root@portfolio:~# cat /blog/recent.md</span>
        </div>
        <div class="terminal-content scanlines">
            <h2>Blog personnel</h2>
            <?php
            $args = ['post_type' => 'blog_personnel', 'posts_per_page' => 3];
            $blog_query = new WP_Query($args);
            if ($blog_query->have_posts()) :
                echo '<div class="blog-posts">';
                while ($blog_query->have_posts()) : $blog_query->the_post();
                    ?>
                    <div class="blog-item retro-box">
                        <h3><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
                        <div class="post-meta">
                            <p class="post-date">Publié le <?php the_date(); ?></p>
                        </div>
                        <?php if (has_post_thumbnail()) : ?>
                            <div class="blog-thumbnail">
                                <a href="<?php the_permalink(); ?>" class="neon-border">
                                    <?php the_post_thumbnail('medium'); ?>
                                </a>
                            </div>
                        <?php endif; ?>
                        <div class="blog-excerpt"><?php the_excerpt(); ?></div>
                        <a href="<?php the_permalink(); ?>" class="neon-button">Lire la suite</a>
                    </div>
                <?php
                endwhile;
                echo '</div>';
                echo '<div class="blog-more-link">';
                echo '<a href="' . get_post_type_archive_link('blog_personnel') . '" class="neon-button">$ Tous les articles</a>';
                echo '</div>';
                wp_reset_postdata();
            else :
                echo '<p class="terminal-message error">ERROR: Aucun article de blog trouvé.</p>';
            endif;
            ?>
        </div>
    </section>

    <!-- Contact Section -->
    <section id="contact" class="terminal-portfolio-section contact-section">
        <div class="terminal-header">
            <span class="command-line">root@portfolio:~# contact --send</span>
        </div>
        <div class="terminal-content scanlines">
            <h2>Contact</h2>
            <div class="contact-box retro-box">
                <?php if ($contact_info = get_field('contact_info')) : ?>
                    <div class="contact-info-wrapper">
                        <p class="terminal-command"><span class="prompt">$</span> echo "Email: <a href="mailto:<?php echo esc_attr($contact_info['email']); ?>"><?php echo esc_html($contact_info['email']); ?></a>"</p>

                        <?php if (!empty($contact_info['phone'])) : ?>
                            <p class="terminal-command"><span class="prompt">$</span> echo "Téléphone: <?php echo esc_html($contact_info['phone']); ?>"</p>
                        <?php endif; ?>

                        <?php if (!empty($contact_info['linkedin'])) : ?>
                            <p class="terminal-command"><span class="prompt">$</span> echo "LinkedIn: <a href="<?php echo esc_url($contact_info['linkedin']); ?>" target="_blank">Profil LinkedIn</a>"</p>
                        <?php endif; ?>

                        <?php if (!empty($contact_info['github'])) : ?>
                            <p class="terminal-command"><span class="prompt">$</span> echo "GitHub: <a href="<?php echo esc_url($contact_info['github']); ?>" target="_blank">Profil GitHub</a>"</p>
                        <?php endif; ?>
                    </div>
                <?php endif; ?>

                <div class="contact-form-wrapper">
                    <p class="terminal-command"><span class="prompt">$</span> vim contact.form</p>
                    <?php
                    if (function_exists('ninja_forms_display')) {
                        ninja_forms_display(1); // Remplacer 1 par l'ID de votre formulaire
                    } elseif (shortcode_exists('contact-form-7')) {
                        echo do_shortcode('[contact-form-7 id="123" title="Formulaire de contact"]'); // Remplacer par l'ID de votre formulaire
                    } else {
                        echo '<p class="terminal-message">Formulaire de contact non disponible. Veuillez utiliser l\'adresse email ci-dessus.</p>';
                    }
                    ?>
                </div>
            </div>
        </div>
    </section>
</main>

<a href="#site-content" class="back-to-top neon-button">↑ Top</a>
<div id="flying-code"></div>

<script src="<?php echo get_stylesheet_directory_uri(); ?>/js/scripts.js"></script>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Activation des effets visuels
        initGlitchEffect();
        initLoadingBar();
        initFlyingCode();
        initBorderBlink();
        initCustomCursor();

        // Navigation fluide pour les liens d'ancrage
        document.querySelectorAll('.section-menu a').forEach(link => {
            link.addEventListener('click', function(e) {
                e.preventDefault();
                const target = document.querySelector(this.getAttribute('href'));
                if (target) {
                    window.scrollTo({
                        top: target.offsetTop - 60, // Ajuster pour la hauteur de la navigation
                        behavior: 'smooth'
                    });

                    // Mise à jour de l'URL sans recharger la page
                    history.pushState(null, null, this.getAttribute('href'));

                    // Actualisation des liens actifs
                    document.querySelectorAll('.section-menu a').forEach(a => a.classList.remove('active'));
                    this.classList.add('active');
                }
            });
        });

        // Activation du lien correspondant lors du défilement
        window.addEventListener('scroll', function() {
            const scrollPosition = window.scrollY;

            document.querySelectorAll('section[id]').forEach(section => {
                const sectionTop = section.offsetTop - 70;
                const sectionHeight = section.offsetHeight;

                if (scrollPosition >= sectionTop && scrollPosition < sectionTop + sectionHeight) {
                    const currentId = section.getAttribute('id');
                    document.querySelectorAll('.section-menu a').forEach(a => {
                        a.classList.remove('active');
                        if (a.getAttribute('href') === '#' + currentId) {
                            a.classList.add('active');
                        }
                    });
                }
            });
        });

        // Filtrage du portfolio
        document.querySelectorAll('.category-tag').forEach(tag => {
            tag.addEventListener('click', function() {
                const category = this.dataset.category;

                // Mise à jour des classes actives
                document.querySelectorAll('.category-tag').forEach(t => t.classList.remove('active'));
                this.classList.add('active');

                // Filtrage des projets
                const portfolioItems = document.querySelectorAll('.portfolio-item');
                if (category === 'all') {
                    portfolioItems.forEach(item => item.classList.remove('hidden'));
                } else {
                    portfolioItems.forEach(item => {
                        if (item.classList.contains('category-' + category)) {
                            item.classList.remove('hidden');
                        } else {
                            item.classList.add('hidden');
                        }
                    });
                }
            });
        });
    });
</script>

<?php get_footer(); ?>