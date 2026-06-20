<footer class="site-footer">
    <div class="footer-inner">
        <div class="footer-col">
            <h4>Casinos</h4>
            <?php wp_nav_menu(array(
                'theme_location' => 'footer_casinos',
                'container'      => false,
                'menu_class'     => 'menu',
                'depth'          => 1,
                'fallback_cb'    => 'ontariogamers_footer_casinos_fallback',
            )); ?>
        </div>
        <div class="footer-col">
            <h4>Slots</h4>
            <?php wp_nav_menu(array(
                'theme_location' => 'footer_slots',
                'container'      => false,
                'menu_class'     => 'menu',
                'depth'          => 1,
                'fallback_cb'    => 'ontariogamers_footer_slots_fallback',
            )); ?>
        </div>
        <div class="footer-col">
            <h4>Sports Betting</h4>
            <?php wp_nav_menu(array(
                'theme_location' => 'footer_sports',
                'container'      => false,
                'menu_class'     => 'menu',
                'depth'          => 1,
                'fallback_cb'    => 'ontariogamers_footer_sports_fallback',
            )); ?>
        </div>
        <div class="footer-col">
            <h4>OntarioGamers</h4>
            <?php wp_nav_menu(array(
                'theme_location' => 'footer_company',
                'container'      => false,
                'menu_class'     => 'menu',
                'depth'          => 1,
                'fallback_cb'    => 'ontariogamers_footer_company_fallback',
            )); ?>
        </div>
    </div>

    <div class="footer-disclaimer">
        <strong>Responsible Gambling:</strong> 19+ in Ontario. Gambling involves financial risk. Never bet money you cannot afford to lose.
        Problem gambling help: ConnexOntario 1-866-531-2600 (free, confidential, 24/7). CAMH: camh.ca.
        <br><br>
        OntarioGamers.com is an independent affiliate review site for Ontario players. We earn commission from licensed casino and sportsbook operators when players register through our links — at no cost to the player and with no influence on our editorial recommendations. All recommended operators are verified as AGCO-registered with iGaming Ontario. OntarioGamers.com does not accept wagers and is not a gambling operator.
    </div>

    <div class="footer-bottom">
        <span>&copy; <?php echo date('Y'); ?> OntarioGamers. All Rights Reserved.</span>
        <a href="<?php echo esc_url(home_url('/terms-and-conditions/')); ?>">Terms and Conditions</a>
    </div>
</footer>

<?php wp_footer(); ?>
</body>
</html>
