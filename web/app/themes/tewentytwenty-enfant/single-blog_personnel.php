<?php
/**
 * Template pour l'affichage d'un article de blog personnel
 *
 * @package Twenty_Twenty_Enfant_Terminal
 */
get_header();
?>

    <main id="site-content" role="main" class="retro-terminal">
        <?php if (have_posts()) : while (have_posts()) : the_post(); ?>
            <article id="post-<?php the_ID(); ?>" <?php post_class('terminal-welcome blink-border'); ?>>
                <div class="terminal-header">
                    <div class="command-line glitch">root@portfolio:~# cat /blog/<?php echo sanitize_title(get_the_title()); ?>.md</div>
                </div>
                <div class="terminal-content scanlines">
                    <h1 class="typing-effect glitch"><?php the_title(); ?> <span class="cursor-blink"></span></h1>
                    <div class="post-meta retro-box">
                        <p class="post-date"><span class="command-prompt">> Date :</span> <?php the_date(); ?> | <span class="command-prompt">Auteur :</span> <?php the_author(); ?></p>
                    </div>
                    <?php if (has_post_thumbnail()) : ?>
                        <div class="featured-media neon-border">
                            <?php the_post_thumbnail('large'); ?>
                        </div>
                    <?php endif; ?>
                    <div class="entry-content">
                        <?php the_content(); ?>
                    </div>
                    <div class="post-tags retro-box">
                        <?php the_tags('<span class="tag-label command-prompt">> Tags :</span> ', ', ', ''); ?>
                    </div>
                    <?php if (comments_open() || get_comments_number()) : ?>
                        <div class="post-comments retro-box">
                            <?php comments_template(); ?>
                        </div>
                    <?php endif; ?>
                </div>
            </article>
        <?php endwhile; endif; ?>
    </main>

<?php get_footer(); ?>