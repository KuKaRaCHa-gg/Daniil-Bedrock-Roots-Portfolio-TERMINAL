<?php
/**
 * Footer pour Twenty Twenty Enfant Terminal
 *
 * @package Twenty_Twenty_Enfant_Terminal
 */
?>
<footer id="site-footer" class="terminal-footer">
    <div class="terminal-footer-command">
        <div class="terminal-header">
            <span class="command-line">root@portfolio:~# shutdown -h now</span>
        </div>
        <div class="terminal-content">
            <div class="terminal-output">
                <p>[OK] Terminating processes...</p>
                <p>[OK] Saving session...</p>
                <div class="loading-bar"></div>
            </div>
            <p class="terminal-message typing-effect">Fin de session... <span class="cursor-blink"></span></p>
        </div>
    </div>

    <div class="terminal-footer-inner section-inner">
        <div class="footer-credits">
            <p class="terminal-command">
                <span class="prompt">$</span> echo "© <?php echo date('Y'); ?> <?php bloginfo('name'); ?> | Tous droits réservés"
            </p>

            <?php if (function_exists('the_privacy_policy_link')) : ?>
                <p class="terminal-command">
                    <span class="prompt">$</span> cat <?php the_privacy_policy_link('', ''); ?>
                </p>
            <?php endif; ?>
        </div><!-- .footer-credits -->

        <!-- Menu de pied de page -->
        <div class="footer-menu-wrapper">
            <?php
            wp_nav_menu(array(
                'theme_location' => 'footer',
                'menu_id' => 'footer-menu',
                'container' => false,
                'fallback_cb' => false,
            ));
            ?>
        </div><!-- .footer-menu-wrapper -->

        <a class="to-the-top" href="#site-header">
            <span class="to-the-top-long terminal-command">
                <span class="prompt">$</span> cd ~/ <span class="cursor-blink"></span>
            </span>
            <span class="to-the-top-short terminal-command">
                <span class="arrow">↑</span>
            </span>
        </a><!-- .to-the-top -->
    </div><!-- .section-inner -->
</footer><!-- #site-footer -->

<script>
    // Simule une saisie de commande dans le terminal
    document.addEventListener('DOMContentLoaded', function() {
        const commands = document.querySelectorAll('.terminal-footer .terminal-command');
        commands.forEach((cmd, index) => {
            setTimeout(() => {
                cmd.classList.add('active');
            }, index * 500); // Délai plus long pour un effet plus naturel
        });

        // Animation de "shutdown" pour la section terminal-output
        const outputLines = document.querySelectorAll('.terminal-footer .terminal-output p');
        outputLines.forEach((line, index) => {
            setTimeout(() => {
                line.classList.add('visible');
            }, index * 1000);
        });
    });
</script>

<?php wp_footer(); ?>

</body>
</html>