<?php
/**
 * The template for displaying the header
 *
 * Displays all of the head element and everything up until the "site-content" div.
 *
 * @package WordPress
 * @subpackage Twenty_Sixteen
 * @since Twenty Sixteen 1.0
 */

$primary_menu = get_primary_menu();

?><!DOCTYPE html>
<html <?php language_attributes(); ?> class="no-js">
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="initial-scale=1, maximum-scale=1">
	<link rel="profile" href="http://gmpg.org/xfn/11">
	<?php if ( is_singular() && pings_open( get_queried_object() ) ) : ?>
	<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>">
	<?php endif; ?>
	<?php wp_head(); ?>
	<script>
	  const DIRECTORY_URI =  '<?= get_template_directory_uri(); ?>';
	</script>
</head>

<body>

  <div class="main-wrapper home <?php if(is_home() == 1) echo "header-light"  ?>">
		<header class="component--header">
			<div class="top-container desktop-only">
				<div class="component--top-bar">

				  <div class="top-menu-container">
						<?php include(get_template_directory() .'/template-parts/social_networks.php'); ?>
            <?php include(get_template_directory() .'/template-parts/top_menu.php'); ?>
				  </div>

				  <hr>
				</div>
			</div>

			<div class="nav-container">
				<a href="./">
					<figure>
						<img class="desktop-only logo logo-white" src="<?php echo get_template_directory_uri(); ?>/img/logo-inline-white.svg" alt="Ecocity Builders" />
						<img class="desktop-only logo logo-black" src="<?php echo get_template_directory_uri(); ?>/img/logo-inline-black.svg" alt="Ecocity Builders" />
						<img class="mobile-only logo" src="<?php echo get_template_directory_uri(); ?>/img/logo-stacked-black.svg" alt="Ecocity Builders" />
					</figure>
				</a>


				<nav class="main-menubar desktop-only" role="navigation">
					<div class="component--menu">
						  <ul class="main-menu" role="menu">
								<?php
								echo $primary_menu;
							 ?>							
					   </ul>
				 	</div>
			 </nav>


				<button class="mobile-only menu-button">
					<span class="ms-icon menu-opener icon-hamburger-menu"></span>
				</button>

				<div class="mobile-menubar mobile-only">
					<div class="menu-head">
						<a href="/">
							<figure>
								<img class="mobile-only logo" src="<?php echo get_template_directory_uri(); ?>/img/logo-stacked-white.svg" alt="Ecocity Builders" />
							</figure>
						</a>
						<button class="mobile-only menu-button">
							<span class="ms-icon menu-opener icon-close"></span>
						</button>
					</div>
					<div class="menu-content">
						<div class="component--menu">
						  <ul class="main-menu" role="menu">
								<?php
										echo $primary_menu;
								?>
						  </ul>
						</div>
						<div class="component--top-bar">

						  <div class="top-menu-container">
								<?php include(get_template_directory() .'/template-parts/social_networks.php'); ?>
                <?php include(get_template_directory() .'/template-parts/top_menu.php'); ?>
						  </div>

						  <hr>
						</div>
					</div>
				</div>

			</div>

		</header>
