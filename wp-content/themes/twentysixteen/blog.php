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
                <h1>ESTAMOS EN EL BLOG</h1>
                <main id="main" class="site-main" role="main">



                    <ul>

                        <?php $the_query = new WP_Query('blog=wordpress&showposts=1'); ?>
            <?php while ($the_query->have_posts()) : $the_query->the_post(); ?>

                                <li>

                                    <div class="dslc-blog-post-title">
                                        <h2><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
                                    </div><!-- .dslc-blog-post-title -->
                                    <div class="dslc-blog-post-meta-date">
                <?php the_time(get_option('date_format')); ?>
                                    </div><!-- .dslc-blog-post-meta-date -->
                                    <div class="dslc-blog-post-meta-author">
                                        <span class="dslc-blog-post-meta-avatar">
                                    <?php echo get_the_author_meta(); ?>
                                        </span>
                <?php _e('By', 'live-composer-page-builder'); ?> <?php the_author_posts_link(); ?>
                                    </div><!-- .dslc-blog-post-meta-author -->

                                    <div class="dslc-blog-post-excerpt">

                                    <?php
                                    the_excerpt('');
                                    ?>

                                    </div><!-- .dslc-blog-post-excerpt -->

                                    <!--                                         <div class="dslc-blog-post-read-more">
                                                                                 <a href="<?php the_permalink(); ?>">

                                                                                         <span class="dslc-icon dslc-icon-<?php echo $options['button_icon_id']; ?>">read more</span>

                <?php echo $options['button_text']; ?>
                                                                                 </a>
                                                                             </div> .dslc-blog-post-read-more -->


                                </li>

            <?php endwhile; ?>

                    </ul>
                </main><!-- .site-main -->        
            </div><!-- .content-area -->


<?php get_footer(); ?>

