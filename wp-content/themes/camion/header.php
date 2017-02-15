<?php
global $facebook;
global $instagram;
?>
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

    <header class="head">

        <div class="head__group">

            <div class="head__bar">

            <div class="head__barLogo">
                <a href="<?php echo home_url(); ?>">
                    <img src="<?php echo get_stylesheet_directory_uri() ?>/dist/img/logo.png"
                         alt="<?php bloginfo('name'); ?>">
                </a>
            </div>

            <div class="head__barBurger head__barBurger-close">
                <span class="menu__burger-first"></span>
                <span class="menu__burger-second"></span>
                <span class="menu__burger-third"></span>
            </div>

            </div>

            <div class="head__menu menu">

                <?php wp_nav_menu(array(
                    'menu_id' => 'main-nav',
                    'menu_class' => 'nav__links',
                    'container_id' => false,
                    'container' => 'nav',
                    'container_class' => 'menu__nav',
                    'menu' => 'Menu principal',
                    'theme_location' => 'main-nav'
                )); ?>

                <div class="menu__adress">
                    <a href="#">Mentions Légales</a>
                </div>


                <?php if ($facebook || $instagram): ?>
                    <div class="menu__sociaux">
                        <ul class="menu__sociauxLinks">
                            <li><a class="icon__sociaux icon-facebook" href="#">Facebook</a></li>
                            <li><a class="icon__sociaux icon-instagram" href="#">Instagram</a></li>
                        </ul>
                    </div>
                <?php endif; ?>

                <div class="menu__adress">
                    <p>
                        38-42 rue cuvier,<br>
                        Montreuil, Ile-De-France<br>
                        France
                        <strong>06 08 69 36 34</strong>
                    </p>
                </div>
            </div>

        </div>
    </header>
