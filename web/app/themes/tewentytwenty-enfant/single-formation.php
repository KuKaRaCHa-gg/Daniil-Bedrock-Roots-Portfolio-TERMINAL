<?php
/**
 * Template pour l'affichage d'une formation individuelle
 *
 * @package Twenty_Twenty_Enfant_Terminal
 */
get_header();
?>

    <main id="site-content" role="main" class="retro-terminal">
        <?php if (have_posts()) : while (have_posts()) : the_post(); ?>
            <article id="post-<?php the_ID(); ?>" <?php post_class('terminal-welcome blink-border'); ?>>
                <div class="terminal-header">
                    <div class="command-line glitch">root@portfolio:~# cat /formations/<?php echo sanitize_title(get_the_title()); ?>.md</div>
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
                    <div class="formation-details retro-box">
                        <?php if ($school = get_field('school')) : ?>
                            <p><span class="command-prompt">> École :</span> <?php echo esc_html($school); ?></p>
                        <?php endif; ?>
                        <?php if ($period = get_field('period')) : ?>
                            <p><span class="command-prompt">> Période :</span> <?php echo esc_html($period); ?></p>
                        <?php endif; ?>
                        <?php if ($diploma = get_field('diploma')) : ?>
                            <p><span class="command-prompt">> Diplôme :</span> <?php echo esc_html($diploma); ?></p>
                        <?php endif; ?>
                    </div>
                </div>
            </article>
        <?php endwhile; endif; ?>
    </main>

<?php get_footer(); ?>