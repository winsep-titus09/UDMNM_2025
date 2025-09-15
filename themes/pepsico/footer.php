<?php wp_footer(); ?>
<?php
$logo = get_theme_mod('footer_logo'); // GIỮ NGUYÊN logo từ Customizer
$cols = 5;
?>
<footer id="site-footer" class="site-footer" role="contentinfo">
  <div class="footer-top">
    <?php if ($logo): ?>
      <div class="footer-brand">
        <a href="<?php echo esc_url(home_url('/')); ?>" class="footer-logo" aria-label="Home">
          <img src="<?php echo esc_url($logo); ?>" alt="<?php bloginfo('name'); ?>">
        </a>
      </div>
    <?php endif; ?>

    <div class="footer-widgets grid-cols-<?php echo (int)$cols; ?>">
      <?php for ($i=1; $i<=$cols; $i++): ?>
        <?php if (is_active_sidebar("footer-{$i}")): ?>
          <div class="footer-col footer-col-<?php echo (int)$i; ?>">
            <?php dynamic_sidebar("footer-{$i}"); ?>
          </div>
        <?php endif; ?>
      <?php endfor; ?>
    </div>
  </div>

  <div class="footer-bottom">
    <div class="footer-bottom__left">
      <?php if (is_active_sidebar('footer-bottom-left')) dynamic_sidebar('footer-bottom-left'); ?>
    </div>

    <div class="footer-bottom__center">
      <?php if (is_active_sidebar('footer-bottom-center')) dynamic_sidebar('footer-bottom-center'); ?>
    </div>

    <div class="footer-bottom__right">
      <?php if (is_active_sidebar('footer-bottom-right')) dynamic_sidebar('footer-bottom-right'); ?>
    </div>
  </div>
</footer>
