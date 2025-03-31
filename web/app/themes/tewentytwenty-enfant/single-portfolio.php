<?php
get_header();
?>

    <main id="site-content" role="main">
        <?php if (have_posts()) : while (have_posts()) : the_post(); ?>
            <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
                <div class="terminal-welcome">
                    <div class="terminal-header">
                        <div class="command-line">cat /competences/<?php echo sanitize_title(get_the_title()); ?>.md</div>
                    </div>
                    <div class="terminal-content">
                        <h1><?php the_title(); ?></h1>
                        <?php if (has_post_thumbnail()) : ?>
                            <div class="featured-media">
                                <?php the_post_thumbnail('medium'); ?>
                            </div>
                        <?php endif; ?>
                        <div class="entry-content">
                            <?php the_content(); ?>
                        </div>
                        <?php if ($skill_level = get_field('skill_level')) : ?>
                            <p><strong>Niveau :</strong> <?php echo esc_html($skill_level); ?>/100</p>
                        <?php endif; ?>
                        <?php if ($skill_code = get_field('skill_code')) : ?>
                            <div class="code-section">
                                <h3>Démonstration</h3>
                                <pre><code><?php echo esc_html($skill_code); ?></code></pre>
                                <div class="code-output">
                                    <?php
                                    if (strpos($skill_code, '<?php') === false) {
                                        echo $skill_code;
                                    } else {
                                        echo '<p>Code PHP non exécutable ici.</p>';
                                    }
                                    ?>
                                </div>
                                <script>
                                    document.addEventListener('DOMContentLoaded', function() {
                                        const code = <?php echo json_encode($skill_code); ?>;
                                        if (code.includes('<script>')) {
                                            const scriptContent = code.match(/<script>(.*?)<\/script>/s);
                                            if (scriptContent && scriptContent[1]) {
                                                try {
                                                    eval(scriptContent[1]);
                                                } catch (e) {
                                                    console.error('Erreur JS : ', e);
                                                }
                                            }
                                        }
                                    });
                                </script>
                            </div>
                        <?php endif; ?>
                    </div>
                </div>
            </article>
        <?php endwhile; endif; ?>
    </main>

<?php get_footer(); ?>