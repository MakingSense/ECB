<?php
/**
 * The main template file
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
get_header();
?>

<div id="primary" class="">
    <main id="main" class="site-main" role="main">

        <div>
            <h1>Insertar pilares (estatico)</h1>
        </div>
        <?php if (have_posts()) : ?>

            <?php if (is_home() && !is_front_page()) : ?>
                <header>
                    <h1 class="page-title screen-reader-text"><?php single_post_title(); ?></h1>
                </header>

            <?php endif; ?>

            <?php
//            // Start the loop.
//            $the_query = new WP_Query('blog=wordpress');
//            $media = new WP_Query('post_type=media');
//            $articles = new WP_Query('post_type=article');
//
//                $the_query->the_post();
//                get_template_part('template-parts/content', get_post_format());
//                $media->the_post();
//                get_template_part('template-parts/content-media', get_post_format());
//                $articles->the_post();
//                get_template_part('template-parts/content-article', get_post_format());

                // args the custom post type blog
                $args =  array(
                    'post_type' => array ('media', 'article', 'post'),
                        'numberposts'	=> -1,
                    'meta_query' => array(
                        array(
                            'key' => 'post_field',
                            'value' => 'first',
                        ),

                    ),
                );

                // query
                $the_query = new WP_Query( $args );
                ?>
                <?php if( $the_query->have_posts() ): ?>
                        <ul>
                        <?php while( $the_query->have_posts() ) : $the_query->the_post(); ?>
                                 <?php get_template_part('template-parts/content', get_post_format());?>
                        <?php endwhile; ?>
                        </ul>
                <?php endif; ?>

                <?php wp_reset_query();	 // Restore global post data stomped by the_post(). ?>

                <?php
                
                  // media_args the custom post type media
                $media_args =  array(
                    'post_type' => array ('media', 'article', 'post'),
                        'numberposts'	=> -1,
                    'meta_query' => array(
                        array(
                            'key' => 'post_field',
                            'value' => 'second',
                        ),

                    ),
                );

                // media_query
                $media_query = new WP_Query( $media_args );
                ?>
                <?php if( $media_query->have_posts() ): ?>
                        <ul>
                        <?php while( $media_query->have_posts() ) : $media_query->the_post(); ?>
                                 <?php get_template_part('template-parts/content-media', get_post_format()); ?>
                        <?php endwhile; ?>
                        </ul>
                <?php endif; ?>

                <?php wp_reset_query();	 // Restore global post data stomped by the_post(). ?>

                <?php
      
            // Previous/next page navigation.
            the_posts_pagination(array(
                'prev_text' => __('Previous page', 'twentysixteen'),
                'next_text' => __('Next page', 'twentysixteen'),
                'before_page_number' => '<span class="meta-nav screen-reader-text">' . __('Page', 'twentysixteen') . ' </span>',
            ));

        // If no content, include the "No posts found" template.
        else :
            get_template_part('template-parts/content', 'none');

        endif;
        ?>
        
    </main><!-- .site-main -->
</div><!-- .content-area -->
<?php get_footer(); ?>
