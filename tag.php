<?php get_header(); ?>

	<main class="tags container page with-sidebar" role="main">
		<!-- section -->
		<section class="tags-section">           

			<h1><?php _e( 'Artículos relacionados con: ', 'actualPsi' ); echo single_tag_title('', false); ?></h1>

			<?php get_template_part('template-parts/loop'); ?>

			<?php get_template_part('template-parts/pagination'); ?>

		</section>
		<!-- /section -->
		<?php get_sidebar(); ?>
	</main>

<?php get_footer(); ?>