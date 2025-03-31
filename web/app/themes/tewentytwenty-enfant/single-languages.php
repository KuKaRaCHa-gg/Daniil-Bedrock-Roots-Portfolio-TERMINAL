<?php
/**
 * Template pour l'affichage d'une langue individuelle
 *
 * @package Twenty_Twenty_Enfant_Terminal
 */
get_header();
?>

    <main id="site-content" role="main" class="retro-terminal">
        <?php if (have_posts()) : while (have_posts()) : the_post(); ?>
            <article id="post-<?php the_ID(); ?>" <?php post_class('terminal-welcome blink-border'); ?>>
                <div class="terminal-header">
                    <div class="command-line glitch">root@portfolio:~# cat /langues/<?php echo sanitize_title(get_the_title()); ?>.md</div>
                </div>
                <div class="terminal-content scanlines">
                    <h1 class="typing-effect glitch"><?php the_title(); ?> <span class="cursor-blink"></span></h1>
                    <?php if (has_post_thumbnail()) : ?>
                        <div class="featured-media neon-border">
                            <?php the_post_thumbnail('medium'); ?>
                        </div>
                    <?php endif; ?>
                    <div class="entry-content">
                        <?php the_content(); ?>
                    </div>
                    <div class="language-details retro-box">
                        <?php if ($language_level = get_field('language_level')) : ?>
                            <div class="language-level">
                                <h3 class="glitch">Niveau</h3>
                                <p><?php echo esc_html($language_level); ?></p>
                            </div>
                        <?php endif; ?>
                        <?php if ($certifications = get_field('certifications')) : ?>
                            <div class="language-certifications">
                                <h3 class="glitch">Certifications</h3>
                                <p><?php echo esc_html($certifications); ?></p>
                            </div>
                        <?php endif; ?>
                    </div>
                </div>
            </article>
        <?php endwhile; endif; ?>
    </main>

<?php get_footer(); ?>