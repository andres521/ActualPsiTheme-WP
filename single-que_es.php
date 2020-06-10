<?php get_header(); ?>

	<main class="container page with-sidebar" role="main">
	<!-- section -->
	<section class="article-content">

    <p>hola desde page que es</p>	

		<?php get_template_part('template-parts/article-content'); ?>

			
	</section>
	<!-- /section -->
	<?php get_sidebar(); ?>
	</main>

	<section class="article-complementary" role="complementary">

		<div class="complementary-recont">
			<?php get_template_part('template-parts/post-rel'); ?>

			<?php get_template_part('template-parts/ads-relcont'); ?>
		</div>

		<div class="comment-section container page with-sidebar">
			<?php comments_template(); ?>
			<?php get_sidebar('bottom'); ?>
		</div>

		
	</section>

<?php get_footer(); ?>