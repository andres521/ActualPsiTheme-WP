<?php get_header(); ?>

<?php while( have_posts() ) : the_post(); ?>

<p>hola desde page</p>

    <div class="contenedor">
        <div class="contenido">
            <h1><?php the_title() ?></h1>
        </div>
    </div>

    <div class="seccion contenedor">
        <main class="contenido-principal">
            <img src="<?php echo get_the_post_thumbnail_url(); ?>" alt="">            
            <?php the_content(); ?>
        </main>    
    </div>   

    <?php endwhile; ?>

<?php get_footer(); ?>




