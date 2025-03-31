<?php
/**
 * Template pour l'archive des projets du portfolio
 *
 * @package Twenty_Twenty_Enfant_Terminal
 */

get_header();
?>

    <main id="site-content" class="retro-terminal">
        <section class="terminal-portfolio-section portfolio-archive-section">
            <div class="terminal-header">
                <span class="command-line">root@portfolio:~# ls -la /portfolio/</span>
            </div>
            <div class="terminal-content scanlines">
                <h1 class="typing-effect">Projets <span class="cursor-blink"></span></h1>

                <?php if (have_posts()) : ?>
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
                        <?php while (have_posts()) : the_post();
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
                                            <a href="<?php the_permalink(); ?>" class="neon-border">
                                                <?php the_post_thumbnail('portfolio-thumbnail'); ?>
                                            </a>
                                        </div>
                                    <?php endif; ?>
                                    <div class="portfolio-details">
                                        <h3><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>

                                        <?php if (function_exists('get_field')) : ?>
                                            <div class="portfolio-meta">
                                                <?php if ($client = get_field('client')) : ?>
                                                    <span class="portfolio-client">Client: <?php echo esc_html($client); ?></span>
                                                <?php endif; ?>

                                                <?php if ($date = get_field('date_realisation')) : ?>
                                                    <span class="portfolio-date">Date: <?php echo esc_html($date); ?></span>
                                                <?php endif; ?>
                                            </div>

                                            <?php if ($technologies = get_field('technologies')) : ?>
                                                <div class="portfolio-technologies">
                                                    <?php foreach ($technologies as $tech) : ?>
                                                        <span class="tech-tag"><?php echo esc_html($tech['tech_name']); ?></span>
                                                    <?php endforeach; ?>
                                                </div>
                                            <?php endif; ?>
                                        <?php endif; ?>

                                        <div class="portfolio-excerpt"><?php the_excerpt(); ?></div>

                                        <?php if (function_exists('get_field') && $code_snippet = get_field('code_snippet')) : ?>
                                            <div class="code-preview">
                                                <pre><code><?php echo esc_html(substr($code_snippet, 0, 100)) . '...'; ?></code></pre>
                                            </div>
                                        <?php endif; ?>

                                        <a href="<?php the_permalink(); ?>" class="portfolio-more neon-button">Voir plus</a>
                                    </div>
                                </div>
                            </div>
                        <?php endwhile; ?>
                    </div>

                    <div class="terminal-pagination">
                        <?php
                        echo '<div class="pagination-command">';
                        echo '<span class="prompt">root@portfolio:~#</span> pagination --page ';

                        echo paginate_links([
                            'prev_text' => '<span class="prev">←</span>',
                            'next_text' => '<span class="next">→</span>',
                            'type' => 'plain',
                            'before_page_number' => '<span class="page-number">',
                            'after_page_number' => '</span>',
                        ]);

                        echo '</div>';
                        ?>
                    </div>
                <?php else : ?>
                    <p class="terminal-message error">ERROR 404: Aucun projet disponible actuellement.</p>
                    <div class="terminal-command">
                        <span class="prompt">root@portfolio:~#</span> Essayez de revenir plus tard ou consultez <a href="<?php echo esc_url(home_url('/')); ?>">la page d'accueil</a>.
                    </div>
                <?php endif; ?>
            </div>
        </section>
    </main>

    <a href="#site-content" class="back-to-top neon-button">↑ Top</a>
    <div id="flying-code"></div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Filtrage par catégorie
            const categoryTags = document.querySelectorAll('.category-tag');
            categoryTags.forEach(tag => {
                tag.addEventListener('click', function() {
                    const category = this.dataset.category;

                    // Mise à jour des classes actives
                    categoryTags.forEach(t => t.classList.remove('active'));
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

            // Initialisation des effets
            initGlitchEffect();
            initFlyingCode();
            initBorderBlink();
            initCustomCursor();
        });
    </script>

<?php get_footer(); ?>