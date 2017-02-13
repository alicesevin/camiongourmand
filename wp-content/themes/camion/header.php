<!doctype html>

<html <?php language_attributes(); ?>>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title><?php wp_title(''); ?></title>
    <meta name="HandheldFriendly" content="True">
    <meta name="MobileOptimized" content="320">
    <meta name="viewport" content="width=device-width, initial-scale=1"/>
    <link rel="apple-touch-icon" href="<?php echo get_template_directory_uri(); ?>/images/apple-touch-icon.png">
    <link rel="icon" href="<?php echo get_template_directory_uri(); ?>/images/favicon.png">
    <!--[if IE]>
    <link rel="shortcut icon" href="<?php echo get_template_directory_uri(); ?>/images/favicon.ico">
    <![endif]-->
    <meta name="msapplication-TileColor" content="#f01d4f">
    <meta name="msapplication-TileImage"
          content="<?php echo get_template_directory_uri(); ?>/dev/images/win8-tile-icon.png">

    <link rel="pingback" href="<?php bloginfo('pingback_url'); ?>">

    <?php wp_head(); ?>

</head>

<body <?php body_class(); ?>>

<div id="container">

    <header class="header">

        <div class="header__group">
            <div class="header__sociaux">
                <ul class="header__sociauxLinks">
                    <li><a class="icon__sociaux--facebook" href="#">Facebook</a></li>
                    <li><a class="icon__sociaux--instagram" href="#">Instagram</a></li>
                </ul>
            </div>

            <div class="header__logo">
                <a href="<?php echo home_url(); ?>">
                    <?php bloginfo('name'); ?>
                </a>
            </div>

            <?php wp_nav_menu(array(
                'menu_id' => 'main-nav',
                'menu_class' => 'header__menuLinks',
                'container_id' => false,
                'container' => 'nav',
                'container_class' => 'header__menu',
                'menu' => 'Menu principal',
                'theme_location' => 'main-nav'
            )); ?>
        </div>
    </header>
