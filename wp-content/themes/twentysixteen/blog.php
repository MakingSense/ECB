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
                <h1>WE ARE PAGE BLOG</h1>
                <div>
                    <h2><?php _e('lista de autores:'); ?></h2>
                    <form action="<?php bloginfo('url'); ?>" method="get">
                        <?php wp_dropdown_users(array('name' => 'author')); ?>
                        <?php wp_dropdown_categories(array('name' => 'category')); ?>
                        <?php

                    $arc_query = "SELECT DISTINCT YEAR(post_date) AS yyear, MONTH(post_date) AS mmonth FROM $wpdb->posts WHERE post_type = 'attachment' ORDER BY post_date DESC";

                    $arc_result = $wpdb->get_results( $arc_query );

                    $month_count = count($arc_result);
                    $selected_month = isset( $_GET['m'] ) ? $_GET['m'] : 0;

                    if ( $month_count && !( 1 == $month_count && 0 == $arc_result[0]->mmonth ) ) { ?>
                    <select name='m' id="date-filter">
                        <option<?php selected( $selected_month, 0 ); ?> value='0'><?php _e( 'All dates' ); ?></option>
                        <?php
                        foreach ($arc_result as $arc_row) {
                            if ( $arc_row->yyear == 0 )
                                    continue;
                            $arc_row->mmonth = zeroise( $arc_row->mmonth, 2 );

                            if ( $arc_row->yyear . $arc_row->mmonth == $selected_month )
                                    $default = ' selected="selected"';
                            else
                                    $default = '';

                            echo "<option$default value='" . esc_attr( $arc_row->yyear . $arc_row->mmonth ) . "'>";
                            echo esc_html( $wp_locale->get_month($arc_row->mmonth) . " $arc_row->yyear" );
                            echo "</option>\n";
                        }
                        ?>
                    </select>
                    <?php } ?>
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
                    <?php while ($the_query->have_posts()) : $the_query->the_post(); ?>
                            <div class="">
                                        <h2><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
                            </div><!-- .dslc-blog-post-title -->
                            <div class="">
                                    <?php the_time(get_option('date_format')); ?>
                            </div><!-- .dslc-blog-post-meta-date -->
                            <div class="">
                                    <span class="">
                                        <?php echo get_the_author_meta(); ?>
                                    </span>
                                        <?php _e('By', 'live-composer-page-builder'); ?> <?php the_author_posts_link(); ?>
                            </div><!-- .dslc-blog-post-meta-author -->

                            <div class="">
                                    <?php the_excerpt(''); ?>
                            </div><!-- .dslc-blog-post-excerpt -->
                          
                    <?php endwhile;?>
                          <?php
                            //Class to hidden the pagination number  is "hidden-numbers" 
                            $big = 999999999; // need an unlikely integer
                            echo paginate_links( array(
                                    'base' => str_replace( $big, '%#%', esc_url( get_pagenum_link( $big ) ) ),
                                    'format' => '?paged=%#%',
                                    'current' => max( 1, get_query_var('paged') ),
                                    'total' => $the_query->max_num_pages,
                                    'show_all'    => false,
                                    'mid_size' => 1,
                                    'prev_text'   => __('<span class="" style="inline"></span>'),
                                    'next_text'   => __('<span class="" style="inline">See more</span>'),

                            ) );
                            ?> 

                </main><!-- .site-main -->        
            </div><!-- .content-area -->
<?php get_footer(); ?>

<script>
    jQuery(document).ready(
        jQuery('#date-filter').change(function(){
          console.log('holaaaaaaaa');  
          jQuery('#btn-filter-blog').click();
        }
        )
        
//            $.ajax({ 
//                type: "POST", 
//                url: "some.php", 
//                data: "name=John&location=Boston", 
//                success: function(msg){ 
//                //Aqui lo que hara con la respuesta del PHP. 
//                alert( "Respuesta del PHP: " + msg ); 
//                } 
//                }); 
               
            )
</script>