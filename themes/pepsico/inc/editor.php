<?php
// Tắt Gutenberg, bật Classic Editor
add_filter('use_block_editor_for_post', '__return_false', 10);

// Tắt trình soạn thảo khối trong widget (WP 5.8+)
add_filter('use_widgets_block_editor', '__return_false');
