<?php
// Fichier: front-page.php
get_header();
?>

    <main id="site-content">
        <nav class="section-navigation">
            <ul class="section-menu">
                <li><a href="#welcome">Accueil</a></li>
                <li><a href="#languages">Langues</a></li>
                <li><a href="#skills">Compétences</a></li>
                <li><a href="#education">Formations</a></li>
                <li><a href="#experience">Expériences</a></li>
                <li><a href="#projects">Projets</a></li>
                <li><a href="#interests">Centres d'intérêt</a></li>
                <li><a href="#portfolio">Portfolio</a></li>
            </ul>
        </nav>

        <section id="welcome" class="terminal-welcome">
            <div class="terminal-header">
                <span class="command-line">root@portfolio:~# boot -v</span>
            </div>
            <div class="terminal-content">
                <div class="terminal-output">
                    <p>[OK] Initializing Portfolio...</p>
                    <p>[OK] Loading data...</p>
                    <div class="loading-bar"></div>
                </div>
                <h1 class="typing-effect">Portfolio <span class="cursor-blink"></span></h1>
                <p class="terminal-message">Daniil Minevich - Développeur Full Stack</p>
            </div>
        </section>

        <section id="languages" class="terminal-portfolio-section languages-section">
            <div class="terminal-header">
                <span class="command-line">root@portfolio:~# cat languages.txt</span>
            </div>
            <div class="terminal-content">
                <h2>Langues</h2>
                <?php if (have_rows('languages')) : ?>
                    <div class="languages-list">
                        <?php while (have_rows('languages')) : the_row(); ?>
                            <div class="language-item">
                                <?php echo esc_html(get_sub_field('language_name')); ?> (<?php echo esc_html(get_sub_field('language_level')); ?>)
                            </div>
                        <?php endwhile; ?>
                    </div>
                <?php else : ?>
                    <p class="terminal-message">ERROR: Aucune langue spécifiée.</p>
                <?php endif; ?>
            </div>
        </section>

        <section id="skills" class="terminal-portfolio-section skills-section">
            <div class="terminal-header">
                <span class="command-line">root@portfolio:~# ls -la /skills/</span>
            </div>
            <div class="terminal-content">
                <h2>Compétences</h2>
                <?php if (have_rows('skills')) : ?>
                    <div class="skills-grid">
                        <?php while (have_rows('skills')) : the_row(); ?>
                            <div class="skill-item">
                                <?php echo esc_html(get_sub_field('skill_name')); ?>
                            </div>
                        <?php endwhile; ?>
                    </div>
                <?php else : ?>
                    <p class="terminal-message">ERROR: Aucune compétence spécifiée.</p>
                <?php endif; ?>
            </div>
        </section>

        <section id="education" class="terminal-portfolio-section education-section">
            <div class="terminal-header">
                <span class="command-line">root@portfolio:~# more education.log</span>
            </div>
            <div class="terminal-content">
                <h2>Formations</h2>
                <?php if (have_rows('educations')) : ?>
                    <div class="education-list">
                        <?php while (have_rows('educations')) : the_row(); ?>
                            <div class="education-item">
                                <h3><?php echo esc_html(get_sub_field('education_title')); ?></h3>
                                <p><strong>Établissement :</strong> <?php echo esc_html(get_sub_field('education_institution')); ?></p>
                                <p><strong>Période :</strong> <?php echo esc_html(get_sub_field('education_period')); ?></p>
                                <?php if (get_sub_field('education_details')) : ?>
                                    <p><strong>Détails :</strong> <?php echo esc_html(get_sub_field('education_details')); ?></p>
                                <?php endif; ?>
                            </div>
                        <?php endwhile; ?>
                    </div>
                <?php else : ?>
                    <p class="terminal-message">ERROR: Aucune formation spécifiée.</p>
                <?php endif; ?>
            </div>
        </section>

        <section id="experience" class="terminal-portfolio-section experience-section">
            <div class="terminal-header">
                <span class="command-line">root@portfolio:~# cat experience.txt</span>
            </div>
            <div class="terminal-content">
                <h2>Expériences</h2>
                <?php if (have_rows('experiences')) : ?>
                    <div class="experience-list">
                        <?php while (have_rows('experiences')) : the_row(); ?>
                            <div class="experience-item">
                                <h3><?php echo esc_html(get_sub_field('experience_title')); ?> - <?php echo esc_html(get_sub_field('experience_company')); ?></h3>
                                <p><strong>Période :</strong> <?php echo esc_html(get_sub_field('experience_period')); ?></p>
                                <?php if (get_sub_field('experience_description')) : ?>
                                    <ul>
                                        <?php
                                        $description = explode("\n", get_sub_field('experience_description'));
                                        foreach ($description as $line) :
                                            if (trim($line)) :
                                                ?>
                                                <li><?php echo esc_html(trim($line)); ?></li>
                                            <?php endif; ?>
                                        <?php endforeach; ?>
                                    </ul>
                                <?php endif; ?>
                            </div>
                        <?php endwhile; ?>
                    </div>
                <?php else : ?>
                    <p class="terminal-message">ERROR: Aucune expérience spécifiée.</p>
                <?php endif; ?>
            </div>
        </section>

        <section id="projects" class="terminal-portfolio-section projects-section">
            <div class="terminal-header">
                <span class="command-line">root@portfolio:~# ls -la /projects/</span>
            </div>
            <div class="terminal-content">
                <h2>Projets</h2>
                <?php if (have_rows('projects')) : ?>
                    <div class="projects-list">
                        <?php while (have_rows('projects')) : the_row(); ?>
                            <div class="project-item">
                                <h3><?php echo esc_html(get_sub_field('project_title')); ?></h3>
                                <?php if (get_sub_field('project_description')) : ?>
                                    <ul>
                                        <?php
                                        $description = explode("\n", get_sub_field('project_description'));
                                        foreach ($description as $line) :
                                            if (trim($line)) :
                                                ?>
                                                <li><?php echo esc_html(trim($line)); ?></li>
                                            <?php endif; ?>
                                        <?php endforeach; ?>
                                    </ul>
                                <?php endif; ?>
                            </div>
                        <?php endwhile; ?>
                    </div>
                <?php else : ?>
                    <p class="terminal-message">ERROR: Aucun projet spécifié.</p>
                <?php endif; ?>
            </div>
        </section>

        <section id="interests" class="terminal-portfolio-section interests-section">
            <div class="terminal-header">
                <span class="command-line">root@portfolio:~# cat interests.txt</span>
            </div>
            <div class="terminal-content">
                <h2>Centres d'intérêt</h2>
                <?php if (have_rows('interests')) : ?>
                    <div class="interests-grid">
                        <?php while (have_rows('interests')) : the_row(); ?>
                            <div class="interest-item">
                                <?php echo esc_html(get_sub_field('interest_name')); ?>
                            </div>
                        <?php endwhile; ?>
                    </div>
                <?php else : ?>
                    <p class="terminal-message">ERROR: Aucun centre d'intérêt spécifié.</p>
                <?php endif; ?>
            </div>
        </section>

        <section id="portfolio" class="terminal-portfolio-section portfolio-section">
            <div class="terminal-header">
                <span class="command-line">root@portfolio:~# ls -la /portfolio/</span>
            </div>
            <div class="terminal-content">
                <h2>Portfolio</h2>
                <div class="category-filter">
                    <?php
                    $categories = get_terms(array(
                        'taxonomy' => 'portfolio_category',
                        'hide_empty' => true,
                    ));
                    if (!empty($categories) && !is_wp_error($categories)) :
                        echo '<div class="category-tags">';
                        echo '<span class="category-tag active" data-category="all">$ all</span>';
                        foreach ($categories as $category) :
                            echo '<span class="category-tag" data-category="' . esc_attr($category->slug) . '">$ ' . esc_html($category->name) . '</span>';
                        endforeach;
                        echo '</div>';
                    endif;
                    ?>
                </div>
                <div class="tech-filter">
                    <?php
                    $all_techs = array();
                    $args = array(
                        'post_type' => 'portfolio',
                        'posts_per_page' => -1,
                    );
                    $portfolio_query = new WP_Query($args);
                    while ($portfolio_query->have_posts()) : $portfolio_query->the_post();
                        if (function_exists('get_field') && $technologies = get_field('technologies')) {
                            foreach ($technologies as $tech) {
                                $tech_name = $tech['tech_name'];
                                if (!in_array($tech_name, $all_techs)) {
                                    $all_techs[] = $tech_name;
                                }
                            }
                        }
                    endwhile;
                    wp_reset_postdata();

                    if (!empty($all_techs)) :
                        echo '<div class="tech-tags">';
                        echo '<span class="tech-tag active" data-tech="all">$ all</span>';
                        foreach ($all_techs as $tech) :
                            echo '<span class="tech-tag" data-tech="' . esc_attr($tech) . '">$ ' . esc_html($tech) . '</span>';
                        endforeach;
                        echo '</div>';
                    endif;
                    ?>
                </div>
                <div class="portfolio-grid">
                    <?php
                    $args = array(
                        'post_type'      => 'portfolio',
                        'posts_per_page' => -1,
                        'orderby'        => 'date',
                        'order'          => 'DESC'
                    );
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
                                <div class="project-item">
                                    <?php if (has_post_thumbnail()) : ?>
                                        <div class="portfolio-image">
                                            <a href="<?php the_permalink(); ?>">
                                                <?php the_post_thumbnail('portfolio-thumbnail'); ?>
                                            </a>
                                        </div>
                                    <?php endif; ?>
                                    <div class="portfolio-details">
                                        <h3>
                                            <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
                                        </h3>
                                        <div class="portfolio-meta">
                                            <?php if (function_exists('get_field') && get_field('client')) : ?>
                                                <span class="meta-client"><strong>Client:</strong> <?php echo esc_html(get_field('client')); ?></span>
                                            <?php endif; ?>
                                            <?php if (function_exists('get_field') && get_field('date_realisation')) : ?>
                                                <span class="meta-date"><strong>Date:</strong> <?php echo esc_html(get_field('date_realisation')); ?></span>
                                            <?php endif; ?>
                                            <?php if ($terms && !is_wp_error($terms)) : ?>
                                                <div class="portfolio-categories">
                                                    <strong>Catégorie:</strong>
                                                    <?php foreach ($terms as $term) : ?>
                                                        <span class="category-tag"><?php echo esc_html($term->name); ?></span>
                                                    <?php endforeach; ?>
                                                </div>
                                            <?php endif; ?>
                                            <?php if (function_exists('get_field') && $technologies = get_field('technologies')) : ?>
                                                <div class="portfolio-technologies">
                                                    <strong>Tech:</strong>
                                                    <?php foreach ($technologies as $tech) : ?>
                                                        <span class="tech-tag"><?php echo esc_html($tech['tech_name']); ?></span>
                                                    <?php endforeach; ?>
                                                </div>
                                            <?php endif; ?>
                                        </div>
                                        <div class="portfolio-excerpt">
                                            <?php the_excerpt(); ?>
                                        </div>
                                        <?php if (function_exists('get_field') && get_field('project_url')) : ?>
                                            <a href="<?php echo esc_url(get_field('project_url')); ?>" class="portfolio-link" target="_blank">$ Lien du projet</a>
                                        <?php endif; ?>
                                        <a href="<?php the_permalink(); ?>" class="portfolio-more">Voir plus</a>
                                    </div>
                                </div>
                            </div>
                        <?php
                        endwhile;
                        wp_reset_postdata();
                    else :
                        echo '<p class="terminal-message">ERROR 404: Aucun projet disponible actuellement.</p>';
                    endif;
                    ?>
                </div>
            </div>
        </section>
    </main>
    <a href="#site-content" class="back-to-top">↑ Retour en haut</a>
<?php get_footer(); ?>