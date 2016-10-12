<?php
/**
 * Plugin Name: WPAdmin Page Template Filter
 * Plugin URI: http://www.rocketmill.co.uk
 * Description: A light plugin that adds a column and a filter parameter to page listing in the WordPress admin area.
 * Version: 1.0
 * Author: Bertram Greenhough
 * Author URI: http://www.rocketmill.co.uk/author/bertram
 * License: GPL2
 */
 
defined('ABSPATH') or die("No script kiddies please!");

function pagetemplates_request_admin($request) {
	if( isset($_GET['template']) && !empty($_GET['template']) ) {
		$templates = wp_get_theme()->get_page_templates();
		if(isset($templates[$_GET['template']])){
			$request['meta_key'] = '_wp_page_template';
			$request['meta_value'] = $_GET['template'];
		}
	}
	return $request;
}
function pagetemplates_restrict_manage_posts() {

	$templates = wp_get_theme()->get_page_templates();
		
	?>
	 <select name="template" id="template">
		 <option value="">Show all Templates</option>
		 <?php foreach ($templates as $temp_file => $temp_name) { ?>
		 
		 <option value="<?php echo esc_attr( $temp_file ); ?>" <?php if(isset($_GET['template']) && !empty($_GET['template']) ) selected($_GET['template'], $temp_file); ?>><?php echo $temp_name; ?></option>
		 <?php } ?>
	 </select> 

<?php }


function temp_col_head($defaults) {
    $defaults['page_temp'] = 'Page Template';
    return $defaults;
}
function temp_col_content($column_name, $post_ID) {
	
    if ($column_name == 'page_temp') {
		$templates = wp_get_theme()->get_page_templates();
		$temp_slug = get_page_template_slug( $post_ID );
		if(isset($templates[$temp_slug])){
			echo $templates[$temp_slug];
		}else{
			echo 'Default';	
		}
    }
}


if( is_admin() && isset($_GET['post_type']) && $_GET['post_type'] == 'page' ) {
	
	add_filter('request', 'pagetemplates_request_admin');
	add_filter('restrict_manage_posts', 'pagetemplates_restrict_manage_posts');
	
	add_filter('manage_pages_columns', 'temp_col_head');
	add_action('manage_pages_custom_column', 'temp_col_content', 10, 2);
}

?>