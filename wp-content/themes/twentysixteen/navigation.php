<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
?>
<?php if ( is_active_sidebar( 'navigation' )  ) : ?>
	<aside id="navigation" class="navigation widget-area" role="complementary">
		<?php dynamic_sidebar( 'navigation' ); ?>
	</aside><!-- .sidebar .widget-area -->
<?php endif; ?>