<?php
/*
Template Name: Page Blog
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
  wp_reset_query();
  $paged = ( get_query_var( 'paged' ) ) ? absint( get_query_var( 'paged' ) ) : 1;
  $args = array(
    'posts_per_page' => 8,//change the number the post(8) as shown in the mockup
    'paged' => $paged,
  );

  $the_query = new WP_Query( $args );
?>

<?php get_header(); ?>
<main role="main" class="section--blog">

  <h1>Blog</h1>
  
  <section class="content">
    
    <?php get_navigation(); ?>

    <h2><?php _e('All articles'); ?></h2>
    <form  id="filter-form">
        <?php wp_dropdown_categories(array('name' => 'category')); ?>
        <?php wp_dropdown_users(array('name' => 'author')); ?>
        
        <select name='date' id="date-filter" class="filter-blog">
            <option value='DESC'>Newest First</option>
            <option value='ASC'>Oldest First</option>
         </select>
        <input id="btn-filter-blog" type="submit" name="submit" value="mostrar categorias" hidden/>
        
    </form>
    
    <section class="article-container" id="results">
      <!-- Articles injected here with ajax -->
    </section>

  </section>    
</main>

<?php get_footer(); ?>

