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

 $menu_name = 'primary';
 $locations = get_nav_menu_locations();
 $menu = wp_get_nav_menu_object( $locations[ $menu_name ] );
 $menuitems = wp_get_nav_menu_items( $menu->term_id, array( 'order' => 'DESC' ) );
 $count = 0;
 $submenu = false;
 $return_li="";


 foreach( $menuitems as $item ):
				 $link = $item->url;
				 $title = $item->title;
				 // item does not have a parent so menu_item_parent equals 0 (false)
				 if ( !$item->menu_item_parent ):
					// save this id for later comparison with sub-menu items
					$parent_id = $item->ID;
					$return_li .= '<li class="menuitem" role="menuitem"><a href="'.$link.'">'.$title.'</a>';

				endif;

				if ( $parent_id == $item->menu_item_parent ):
					if ( !$submenu ):
						$submenu = true;
						$return_li .= '<ul class="sub-menu">'
													.'<li class="title"><a href="#">'.$menuitems[ $count - 1 ]->title.'</a></li>';
					endif;

					$return_li .= '<li class="menuitem"><a href="'.$link.'">'.$title.'</a></li>';

					if ( $menuitems[ $count + 1 ]->menu_item_parent != $parent_id && $submenu ):
						$return_li .= '</ul>';
						$submenu = false;
					endif;

				 endif;

		 if ( $menuitems[ $count + 1 ]->menu_item_parent != $parent_id ):
				$return_li .= '</li>';
				$submenu = false;
		endif;
		$count++;
endforeach;


?><!DOCTYPE html>
<html <?php language_attributes(); ?> class="no-js">
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="profile" href="http://gmpg.org/xfn/11">
	<?php if ( is_singular() && pings_open( get_queried_object() ) ) : ?>
	<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>">
	<?php endif; ?>
	<?php wp_head(); ?>
</head>

<body>
  <div class="main-wrapper home header-light">
		<header class="component--header">
			<div class="top-container desktop-only">
				<div class="component--top-bar">

				  <div class="top-menu-container">
						<?php include_once(get_template_directory() .'/template-parts/social_networks.php'); ?>
            <?php include_once(get_template_directory() .'/template-parts/top_menu.php'); ?>
				  </div>

				  <hr>
				</div>
			</div>

			<div class="nav-container">
				<figure>
					<img class="desktop-only logo logo-white" src="<?php echo get_template_directory_uri(); ?>/img/logo-inline-white.svg" alt="Ecocity Builders" />
					<img class="desktop-only logo logo-black" src="<?php echo get_template_directory_uri(); ?>/img/logo-inline-black.svg" alt="Ecocity Builders" />
					<img class="mobile-only logo" src="<?php echo get_template_directory_uri(); ?>/img/logo-stacked-black.svg" alt="Ecocity Builders" />
				</figure>


			<nav class="main-menubar desktop-only" role="navigation">
				<div class="component--menu">
					  <ul class="main-menu" role="menu">
							<?php
							echo $return_li;
						 ?>
						 <li class="menuitem desktop-only" role="menuitem"><button class="donate-button">DONATE</button></li>
				   </ul>
			 	</div>
			 </nav>


				<button class="mobile-only menu-button">
					<span class="ms-icon menu-opener icon-hamburger-menu"></span>
				</button>

				<div class="mobile-menubar mobile-only">
					<div class="menu-head">
						<figure>
							<img class="mobile-only logo" src="./img/logo-stacked-white.svg" alt="Ecocity Builders" />
						</figure>
						<button class="mobile-only menu-button">
							<span class="ms-icon menu-opener icon-hamburger-menu"></span>
						</button>
					</div>
					<div class="menu-content">
						<div class="component--menu">
						  <ul class="main-menu" role="menu">
								<?php
										echo $return_li;
								?>
						    <li class="menuitem desktop-only" role="menuitem"><button class="donate-button">DONATE</button></li>
						  </ul>
						</div>
						<div class="component--top-bar">

						  <div class="top-menu-container">
								<?php include_once(get_template_directory() .'/template-parts/social_networks.php'); ?>
                <?php include_once(get_template_directory() .'/template-parts/top_menu.php'); ?>
						  </div>

						  <hr>
						</div>
					</div>
				</div>

			</div>

		</header>
