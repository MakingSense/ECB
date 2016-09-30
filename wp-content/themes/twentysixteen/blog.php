<?php
/*
Template Name: StyleBlog
*/
/**
 * The blog template file
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
         
            <div id="blog" class="content-area">
            <?php get_navigation(); ?>
                
                <div>
                    <h2><?php _e('All articles'); ?></h2>
                    <form  id="filter-form">
                        <?php wp_dropdown_categories(array('name' => 'category')); ?>
                        <?php wp_dropdown_users(array('name' => 'author')); ?>
                        
                        <select name='date' id="date-filter" class="filter-blog">
<!--                            <option value=''>Date</option>-->
                            <option value='DESC'>Newest First</option>
                            <option value='ASC'>Oldest First</option>
                         </select>
                        <input id="btn-filter-blog" type="submit" name="submit" value="mostrar categorias" hidden/>
                        
                    </form>
                </div>
               
                <?php
                wp_reset_query();
                ?>     
                <?php
                $paged = ( get_query_var( 'paged' ) ) ? absint( get_query_var( 'paged' ) ) : 1;
                $args = array(
                        'posts_per_page' => 2,//change the number the post(8) as shown in the mockup
                        'paged' => $paged,
                );

                $the_query = new WP_Query( $args );
                ?>
                <!-- the loop etc.. -->
                <main id="main" class="site-main" role="main">
                    
		<div id="results"> <!-- content will be loaded here --></div>


                </main><!-- .site-main -->        
            </div><!-- .content-area -->
<?php get_footer(); ?>

