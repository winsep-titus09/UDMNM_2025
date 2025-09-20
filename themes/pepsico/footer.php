<?php
$logo = get_theme_mod('footer_logo'); // giữ logo từ Customizer
$cols = 5;
?>
<footer id="site-footer" class="site-footer" role="contentinfo"
    aria-label="<?php echo esc_attr__('Chân trang', 'pepsico-theme'); ?>">
    <div class="footer-top">
        <?php if ($logo): ?>
        <div class="footer-brand">
            <a href="<?php echo esc_url(home_url('/')); ?>" class="footer-logo"
                aria-label="<?php echo esc_attr__('Trang chủ', 'pepsico-theme'); ?>">
                <img src="<?php echo esc_url($logo); ?>" alt="<?php echo esc_attr(get_bloginfo('name')); ?>">
            </a>
        </div>
        <?php endif; ?>

        <div class="footer-widgets grid-cols-<?php echo (int) $cols; ?>">
            <?php for ($i = 1; $i <= $cols; $i++): ?>
            <?php if (is_active_sidebar("footer-{$i}")): ?>
            <div class="footer-col footer-col-<?php echo (int) $i; ?>"
                aria-label="<?php echo esc_attr(sprintf(__('Cột chân trang %d', 'pepsico-theme'), $i)); ?>">
                <?php dynamic_sidebar("footer-{$i}"); ?>
            </div>
            <?php endif; ?>
            <?php endfor; ?>
        </div>
    </div>

    <div class="footer-bottom" aria-label="<?php echo esc_attr__('Dòng cuối chân trang', 'pepsico-theme'); ?>">
        <div class="footer-bottom__left">
            <?php if (is_active_sidebar('footer-bottom-left')): ?>
            <?php dynamic_sidebar('footer-bottom-left'); ?>
            <?php endif; ?>
        </div>

        <div class="footer-bottom__center">
            <?php if (is_active_sidebar('footer-bottom-center')): ?>
            <?php dynamic_sidebar('footer-bottom-center'); ?>
            <?php endif; ?>
        </div>

        <div class="footer-bottom__right">
            <?php if (is_active_sidebar('footer-bottom-right')): ?>
            <?php dynamic_sidebar('footer-bottom-right'); ?>
            <?php endif; ?>
        </div>
    </div>
</footer>

<?php wp_footer(); ?>