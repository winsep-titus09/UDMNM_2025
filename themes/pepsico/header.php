<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
    <meta charset="<?php bloginfo('charset'); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>
    <header class="container py-3">
        <div class="row align-items-center">
            <div class="col-auto">
                <?php if (has_custom_logo()) {
                    the_custom_logo();
                } else { ?>
                    <a href="<?php echo home_url(); ?>"><?php bloginfo('name'); ?></a>
                <?php } ?>
            </div>
            <div class="col">
                <?php wp_nav_menu(['theme_location'=>'primary', 'container'=>'nav', 'container_class'=>'navbar navbar-expand-lg']); ?>
            </div>
        </div>
    </header>