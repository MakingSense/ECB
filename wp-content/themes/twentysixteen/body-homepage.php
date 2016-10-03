<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
?>
<?php if ( is_active_sidebar( 'block-home' )  ) : ?>
	<aside id="block" class="block widget-area" role="complementary">
		<?php dynamic_sidebar( 'block-home' ); ?>
	</aside><!-- .sidebar .widget-area -->
<?php endif; ?>
<?php include_once(get_template_directory() .'/template-parts/twitter-facebook.php');  ?>
