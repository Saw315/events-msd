<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
    <meta charset="<?php bloginfo( 'charset' ); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title><?php wp_title( '|', true, 'right' ); ?></title>
	<?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>

<header class="msd-header">
    <a class="msd-header__logo" href="<?= bloginfo( 'url' ); ?>">
        <img src="<?= get_template_directory_uri(); ?>/assets/img/msd-logo.svg" alt="">
    </a>
    <nav>
		<?php wp_nav_menu( [ 'theme_location' => 'primary' ] ); ?>
    </nav>
</header>
