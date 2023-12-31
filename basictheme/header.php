<!DOCTYPE html>
<html <?php language_attributes(); ?>>
    <head>
        <meta charset="<?php bloginfo('charset'); ?>">
        <meta name="viewport" content="width=device-width">
        <title><?php bloginfo('name'); ?> </title>
        <?php wp_head(); ?>

    </head>

    <body <?php body_class(); ?>> 

    <div class="container">

    <!-- site header -->
    <header class="site-header">
        <?php /* reminder to check out this code cuz if not commented it makes the site title a link yes, but it adds an invisible block above the home page menu */ ?>
        <h1><?php /*<a href="<?php echo home_url();*/ ?><?php bloginfo('name'); ?></h1>
        <h5><?php bloginfo('description'); ?></h5>

        <nav class="site-nav">

            <?php
            $args = array(
                'theme_location' => 'primary'
            );
            ?>
            <?php wp_nav_menu( $args); ?>
        </nav>

    </header> 
    <!-- site header -->