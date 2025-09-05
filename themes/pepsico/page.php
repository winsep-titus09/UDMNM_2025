<?php
/**
 * Template Name: Custom Page with Slider
 */
get_header(); ?>

<?php 
// Lấy dữ liệu group banner_slide
$banner = get_field('banner_slide');
?>

<?php if ($banner): ?>
    <div class="banner-slider">
        <button class="slide-btn prev-btn">&#10094;</button>
        <div class="slides-wrapper">
            <?php if (!empty($banner['image1'])): ?>
                <div class="slide active">
                    <img src="<?php echo esc_url($banner['image1']['url']); ?>" alt="<?php echo esc_attr($banner['image1']['alt']); ?>">
                </div>
            <?php endif; ?>

            <?php if (!empty($banner['image2'])): ?>
                <div class="slide">
                    <img src="<?php echo esc_url($banner['image2']['url']); ?>" alt="<?php echo esc_attr($banner['image2']['alt']); ?>">
                </div>
            <?php endif; ?>
        </div>
        <button class="slide-btn next-btn">&#10095;</button>
    </div>
<?php endif; ?>

<?php
// Lấy dữ liệu group content1
$content1 = get_field('content1');
$button = get_field('button_info');

if ($content1):
?>
    <div class="content1-group">
        <?php if (!empty($content1['title'])): ?>
            <h2><?php echo esc_html($content1['title']); ?></h2>
        <?php endif; ?>

        <?php if (!empty($content1['title_content1'])): ?>
            <div class="content1-desc">
                <?php echo wp_kses_post($content1['title_content1']); ?>
            </div>
        <?php endif; ?>
        <?php
        if ($button):
            $text = !empty($button['button_text']) ? $button['button_text'] : '';
            $link = !empty($button['button_link']) ? $button['button_link'] : '';
            $icon = !empty($button['button_icon']) ? $button['button_icon']['url'] : '';
        ?>
            <a class="custom-btn" href="<?php echo esc_url($link); ?>">
                <span><?php echo esc_html($text); ?></span>
                <?php if ($icon): ?>
                    <img src="<?php echo esc_url($icon); ?>" alt="icon">
                <?php endif; ?>
            </a>
        <?php endif; ?>
    </div>
<?php
endif;?>
<?php
$stats = get_field('stats_grid');
if ($stats):
?>
<div class="stats7-grid">
    <!-- Ô 1 -->
    <div class="stats7-item stats7-item--icon box1">
        <?php if (!empty($stats['box1_icon'])): ?>
            <img class="stats7-icon" src="<?php echo esc_url($stats['box1_icon']['url']); ?>" alt="">
        <?php endif; ?>
        <div class="content">
            <div class="stats7-number"><?php echo esc_html($stats['box1_number']); ?></div>
            <div class="stats7-title"><?php echo esc_html($stats['box1_title']); ?></div>
            <div class="stats7-desc"><?php echo esc_html($stats['box1_desc']); ?></div>
        </div>
    </div>
    <!-- Ô 2 -->
    <div class="stats7-item stats7-item--icon box2">
        <?php if (!empty($stats['box2_icon'])): ?>
            <img class="stats7-icon" src="<?php echo esc_url($stats['box2_icon']['url']); ?>" alt="">
        <?php endif; ?>
        <div class="content">
            <div class="stats7-number"><?php echo esc_html($stats['box2_number']); ?></div>
            <div class="stats7-title"><?php echo esc_html($stats['box2_title']); ?></div>
            <div class="stats7-desc"><?php echo esc_html($stats['box2_desc']); ?></div>
        </div>
    </div>
    <!-- Ô 3: chỉ có ảnh -->
    <div class="stats7-item stats7-item--image box3">
        <?php if (!empty($stats['box3_image'])): ?>
            <img class="stats7-photo" src="<?php echo esc_url($stats['box3_image']['url']); ?>" alt="">
        <?php endif; ?>
    </div>
    <!-- Ô 4: số + tiêu đề + mô tả -->
    <div class="stats7-item stats7-item--number box4">
        <div class="stats7-number"><?php echo esc_html($stats['box4_number']); ?></div>
        <div class="stats7-title"><?php echo esc_html($stats['box4_title']); ?></div>
        <div class="stats7-desc"><?php echo esc_html($stats['box4_desc']); ?></div>
    </div>
    <!-- Ô 5: icon + số + tiêu đề + mô tả -->
    <div class="stats7-item stats7-item--iconnumber box5">
        <?php if (!empty($stats['box5_icon'])): ?>
            <img class="stats7-icon" src="<?php echo esc_url($stats['box5_icon']['url']); ?>" alt="">
        <?php endif; ?>
        <div class="content">
            <div class="stats7-number"><?php echo esc_html($stats['box5_number']); ?></div>
            <div class="stats7-title"><?php echo esc_html($stats['box5_title']); ?></div>
            <div class="stats7-desc"><?php echo esc_html($stats['box5_desc']); ?></div>
        </div>
    </div>
    <!-- Ô 6: chỉ có ảnh -->
    <div class="stats7-item stats7-item--image box6">
        <?php if (!empty($stats['box6_image'])): ?>
            <img class="stats7-photo" src="<?php echo esc_url($stats['box6_image']['url']); ?>" alt="">
        <?php endif; ?>
    </div>
    <!-- Ô 7: số + tiêu đề + mô tả, chiếm 2 ô hàng dưới cùng -->
    <div class="stats7-item stats7-item--large box7">
        <div class="stats7-number"><?php echo esc_html($stats['box7_number']); ?></div>
        <div class="stats7-title"><?php echo esc_html($stats['box7_title']); ?></div>
        <div class="stats7-desc"><?php echo esc_html($stats['box7_desc']); ?></div>
    </div>
</div>
<?php
endif; ?>

<?php get_footer(); ?>
