<?php get_header(); ?>
<main class="container">
    <?php if (have_posts()) : while (have_posts()) : the_post(); ?>
        <article <?php post_class('mb-4'); ?>>
            <h2><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
            <?php the_post_thumbnail('large', ['class'=>'img-fluid']); ?>
            <div><?php the_excerpt(); ?></div>
        </article>
    <?php endwhile; endif; ?>
</main>
<?php get_footer(); ?>