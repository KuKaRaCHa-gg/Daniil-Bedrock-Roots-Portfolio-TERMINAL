<?php
/**
 * Template pour l'affichage d'une compétence individuelle
 *
 * @package Twenty_Twenty_Enfant_Terminal
 */
get_header();
?>

    <main id="site-content" role="main" class="retro-terminal">
        <?php if (have_posts()) : while (have_posts()) : the_post(); ?>
            <article id="post-<?php the_ID(); ?>" <?php post_class('terminal-welcome blink-border'); ?>>
                <div class="terminal-header">
                    <div class="command-line glitch">root@portfolio:~# cat /competences/<?php echo sanitize_title(get_the_title()); ?>.md</div>
                </div>
                <div class="terminal-content scanlines">
                    <h1 class="typing-effect glitch"><?php the_title(); ?> <span class="cursor-blink"></span></h1>
                    <?php if (has_post_thumbnail()) : ?>
                        <div class="featured-media neon-border">
                            <?php the_post_thumbnail('medium', ['class' => 'skill-image']); ?>
                        </div>
                    <?php endif; ?>
                    <div class="entry-content retro-box">
                        <?php
                        if (get_the_content()) {
                            the_content();
                        } else {
                            echo '<p class="terminal-message">Aucune description disponible pour cette compétence. En cours de mise à jour...</p>';
                        }
                        ?>
                    </div>
                    <?php if ($skill_code = get_field('skill_code')) : ?>
                        <div class="code-section retro-box">
                            <h3 class="glitch">Démonstration</h3>
                            <pre><code class="code-input"><?php echo esc_html($skill_code); ?></code></pre>
                            <div class="code-output">
                                <?php
                                if (strpos($skill_code, '<?php') !== false) {
                                    echo '<p class="terminal-message error">ERROR: Code PHP non exécutable ici.</p>';
                                } elseif (strpos($skill_code, '<script>') !== false || strpos($skill_code, '<html>') !== false || strpos($skill_code, '<style>') !== false) {
                                    $unique_id = uniqid('code_');
                                    echo '<iframe id="' . $unique_id . '" class="code-exec-frame" sandbox="allow-scripts" style="width:100%;height:200px;border:none;"></iframe>';
                                    echo '<script>
                                    document.addEventListener("DOMContentLoaded", function() {
                                        const iframe = document.getElementById("' . $unique_id . '");
                                        const doc = iframe.contentDocument || iframe.contentWindow.document;
                                        doc.open();
                                        doc.write(`' . addslashes($skill_code) . '`);
                                        doc.close();
                                    });
                                </script>';
                                } else {
                                    echo '<p class="terminal-message">' . esc_html($skill_code) . '</p>';
                                }
                                ?>
                            </div>
                        </div>
                    <?php else : ?>
                        <div class="retro-box">
                            <p class="terminal-message">Aucun code de démonstration disponible pour cette compétence.</p>
                        </div>
                    <?php endif; ?>
                    <div class="loading-bar"></div>
                </div>
            </article>
        <?php endwhile; else : ?>
            <div class="terminal-welcome blink-border">
                <div class="terminal-header">
                    <div class="command-line glitch">root@portfolio:~# cat /competences/not-found.md</div>
                </div>
                <div class="terminal-content scanlines">
                    <h1 class="typing-effect glitch">Erreur 404 <span class="cursor-blink"></span></h1>
                    <p class="terminal-message error">Compétence non trouvée.</p>
                </div>
            </div>
        <?php endif; ?>
    </main>

<?php get_footer(); ?>