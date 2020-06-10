<?php get_header(); ?>

<main class="seccion-home container page with-sidebar" role="article summaries">
        <section class="home">

            <?php get_template_part('template-parts/loop'); ?>

            <?php get_template_part('template-parts/pagination'); ?>
        </section>
        <?php get_sidebar(); ?>

    </main>   

<?php get_footer(); ?>