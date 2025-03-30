<?php
// Fichier: single-portfolio.php
get_header();
?>

    <main id="site-content" role="main">
        <?php
        if (have_posts()) :
            while (have_posts()) : the_post();
                ?>
                <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
                    <div class="terminal-welcome">
                        <div class="terminal-header">
                            <div class="command-line">cat /portfolio/<?php echo sanitize_title(get_the_title()); ?>.md</div>
                        </div>

                        <div class="terminal-content">
                            <h1><?php the_title(); ?></h1>

                            <?php if (has_post_thumbnail()) : ?>
                                <div class="featured-media">
                                    <?php the_post_thumbnail('portfolio-full'); ?>
                                </div>
                            <?php endif; ?>

                            <div class="portfolio-meta">
                                <div class="terminal-command">
                                    <span class="prompt">root@portfolio:~# </span>ls -la /project-details/
                                </div>

                                <div class="terminal-response">
                                    <?php if (function_exists('get_field') && get_field('client')) : ?>
                                        <p><strong>Client:</strong> <?php echo get_field('client'); ?></p>
                                    <?php endif; ?>

                                    <?php if (function_exists('get_field') && get_field('date_realisation')) : ?>
                                        <p><strong>Date:</strong> <?php echo get_field('date_realisation'); ?></p>
                                    <?php endif; ?>

                                    <?php
                                    $categories = get_the_terms(get_the_ID(), 'portfolio_category');
                                    if ($categories && !is_wp_error($categories)) :
                                        ?>
                                        <p><strong>Catégories:</strong>
                                            <?php
                                            $cat_names = array();
                                            foreach ($categories as $category) {
                                                $cat_names[] = $category->name;
                                            }
                                            echo implode(', ', $cat_names);
                                            ?>
                                        </p>
                                    <?php endif; ?>

                                    <?php if (function_exists('get_field') && get_field('project_url')) : ?>
                                        <p><strong>URL:</strong> <a href="<?php echo get_field('project_url'); ?>" target="_blank"><?php echo get_field('project_url'); ?></a></p>
                                    <?php endif; ?>
                                </div>

                                <?php if (function_exists('get_field') && $technologies = get_field('technologies')) : ?>
                                    <div class="terminal-command">
                                        <span class="prompt">root@portfolio:~# </span>cat /project/technologies.json
                                    </div>

                                    <div class="terminal-response portfolio-technologies">
                                        <?php foreach ($technologies as $tech) : ?>
                                            <span class="tech-tag"><?php echo esc_html($tech['tech_name']); ?></span>
                                        <?php endforeach; ?>
                                    </div>
                                <?php endif; ?>
                            </div>

                            <div class="entry-content">
                                <div class="terminal-command">
                                    <span class="prompt">root@portfolio:~# </span>less /project/description.txt
                                </div>

                                <div class="terminal-response">
                                    <?php the_content(); ?>
                                </div>
                            </div>

                            <?php if (function_exists('get_field') && get_field('gallery')) : ?>
                                <div class="terminal-command">
                                    <span class="prompt">root@portfolio:~# </span>ls -la /project/images/
                                </div>

                                <div class="terminal-response portfolio-gallery">
                                    <?php
                                    $images = get_field('gallery');
                                    if ($images) : ?>
                                        <div class="portfolio-grid">
                                            <?php foreach ($images as $image) : ?>
                                                <div class="gallery-item">
                                                    <a href="<?php echo esc_url($image['url']); ?>" target="_blank">
                                                        <img src="<?php echo esc_url($image['sizes']['medium']); ?>" alt="<?php echo esc_attr($image['alt']); ?>">
                                                    </a>
                                                </div>
                                            <?php endforeach; ?>
                                        </div>
                                    <?php endif; ?>
                                </div>
                            <?php endif; ?>

                            <div class="terminal-command">
                                <span class="prompt">root@portfolio:~# </span>cd /portfolio/
                            </div>

                            <div class="navigation">
                                <div class="nav-previous"><?php previous_post_link('%link', '← Projet précédent'); ?></div>
                                <div class="nav-next"><?php next_post_link('%link', 'Projet suivant →'); ?></div>
                            </div>
                        </div>
                    </div>
                </article>
            <?php
            endwhile;
        endif;
        ?>
    </main>

<?php get_footer(); ?>