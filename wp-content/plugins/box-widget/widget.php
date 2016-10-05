<?php
 
/*
Plugin Name: Box Widget
Plugin URI: http://www.codigonexo.com/
Description: Create widget for number and text.
Version: 1.0
Author: Codigonexo
Author URI: http://www.codigonexo.com/
*/
 
/**
 * Función que instancia el Widget
 */
function mpw_create_widget(){    
    include_once(plugin_dir_path( __FILE__ ).'/includes/mpw_widget.php');
    register_widget('mpw_widget');
}
add_action('widgets_init','mpw_create_widget'); 
 
?>
