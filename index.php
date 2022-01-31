<?php get_header(); ?>

<?php if(have_posts()){ while(have_posts()) { the_post(); ?>
    <h1 class="titulo"><?php the_title(); ?></h1>
    <main class="container"><?php the_content(); ?></main>
<?php } } else { ?>

<?php } ?>

<?php get_footer(); ?>
