<footer class="site-footer">
    <!-- Logo từ Customizer -->
    <div class="footer-logo">
        <?php
        $footer_logo = get_theme_mod('footer_logo');
        if ($footer_logo) {
            echo '<img src="' . esc_url($footer_logo) . '" alt="Footer Logo" />';
        }
        ?>
    </div>

    <!-- Các cột menu -->
    <div class="footer-menus">
        <div class="footer-menu-column">
            <h4>VỀ CHÚNG TÔI</h4>
            <?php wp_nav_menu(['theme_location' => 've_chung_toi']); ?>
        </div>
        <div class="footer-menu-column">
            <h4>SẢN PHẨM</h4>
            <?php wp_nav_menu(['theme_location' => 'san_pham']); ?>
        </div>
        <div class="footer-menu-column">
            <h4>PHÁT TRIỂN BỀN VỮNG</h4>
            <?php wp_nav_menu(['theme_location' => 'phat_trien_ben_vung']); ?>
        </div>
        <div class="footer-menu-column">
            <h4>TIN TỨC</h4>
            <?php wp_nav_menu(['theme_location' => 'tin_tuc']); ?>
        </div>
        <div class="footer-menu-column">
            <h4>KHÁC</h4>
            <?php wp_nav_menu(['theme_location' => 'khac']); ?>
        </div>
    </div>

    <!-- Phần dưới cùng: bản quyền và links -->
    <div class="footer-bottom">
        <div class="footer-bottom-left">
            <span>All rights are reserved © <?php echo date('Y'); ?> Suntory Pepsico.</span>
        </div>
        <div class="footer-bottom-right">
            <a href="#">Chính sách bảo mật</a>  |
            <a href="#">Điều khoản sử dụng</a>  |
           <a href="#" aria-label="Facebook">
            <svg width="32" height="32" viewBox="0 0 32 32" fill="none">
                <circle cx="16" cy="16" r="16" fill="#2176bd"/>
                <path d="M18.8 16.5h2l.3-2.3h-2.3v-1.2c0-.6.2-.9.9-.9h1.4V10.6c-.3 0-.9-.1-1.6-.1-1.7 0-2.5 1-2.5 2.7v1.4h-1.7v2.3h1.7v5.6h2.4v-5.6z" fill="#fff"/>
            </svg>
            </a>
    <a href="#" aria-label="LinkedIn">
        <svg width="32" height="32" viewBox="0 0 32 32" fill="none">
            <circle cx="16" cy="16" r="16" fill="#2176bd"/>
            <path d="M12.2 22h-2.5v-7.6h2.5V22zm-1.3-8.6c-.8 0-1.3-.6-1.3-1.3 0-.7.6-1.3 1.3-1.3s1.3.6 1.3 1.3c0 .7-.5 1.3-1.3 1.3zm9.1 8.6h-2.5v-3.8c0-.9-.3-1.5-1.1-1.5-.6 0-.9.4-1.1.8-.1.2-.1.5-.1.8V22h-2.5s.1-6.6 0-7.6h2.5v1.1c.3-.5.8-1.2 2-1.2 1.5 0 2.7 1 2.7 3.2V22z" fill="#fff"/>
        </svg>
        </a>
        <a href="#" aria-label="YouTube">
        <svg width="32" height="32" viewBox="0 0 32 32" fill="none">
            <circle cx="16" cy="16" r="16" fill="#2176bd"/>
            <path d="M22.1 13.2c-.2-.7-.7-1.2-1.4-1.3-1.3-.2-5.4-.2-5.4-.2s-4.1 0-5.4.2c-.7.1-1.2.6-1.4 1.3-.2.7-.2 2.2-.2 2.2s0 1.5.2 2.2c.2.7.7 1.2 1.4 1.3 1.3.2 5.4.2 5.4.2s4.1 0 5.4-.2c.7-.1 1.2-.6 1.4-1.3.2-.7.2-2.2.2-2.2s0-1.5-.2-2.2zm-7 3.6v-2.7l2.7 1.4-2.7 1.3z" fill="#fff"/>
        </svg>
    </a>
        </div>
    </div>
    <?php wp_footer(); ?>
</footer>
</body>
</html>