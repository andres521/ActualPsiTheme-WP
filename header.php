<!DOCTYPE html>
    <html <?php language_attributes(); ?> class="no-js">
        <head>
            <meta charset="<?php bloginfo('charset'); ?>">
            <title><?php wp_title(''); ?><?php if(wp_title('', false)) { echo ' :'; } ?> <?php bloginfo('name'); ?></title>
            <!--  revisar los favicons
            <link href="<?php echo get_template_directory_uri(); ?>/img/icons/favicon.ico" rel="shortcut icon">
            <link href="<?php echo get_template_directory_uri(); ?>/img/icons/touch.png" rel="apple-touch-icon-precomposed"> -->
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <meta http-equiv="X-UA-Compatible" content="ie=edge">
            <meta name="description" content="<?php bloginfo('description'); ?>">
            <meta name="author" content="<?php the_author(); ?>" />
            <?php wp_head();?>
            
            </head>
            
            <body <?php body_class(); ?>>
                <header class="site-header" id="masthead" role="banner">
                    <div class="container">
                        <div class="navbar site-title">
                            <!-- logo -->
                            <div class="logo">
                                <a href="<?php echo esc_url(site_url('/')) ?>">
                                <img src="<?php echo get_template_directory_uri(); ?>/img/ActualidadenPsicologiaLogo.svg" class="logo" alt="logo Actualidad en Psicología"></a>
                            </div><!-- /logo -->
                            <!-- nav -->
                                 
                        </div><!-- /navbar -->
                        <?php
                            $args = array('theme_location' => 'header-menu', 
                                'container' => 'nav',
                                'container_class' => 'header-menu',
                                'container_id' => 'menu',                         
                                );
                            wp_nav_menu($args);
                        ?>
                            <!-- /nav -->        
                    </div> <!-- /container -->                    
                </header><!-- /header -->
                <?php get_template_part('template-parts/ads-header'); ?>

            