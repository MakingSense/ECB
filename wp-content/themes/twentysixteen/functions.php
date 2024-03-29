<?php
/**
 * Twenty Sixteen functions and definitions
 *
 * Set up the theme and provides some helper functions, which are used in the
 * theme as custom template tags. Others are attached to action and filter
 * hooks in WordPress to change core functionality.
 *
 * When using a child theme you can override certain functions (those wrapped
 * in a function_exists() call) by defining them first in your child theme's
 * functions.php file. The child theme's functions.php file is included before
 * the parent theme's file, so the child theme functions would be used.
 *
 * @link https://codex.wordpress.org/Theme_Development
 * @link https://codex.wordpress.org/Child_Themes
 *
 * Functions that are not pluggable (not wrapped in function_exists()) are
 * instead attached to a filter or action hook.
 *
 * For more information on hooks, actions, and filters,
 * {@link https://codex.wordpress.org/Plugin_API}
 *
 * @package WordPress
 * @subpackage Twenty_Sixteen
 * @since Twenty Sixteen 1.0
 */
/**
 * Twenty Sixteen only works in WordPress 4.4 or later.
 */
function get_text_link_button_home() {
    if(trim(get_field('link_button', get_the_ID() ))!=""  && trim(get_field('button_name', get_the_ID() ))!="" ){
        $link_button = get_field('link_button');
        $button = mb_strimwidth(get_field('button_name'),0, 10, "...");
        echo sprintf(
            __( '<div class="button-wrapper"><a class="button-container" href="'.$link_button.'"><button class="more-button">'.$button.'</button></a></div>', 'twentysixteen' ),
            get_the_title()
        );
    }
}
function get_date_block_home() {
    if(trim(get_field("date", get_the_ID() ))!="") {
        $date = get_field("date", get_the_ID() );
         echo '<h4>'.$date.'</h4>';
    }
}
function custom_excerpt_length( $length ) {
	return 30;
}
add_filter( 'excerpt_length', 'custom_excerpt_length', 999 );

function theme_register_scripts() {
//wp_deregister_script( 'jquery' ); // deregister the default wordpress jquery
//wp_register_script( 'jquery', esc_url( 'js/vendor/jquery.min.js') , array(), '4.0.3' );


wp_register_script( 'ajax-pagination', esc_url(   get_bloginfo('stylesheet_directory') . '/js/ajax-custom.js') ); // script

wp_enqueue_script( 'jquery' );
wp_enqueue_script( 'ajax-pagination' );


  /** Localize Scripts with ajax */
  $php_array = array( 'admin_ajax' => admin_url( 'ajax-pagination.php' ) );
  wp_localize_script( 'ajax-pagination', 'php_array', $php_array );

  $wnm_custom = array( 'template_url' => get_bloginfo('template_url') ); // Localized the get_bloginfo() into a variable to use in the ajax-custom.js file to find the svg animation image
  wp_localize_script( 'ajax-pagination', 'wnm_custom', $wnm_custom );


}
add_action( 'wp_enqueue_scripts', 'theme_register_scripts', 1 );

/**
 * New function for search category in the post
 */
function search_category_post($id){
    global $wpdb;
    $cat_query = "SELECT
                    ecb_terms.name
                  FROM
                    ecb_term_taxonomy
                  LEFT OUTER JOIN
                    ecb_terms
                  ON
                    ecb_terms.term_id = ecb_term_taxonomy.term_id
                  RIGHT OUTER JOIN
                    ecb_term_relationships
                  ON
                    ecb_term_relationships.term_taxonomy_id = ecb_term_taxonomy.term_taxonomy_id
                  RIGHT OUTER JOIN
                    ecb_posts
                  ON
                    ecb_term_relationships.object_id = ecb_posts.ID
                  WHERE
                    ecb_posts.ID = $id
                  LIMIT 1";

    $cat_result = $wpdb->get_results( $cat_query );
    return $cat_result[0]->name;
}
/**
 * New function for Custom post type Media en backend.
 */

function my_custom_post_media() {
  $labels = array(
    'name'               => _x( 'Media', 'post type general name' ),
    'singular_name'      => _x( 'Media', 'post type singular name' ),
    'add_new'            => _x( 'Add New', 'book' ),
    'add_new_item'       => __( 'Add New Media' ),
    'edit_item'          => __( 'Edit Media' ),
    'new_item'           => __( 'New Media' ),
    'all_items'          => __( 'All Media' ),
    'view_item'          => __( 'View Media' ),
    'search_items'       => __( 'Search Media' ),
    'not_found'          => __( 'No media found' ),
    'not_found_in_trash' => __( 'No media found in the Trash' ),
    'parent_item_colon'  => '',
    'menu_name'          => 'Media Post'
  );
  $args = array(
    'labels'        => $labels,
    'publicly_queryable' => true,
    'show_ui'            => true,
    'description'   => 'Published Post in Media Page the Ecocity Builder',
    'public'        => true,
    'capability_type' => 'post',
    'menu_position' => 5,
    'supports'      => array( 'title', 'editor', 'thumbnail', 'excerpt', 'comments', 'custom-fields', 'author', 'trackbacks' ),
    'has_archive'   => true,
  );
  register_post_type( 'media', $args );
}
add_action( 'init', 'my_custom_post_media' );


function my_updated_messages( $messages ) {
  global $post, $post_ID;
  $messages['media'] = array(
    0 => '',
    1 => sprintf( __('Media updated. <a href="%s">View media</a>'), esc_url( get_permalink($post_ID) ) ),
    2 => __('Custom field updated.'),
    3 => __('Custom field deleted.'),
    4 => __('Mediat updated.'),
    5 => isset($_GET['revision']) ? sprintf( __('Media restored to revision from %s'), wp_post_revision_title( (int) $_GET['revision'], false ) ) : false,
    6 => sprintf( __('Media published. <a href="%s">View media</a>'), esc_url( get_permalink($post_ID) ) ),
    7 => __('Media saved.'),
    8 => sprintf( __('Meida submitted. <a target="_blank" href="%s">Preview media</a>'), esc_url( add_query_arg( 'preview', 'true', get_permalink($post_ID) ) ) ),
    9 => sprintf( __('Media scheduled for: <strong>%1$s</strong>. <a target="_blank" href="%2$s">Preview media</a>'), date_i18n( __( 'M j, Y @ G:i' ), strtotime( $post->post_date ) ), esc_url( get_permalink($post_ID) ) ),
    10 => sprintf( __('Media draft updated. <a target="_blank" href="%s">Preview media</a>'), esc_url( add_query_arg( 'preview', 'true', get_permalink($post_ID) ) ) ),
  );
  return $messages;
}
add_filter( 'post_updated_messages', 'my_updated_messages' );


function my_contextual_help( $contextual_help, $screen_id, $screen ) {
  if ( 'media' == $screen->id ) {

    $contextual_help = '<h2>Media</h2>
    <p>Post media show the articles in the website Media page. You can see a list of them on this page in reverse chronological order - the latest one we added is first.</p>
    <p>You can view/edit the details of each product by clicking on its name, or you can perform bulk actions using the dropdown menu and selecting multiple items.</p>';

  } elseif ( 'edit-media' == $screen->id ) {

    $contextual_help = '<h2>Editing media</h2>
    <p>This page allows you to view/modify media details. Please make sure to fill out the available boxes with the appropriate details (product image, price, brand) and <strong>not</strong> add these details to the product description.</p>';

  }
  return $contextual_help;
}
add_action( 'contextual_help', 'my_contextual_help', 10, 3 );

function my_taxonomies_media() {
  $labels = array(
    'name'              => _x( 'Media Categories', 'taxonomy general name' ),
    'singular_name'     => _x( 'Media Category', 'taxonomy singular name' ),
    'search_items'      => __( 'Search Media Categories' ),
    'all_items'         => __( 'All Media Categories' ),
    'parent_item'       => __( 'Parent Media Category' ),
    'parent_item_colon' => __( 'Parent Media Category:' ),
    'edit_item'         => __( 'Edit Media Category' ),
    'update_item'       => __( 'Update Media Category' ),
    'add_new_item'      => __( 'Add New Media Category' ),
    'new_item_name'     => __( 'New Media Category' ),
    'menu_name'         => __( 'Media Categories' ),
  );
  $args = array(
    'labels' => $labels,
    'hierarchical' => true,
  );
  register_taxonomy( 'media_category', 'media', $args );
}
add_action( 'init', 'my_taxonomies_media', 0 );


/*
* Custom Post Staff
*/

function my_custom_post_staff() {
  $labels = array(
    'name'               => _x( 'Staff Member', 'post type general name' ),
    'singular_name'      => _x( 'Staff Member', 'post type singular name' ),
    'add_new'            => _x( 'Add New', 'book' ),
    'add_new_item'       => __( 'Add New Staff Member' ),
    'edit_item'          => __( 'Edit Staff Member' ),
    'new_item'           => __( 'New Staff Member' ),
    'all_items'          => __( 'All Staff Members' ),
    'view_item'          => __( 'View Staff Member' ),
    'search_items'       => __( 'Search Staff Member' ),
    'not_found'          => __( 'No Staff Member found' ),
    'not_found_in_trash' => __( 'No Staff Member found in the Trash' ),
    'parent_item_colon'  => '',
    'menu_name'          => 'Staff Member Post'
  );
  $args = array(
    'labels'        => $labels,
    'description'   => 'Published Post in Staff Member Page the Ecocity Builder ',
    'public'        => true,
    'menu_position' => 6,
    'supports'      => array( 'title', 'editor', 'thumbnail'),
    'has_archive'   => true,
  );
  register_post_type( 'staff', $args );
}
add_action( 'init', 'my_custom_post_staff' );


function my_updated_messages_staff( $messages ) {
  global $post, $post_ID;
  $messages['staff'] = array(
    0 => '',
    1 => sprintf( __('Staff Member updated. <a href="%s">View Staff Member</a>'), esc_url( get_permalink($post_ID) ) ),
    2 => __('Custom field updated.'),
    3 => __('Custom field deleted.'),
    4 => __('Staff Member updated.'),
    5 => isset($_GET['revision']) ? sprintf( __('Staff Member restored to revision from %s'), wp_post_revision_title( (int) $_GET['revision'], false ) ) : false,
    6 => sprintf( __('Staff Member published. <a href="%s">View Staff Member</a>'), esc_url( get_permalink($post_ID) ) ),
    7 => __('Staff Member saved.'),
    8 => sprintf( __('Staff Member submitted. <a target="_blank" href="%s">Preview Staff Member</a>'), esc_url( add_query_arg( 'preview', 'true', get_permalink($post_ID) ) ) ),
    9 => sprintf( __('Staff Member scheduled for: <strong>%1$s</strong>. <a target="_blank" href="%2$s">Preview Staff Member</a>'), date_i18n( __( 'M j, Y @ G:i' ), strtotime( $post->post_date ) ), esc_url( get_permalink($post_ID) ) ),
    10 => sprintf( __('Staff Member draft updated. <a target="_blank" href="%s">Preview Staff Member</a>'), esc_url( add_query_arg( 'preview', 'true', get_permalink($post_ID) ) ) ),
  );
  return $messages;
}
add_filter( 'post_updated_messages', 'my_updated_messages_staff' );



/**

 * Twenty Sixteen only works in WordPress 4.4 or later.
 */
if ( version_compare( $GLOBALS['wp_version'], '4.4-alpha', '<' ) ) {
	require get_template_directory() . '/inc/back-compat.php';
}

if ( ! function_exists( 'twentysixteen_setup' ) ) :
/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which
 * runs before the init hook. The init hook is too late for some features, such
 * as indicating support for post thumbnails.
 *
 * Create your own twentysixteen_setup() function to override in a child theme.
 *
 * @since Twenty Sixteen 1.0
 */
function twentysixteen_setup() {
	/*
	 * Make theme available for translation.
	 * Translations can be filed at WordPress.org. See: https://translate.wordpress.org/projects/wp-themes/twentysixteen
	 * If you're building a theme based on Twenty Sixteen, use a find and replace
	 * to change 'twentysixteen' to the name of your theme in all the template files
	 */
	load_theme_textdomain( 'twentysixteen' );

	// Add default posts and comments RSS feed links to head.
	add_theme_support( 'automatic-feed-links' );

	/*
	 * Let WordPress manage the document title.
	 * By adding theme support, we declare that this theme does not use a
	 * hard-coded <title> tag in the document head, and expect WordPress to
	 * provide it for us.
	 */
	add_theme_support( 'title-tag' );

	/*
	 * Enable support for custom logo.
	 *
	 *  @since Twenty Sixteen 1.2
	 */
	add_theme_support( 'custom-logo', array(
		'height'      => 240,
		'width'       => 240,
		'flex-height' => true,
	) );

	/*
	 * Enable support for Post Thumbnails on posts and pages.
	 *
	 * @link http://codex.wordpress.org/Function_Reference/add_theme_support#Post_Thumbnails
	 */
	add_theme_support( 'post-thumbnails' );
	set_post_thumbnail_size( 1200, 9999 );

	// This theme uses wp_nav_menu() in two locations.
	register_nav_menus( array(
		'primary' => __( 'Primary Menu', 'twentysixteen' ),
		'social'  => __( 'Social Links Menu', 'twentysixteen' ),
		'top'  => __( 'Top navbar ', 'twentysixteen' ),
    'media' => __('Media Menu', 'twentysixteen'),
		'donate_menu' => __('Donate button', 'twentysixteen')
	) );

	/*
	 * Switch default core markup for search form, comment form, and comments
	 * to output valid HTML5.
	 */
	add_theme_support( 'html5', array(
		'search-form',
		'comment-form',
		'comment-list',
		'gallery',
		'caption',
	) );

	/*
	 * Enable support for Post Formats.
	 *
	 * See: https://codex.wordpress.org/Post_Formats
	 */
	add_theme_support( 'post-formats', array(
		'aside',
		'image',
		'video',
		'quote',
		'link',
		'gallery',
		'status',
		'audio',
		'chat',
	) );

	/*
	 * This theme styles the visual editor to resemble the theme style,
	 * specifically font, colors, icons, and column width.
	 */
	add_editor_style( array( 'css/editor-style.css', twentysixteen_fonts_url() ) );

	// Indicate widget sidebars can use selective refresh in the Customizer.
	add_theme_support( 'customize-selective-refresh-widgets' );
}
endif; // twentysixteen_setup
add_action( 'after_setup_theme', 'twentysixteen_setup' );

/**
 * Sets the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 *
 * @since Twenty Sixteen 1.0
 */
function twentysixteen_content_width() {
	$GLOBALS['content_width'] = apply_filters( 'twentysixteen_content_width', 840 );
}
add_action( 'after_setup_theme', 'twentysixteen_content_width', 0 );

/**
 * Registers a widget area.
 *
 * @link https://developer.wordpress.org/reference/functions/register_sidebar/
 *
 * @since Twenty Sixteen 1.0
 */
function twentysixteen_widgets_init() {
	register_sidebar( array(
		'name'          => __( 'Sidebar', 'twentysixteen' ),
		'id'            => 'sidebar-1',
		'description'   => __( 'Add widgets here to appear in your sidebar.', 'twentysixteen' ),
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
	) );

        register_sidebar( array(
		'name'          => __( 'Content Blog', 'twentysixteen' ),
		'id'            => 'navigation',
		'description'   => __( 'Appears at the bottom of the content on posts and pages.', 'twentysixteen' ),
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
	) );
         register_sidebar( array(
		'name'          => __( 'Content Home', 'twentysixteen' ),
		'id'            => 'block-home',
		'description'   => __( 'Appears at the bottom of the content on posts and pages.', 'twentysixteen' ),
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
	) );
}
add_action( 'widgets_init', 'twentysixteen_widgets_init' );

if ( ! function_exists( 'twentysixteen_fonts_url' ) ) :
/**
 * Register Google fonts for Twenty Sixteen.
 *
 * Create your own twentysixteen_fonts_url() function to override in a child theme.
 *
 * @since Twenty Sixteen 1.0
 *
 * @return string Google fonts URL for the theme.
 */
function twentysixteen_fonts_url() {
	$fonts_url = '';
	$fonts     = array();
	$subsets   = 'latin,latin-ext';

	/* translators: If there are characters in your language that are not supported by Merriweather, translate this to 'off'. Do not translate into your own language. */
	if ( 'off' !== _x( 'on', 'Merriweather font: on or off', 'twentysixteen' ) ) {
		$fonts[] = 'Merriweather:400,700,900,400italic,700italic,900italic';
	}

	/* translators: If there are characters in your language that are not supported by Montserrat, translate this to 'off'. Do not translate into your own language. */
	if ( 'off' !== _x( 'on', 'Montserrat font: on or off', 'twentysixteen' ) ) {
		$fonts[] = 'Montserrat:400,700';
	}

	/* translators: If there are characters in your language that are not supported by Inconsolata, translate this to 'off'. Do not translate into your own language. */
	if ( 'off' !== _x( 'on', 'Inconsolata font: on or off', 'twentysixteen' ) ) {
		$fonts[] = 'Inconsolata:400';
	}

	if ( $fonts ) {
		$fonts_url = add_query_arg( array(
			'family' => urlencode( implode( '|', $fonts ) ),
			'subset' => urlencode( $subsets ),
		), 'https://fonts.googleapis.com/css' );
	}

	return $fonts_url;
}
endif;

/**
 * Handles JavaScript detection.
 *
 * Adds a `js` class to the root `<html>` element when JavaScript is detected.
 *
 * @since Twenty Sixteen 1.0
 */
function twentysixteen_javascript_detection() {
	echo "<script>(function(html){html.className = html.className.replace(/\bno-js\b/,'js')})(document.documentElement);</script>\n";
}
add_action( 'wp_head', 'twentysixteen_javascript_detection', 0 );

/**
 * Enqueues scripts and styles.
 *
 * @since Twenty Sixteen 1.0
 */
function twentysixteen_scripts() {

	// Theme stylesheet.
	wp_enqueue_style( 'twentysixteen-style',  get_template_directory_uri() . '/css/styles.css' );



	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}

	if ( is_singular() && wp_attachment_is_image() ) {
		wp_enqueue_script( 'twentysixteen-keyboard-image-navigation', get_template_directory_uri() . '/js/keyboard-image-navigation.js', array( 'jquery' ), '20160816' );
	}

	wp_enqueue_script( 'twentysixteen-script', get_template_directory_uri() . '/js/functions.js', array( 'jquery' ), '20160816', true );

	wp_localize_script( 'twentysixteen-script', 'screenReaderText', array(
		'expand'   => __( 'expand child menu', 'twentysixteen' ),
		'collapse' => __( 'collapse child menu', 'twentysixteen' ),
	) );
}
add_action( 'wp_enqueue_scripts', 'twentysixteen_scripts' );

/**
 * Adds custom classes to the array of body classes.
 *
 * @since Twenty Sixteen 1.0
 *
 * @param array $classes Classes for the body element.
 * @return array (Maybe) filtered body classes.
 */
function twentysixteen_body_classes( $classes ) {
	// Adds a class of custom-background-image to sites with a custom background image.
	if ( get_background_image() ) {
		$classes[] = 'custom-background-image';
	}

	// Adds a class of group-blog to sites with more than 1 published author.
	if ( is_multi_author() ) {
		$classes[] = 'group-blog';
	}

	// Adds a class of no-sidebar to sites without active sidebar.
	if ( ! is_active_sidebar( 'sidebar-1' ) ) {
		$classes[] = 'no-sidebar';
	}

	// Adds a class of hfeed to non-singular pages.
	if ( ! is_singular() ) {
		$classes[] = 'hfeed';
	}

	return $classes;
}
add_filter( 'body_class', 'twentysixteen_body_classes' );

/**
 * Converts a HEX value to RGB.
 *
 * @since Twenty Sixteen 1.0
 *
 * @param string $color The original color, in 3- or 6-digit hexadecimal form.
 * @return array Array containing RGB (red, green, and blue) values for the given
 *               HEX code, empty array otherwise.
 */
function twentysixteen_hex2rgb( $color ) {
	$color = trim( $color, '#' );

	if ( strlen( $color ) === 3 ) {
		$r = hexdec( substr( $color, 0, 1 ).substr( $color, 0, 1 ) );
		$g = hexdec( substr( $color, 1, 1 ).substr( $color, 1, 1 ) );
		$b = hexdec( substr( $color, 2, 1 ).substr( $color, 2, 1 ) );
	} else if ( strlen( $color ) === 6 ) {
		$r = hexdec( substr( $color, 0, 2 ) );
		$g = hexdec( substr( $color, 2, 2 ) );
		$b = hexdec( substr( $color, 4, 2 ) );
	} else {
		return array();
	}

	return array( 'red' => $r, 'green' => $g, 'blue' => $b );
}

/**
 * Custom template tags for this theme.
 */
require get_template_directory() . '/inc/template-tags.php';

/**
 * Customizer additions.
 */
require get_template_directory() . '/inc/customizer.php';

/**
 * Add custom image sizes attribute to enhance responsive image functionality
 * for content images
 *
 * @since Twenty Sixteen 1.0
 *
 * @param string $sizes A source size value for use in a 'sizes' attribute.
 * @param array  $size  Image size. Accepts an array of width and height
 *                      values in pixels (in that order).
 * @return string A source size value for use in a content image 'sizes' attribute.
 */
function twentysixteen_content_image_sizes_attr( $sizes, $size ) {
	$width = $size[0];

	840 <= $width && $sizes = '(max-width: 709px) 85vw, (max-width: 909px) 67vw, (max-width: 1362px) 62vw, 840px';

	if ( 'page' === get_post_type() ) {
		840 > $width && $sizes = '(max-width: ' . $width . 'px) 85vw, ' . $width . 'px';
	} else {
		840 > $width && 600 <= $width && $sizes = '(max-width: 709px) 85vw, (max-width: 909px) 67vw, (max-width: 984px) 61vw, (max-width: 1362px) 45vw, 600px';
		600 > $width && $sizes = '(max-width: ' . $width . 'px) 85vw, ' . $width . 'px';
	}

	return $sizes;
}
add_filter( 'wp_calculate_image_sizes', 'twentysixteen_content_image_sizes_attr', 10 , 2 );

/**
 * Add custom image sizes attribute to enhance responsive image functionality
 * for post thumbnails
 *
 * @since Twenty Sixteen 1.0
 *
 * @param array $attr Attributes for the image markup.
 * @param int   $attachment Image attachment ID.
 * @param array $size Registered image size or flat array of height and width dimensions.
 * @return string A source size value for use in a post thumbnail 'sizes' attribute.
 */
function twentysixteen_post_thumbnail_sizes_attr( $attr, $attachment, $size ) {
	if ( 'post-thumbnail' === $size ) {
		is_active_sidebar( 'sidebar-1' ) && $attr['sizes'] = '(max-width: 709px) 85vw, (max-width: 909px) 67vw, (max-width: 984px) 60vw, (max-width: 1362px) 62vw, 840px';
		! is_active_sidebar( 'sidebar-1' ) && $attr['sizes'] = '(max-width: 709px) 85vw, (max-width: 909px) 67vw, (max-width: 1362px) 88vw, 1200px';
	}
	return $attr;
}
add_filter( 'wp_get_attachment_image_attributes', 'twentysixteen_post_thumbnail_sizes_attr', 10 , 3 );

/**
 * Modifies tag cloud widget arguments to have all tags in the widget same font size.
 *
 * @since Twenty Sixteen 1.1
 *
 * @param array $args Arguments for tag cloud widget.
 * @return array A new modified arguments.
 */
function twentysixteen_widget_tag_cloud_args( $args ) {
	$args['largest'] = 1;
	$args['smallest'] = 1;
	$args['unit'] = 'em';
	return $args;
}
add_filter( 'widget_tag_cloud_args', 'twentysixteen_widget_tag_cloud_args' );

/**
* get top nav bar
*
*/
function get_top_navbar (){
	$menu_name = 'top';
	$locations = get_nav_menu_locations();
	$menu = wp_get_nav_menu_object( $locations[ $menu_name ] );
	$menuitems = wp_get_nav_menu_items( $menu->term_id, array( 'order' => 'DESC' ) );
	$return_li="";
	if ( empty($menuitems) ){
		return "";
	}
   foreach( $menuitems as $item ):
			$link = $item->url;
			$title = $item->title;
			$return_li .= '<a class="menuitem" href="'.$link.'">'.$title.'</a>';
    endforeach;

		//<a class="menuitem mobile-only" href="#"><button class="donate-button">DONATE</button></a>
		$return_li .= get_donate_menu(true);

    return $return_li;

}

function get_donate_menu ($isMobile) {
		$menu_name = 'donate_menu';
		$locations = get_nav_menu_locations();
		$menu = wp_get_nav_menu_object( $locations[ $menu_name ] );
		$menuitems = wp_get_nav_menu_items( $menu->term_id, array( 'order' => 'DESC' ) );
		$return_li="";

		if ( empty($menuitems) ){
			return "";
		}

		$link = $menuitems[0]->url;
		$title = $menuitems[0]->title;
		if ( empty($isMobile) ) {
			return  '<button class="donate-button">'
							.'<a href="'.$link.'">'.$title.'</a>'
							.'</button>';
		}else{
			return '<a class="menuitem mobile-only" href="'.$link.'"><button class="donate-button">'.$title.'</button></a>';
		}
}

function item_menu_has_children($id,$menuitems){

 foreach($menuitems as $item){
  if($id == $item->menu_item_parent)
   return true;
 }
 return false;
}

function get_primary_menu() {
  $menu_name = 'primary';
  $locations = get_nav_menu_locations();
  $menu = wp_get_nav_menu_object( $locations[ $menu_name ] );
  $menuitems = wp_get_nav_menu_items( $menu->term_id, array( 'order' => 'DESC' ) );
  $count = 0;
  $submenu = false;
  $return_li="";

  if ( empty($menuitems) ){
    return "";
  }
   foreach( $menuitems as $item ):
            $link = $item->url;
            $title = $item->title;
            // item does not have a parent so menu_item_parent equals 0 (false)
            if ( !$item->menu_item_parent ):
             // save this id for later comparison with sub-menu items
             $parent_id = $item->ID;
						 if(item_menu_has_children( $parent_id,$menuitems)):
			        	$return_li .= '<li class="menuitem" role="menuitem"><a href="'.$link.'" class="sub-menu-parent">'.$title.'</a>';
			       else:
			        	$return_li .= '<li class="menuitem" role="menuitem"><a href="'.$link.'">'.$title.'</a>';
			       endif;
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

	$return_li .= '<li class="menuitem desktop-only" role="menuitem">'
								.get_donate_menu (false)
								.'</li>';

  return $return_li;
}

function send_mail_ajax(){
  if((!isset($_POST['email']))||(trim($_POST['email']==""))||(!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL))){
    echo "email incorrecto";
    die();
  }

  if((!isset($_POST['text']))||(trim($_POST['text']==""))){
    echo "input incorrecto";
    die();
  }

  $headers = 'From: ecb@ecb.com'. "\r\n" .
      'MIME-Version: 1.0'. "\r\n" .
       'Reply-To:'.$_POST['email'] . "\r\n" .
      'Content-type: text/html; charset=utf-8';
  $status=wp_mail($_POST['email'], "form media page",$_POST['text'],$headers );
  die();

}

function secure_array_push (&$array, $element, $condition = 'undefined') {
  if ($element && ($condition == 'undefined' || ($condition && $condition != 'undefined'))) {
    array_push($array, $element);
  }
}

add_action('wp_ajax_nopriv_send_mail_ajax', 'send_mail_ajax');
add_action('wp_ajax_send_mail_ajax', 'send_mail_ajax');

/*add_action( 'admin_init', 'hide_editor' );

function hide_editor() {
  // Get the Post ID.
  $post_id = $_GET['post'] ? $_GET['post'] : $_POST['post_ID'] ;
  if( !isset( $post_id ) ) return;

  // Hide the editor on a page with a specific page template
  // Get the name of the Page Template file.
  $template_file = get_post_meta($post_id, '_wp_page_template', true);

  if($template_file == 'media.php' || $template_file == 'staff.php'){ // the filename of the page template
    remove_post_type_support('page', 'editor');
  }
}*/

function custom_remove() {
	remove_meta_box('add-post-type-media', 'nav-menus', 'side');
	remove_meta_box('Media', 'nav-menus', 'side');
}

add_action('admin_head-nav-menus.php', 'custom_remove');

function my_relationship_query( $args, $field, $post_id ) {
	$args = array(
		'post_type' => 'page',//it is a Page right?
		'post_status' => 'publish',
		'orderby'   => 'title',
		'order'     => 'ASC',
		'posts_per_page' => -1,
		'meta_query' => array(
		array(
			'key' => '_wp_page_template',
			'value' => 'article.php', // template name as stored in the dB
			)
		)
	);

return $args;

}
// filter for every field
add_filter('acf/fields/relationship/query/name=post_articles', 'my_relationship_query', 10, 4);
