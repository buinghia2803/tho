
<footer class="site-footer">
    <div class="site-shell footer-inner">
        <?php if (is_active_sidebar('footer')) : ?>
            <div class="footer-widgets"><?php dynamic_sidebar('footer'); ?></div>
        <?php endif; ?>
        <p class="footer-copyright">
            <?php echo esc_html(get_theme_mod('nhm_footer_copyright', 'Bản quyền thuộc sở hữu trí tuệ của ' . get_bloginfo('name'))); ?>
        </p>
        <?php
        $phone = get_theme_mod('nhm_contact_phone');
        $email = get_theme_mod('nhm_contact_email');
        if ($phone || $email) :
        ?>
            <p class="footer-contact">
                <?php if ($phone) : ?>
                    <span>Điện thoại: <a href="tel:<?php echo esc_attr(preg_replace('/[^0-9+]/', '', $phone)); ?>"><?php echo esc_html($phone); ?></a></span>
                <?php endif; ?>
                <?php if ($email) : ?>
                    <span>Email: <a href="mailto:<?php echo esc_attr($email); ?>"><?php echo esc_html($email); ?></a></span>
                <?php endif; ?>
            </p>
        <?php endif; ?>
        <?php
        wp_nav_menu([
            'theme_location'       => 'footer',
            'container'            => 'nav',
            'container_class'      => 'footer-navigation',
            'container_aria_label' => 'Menu chân trang',
            'fallback_cb'          => false,
        ]);
        ?>
    </div>
</footer>

<?php if (!empty($phone)) : ?>
    <a class="contact-fab" href="tel:<?php echo esc_attr(preg_replace('/[^0-9+]/', '', $phone)); ?>" aria-label="Gọi điện liên hệ">
        <span class="contact-fab-icon" aria-hidden="true">☎</span>
        <span>Liên hệ</span>
    </a>
<?php endif; ?>

<?php wp_footer(); ?>
</body>
</html>
