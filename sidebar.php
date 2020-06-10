<!-- sidebar -->
<aside class="sidebar" role="complementary">

	<div class="sidebar-top">
		<?php get_template_part('template-parts/searchform'); ?>
			<div class="sidebar-widget sidebar-2">
			<?php if(!function_exists('dynamic_sidebar') || !dynamic_sidebar('widget-area-1')) ?>
		</div>
	</div>
	
</aside>
<!-- /sidebar -->
