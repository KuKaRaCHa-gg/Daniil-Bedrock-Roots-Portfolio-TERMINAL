<?php
// Fichier: archive-portfolio.php
get_header();
?>

    <main id="site-content" role="main">
        <div class="terminal-welcome">
            <div class="terminal-header">
                <div class="command-line">ls -la /portfolio/</div>
            </div>

            <div class="terminal-content">
                <h1>Portfolio de projets</h1>

                <?php
                $terms = get_terms(array(
                    'taxonomy' => 'portfolio_category',
                    'hide_empty' => true,
                ));

                if ($terms && !is_wp_error($terms)) : ?>
                    <div class="terminal-command">
                        <span class="prompt">root@portfolio:~# </span>grep -r "categories" ./
                    </div>

                    <div class="portfolio-tabs">
                        <span class="portfolio-tab active" data-category="all">Tous</span>
                        <?php foreach ($terms as $term) : ?>
                            <span class="portfolio-tab" data-category="<?php echo esc_attr($term->slug); ?>"><?php echo esc_html($term->name); ?></span>
                        <?php endforeach; ?>
                    </div>
                <?php endif; ?>

                <div class="terminal-command">
                    <span class="prompt">root@portfolio:~# </span>find . -type f -name "*.project" | sort
                </div>

                <div class="portfolio-grid">
                    <?php
                    if (have_posts()) :
                        while (have_posts()) : the_post();
                            $post_terms = get_the_terms(get_the_ID(), 'portfolio_category');
                            $term_classes = '';

                            if ($post_terms && !is_wp_error($post_terms)) {
                                foreach ($post_terms as $term) {
                                    $term_classes .= ' category-' . $term->slug;
                                }
                            }
                            ?>
                            <div class="portfolio-item<?php echo esc_attr($term_classes); ?>">
                                <div class="project-item">
                                    <?php if (has_post_thumbnail()) : ?>
                                        <div class="portfolio-image">
                                            <a href="<?php the_permalink(); ?>">
                                                <?php the_post_thumbnail('portfolio-thumbnail'); ?>
                                            </a>
                                        </div>
                                    <?php endif; ?>

                                    <div class="portfolio-details">
                                        <h3><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>

                                        <div class="portfolio-meta">
                                            <?php if (function_exists('get_field') && get_field('client')) : ?>
                                                <span class="meta-client"><strong>Client:</strong> <?php echo get_field('client'); ?></span>
                                            <?php endif; ?>

                                            <?php if (function_exists('get_field') && get_field('date_realisation')) : ?>
                                                <span class="meta-date"><strong>Date:</strong> <?php echo get_field('date_realisation'); ?></span>
                                            <?php endif; ?>
                                        </div>

                                        <div class="portfolio-excerpt">
                                            <?php the_excerpt(); ?>
                                        </div>

                                        <?php if (function_exists('get_field') && $technologies = get_field('technologies')) : ?>
                                            <div class="portfolio-technologies">
                                                <?php foreach ($technologies as $tech) : ?>
                                                    <span class="tech-tag"><?php echo esc_html($tech['tech_name']); ?></span>
                                                <?php endforeach; ?>
                                            </div>
                                        <?php endif; ?>
                                    </div>
                                </div>
                            </div>
                        <?php
                        endwhile;

                        the_posts_pagination(array(
                            'prev_text' => 'cd ..',
                            'next_text' => 'cd -n',
                        ));

                    else :
                        ?>
                        <div class="terminal-response">
                            <p>find: No matches found. Aucun projet dans le portfolio pour le moment.</p>
                        </div>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </main>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const tabs = document.querySelectorAll('.portfolio-tab');
            const items = document.querySelectorAll('.portfolio-item');

            tabs.forEach(tab => {
                tab.addEventListener('click', function() {
                    tabs.forEach(t => t.classList.remove('active'));
                    this.classList.add('active');

                    const category = this.getAttribute('data-category');

                    items.forEach(item => {
                        if (category === 'all') {
                            item.style.display = 'block';
                        } else {
                            if (item.classList.contains('category-' + category)) {
                                item.style.display = 'block';
                            } else {
                                item.style.display = 'none';
                            }
                        }
                    });
                });
            });
        });
    </script>

<?php get_footer(); ?>