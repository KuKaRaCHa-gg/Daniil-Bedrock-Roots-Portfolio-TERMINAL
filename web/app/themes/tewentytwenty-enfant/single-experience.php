<?php
/**
 * Template pour l'affichage d'une expérience individuelle
 *
 * @package Twenty_Twenty_Enfant_Terminal
 */
get_header();
?>

    <main id="site-content" role="main" class="retro-terminal">
        <?php if (have_posts()) : while (have_posts()) : the_post(); ?>
            <article id="post-<?php the_ID(); ?>" <?php post_class('terminal-welcome blink-border'); ?>>
                <div class="terminal-header">
                    <div class="command-line glitch">root@portfolio:~# cat /experiences/<?php echo sanitize_title(get_the_title()); ?>.md</div>
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
                    <div class="experience-details retro-box">
                        <?php if ($company = get_field('company')) : ?>
                            <p><span class="command-prompt">> Entreprise :</span> <?php echo esc_html($company); ?></p>
                        <?php endif; ?>
                        <?php if ($position = get_field('position')) : ?>
                            <p><span class="command-prompt">> Poste :</span> <?php echo esc_html($position); ?></p>
                        <?php endif; ?>
                        <?php if ($period = get_field('period')) : ?>
                            <p><span class="command-prompt">> Période :</span> <?php echo esc_html($period); ?></p>
                        <?php endif; ?>
                        <?php if ($technologies = get_field('technologies')) : ?>
                            <div class="experience-technologies">
                                <h3 class="glitch">Technologies utilisées</h3>
                                <div class="technology-tags">
                                    <?php foreach ($technologies as $tech) : ?>
                                        <span class="tech-tag neon-border"><?php echo esc_html($tech['tech_name']); ?></span>
                                    <?php endforeach; ?>
                                </div>
                            </div>
                        <?php endif; ?>
                    </div>
                </div>
            </article>
        <?php endwhile; endif; ?>
    </main>

<?php get_footer(); ?>