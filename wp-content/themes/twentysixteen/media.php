<?php
/*
Template Name: Page Media
*/
/**
 * The media template file
 *
 * This is the most generic template file in a WordPress theme
 * and one of the two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query.
 * E.g., it puts together the home page when no home.php file exists.
 *
 * @link http://codex.wordpress.org/Template_Hierarchy
 *
 * @package WordPress
 * @subpackage Twenty_Sixteen
 * @since Twenty Sixteen 1.0
 */
get_header(); ?>  
    <div>
          <?php get_blockmedia() ?>
    </div>
<?php              
$box="<ul>";
$args = array(
    'post_type' => 'media',
    'meta_key'		=> 'show_list_media_page',
	'meta_value'	=> 'Yes',
	'posts_per_page' => 6
	

    );


$the_query = new WP_Query( $args );?>

<?php if ( $the_query->have_posts() ) : ?>
  <?php while ( $the_query->have_posts() ) : $the_query->the_post(); ?>
    
  	<?php $box.="<li><a href='#".$post->post_name."'>".get_the_title()."</a></li>";?>
    
    
 <?php endwhile; ?>
    <!-- end of the loop -->
 
    <!-- pagination here -->
 
    <?php wp_reset_postdata(); ?>

<?php endif; ?>
<?php $box.="</ul>";

wp_reset_query();

$args = array(
    'post_type' => 'media',
    'meta_key'		=> 'show_list_media_page',
	'meta_value'	=> 'Yes',
	'posts_per_page' => 6
	

    );

$the_query = new WP_Query( $args );?>

<div id="primary" class="content-area">
	<main id="main" class="site-main" role="main">
	<?php if ( $the_query->have_posts() ) : ?>
		 	<?php while ( $the_query->have_posts() ) : $the_query->the_post(); ?>
			<div><?=$box?></div>
			<div id="<?=$post->post_name?>"><?=	get_the_title()?></div>
			<?php endwhile; ?>
		    <!-- end of the loop -->
		 
		    <?php wp_reset_postdata(); ?>
	<?php endif; ?>		

        </main>


</div><!-- .content-area -->  
<?php get_footer(); ?>


