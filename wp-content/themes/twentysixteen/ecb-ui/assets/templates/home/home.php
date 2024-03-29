<div class="main-wrapper home <?php if(is_home() == 1) echo "header-light"  ?>">
  <!-- build:include ../global/header/header.php --><!-- /build -->
  
  <main id="main" class="site-main section--home" role="main">

    <!-- build:include ../includes/jumbo/jumbo.php --><!-- /build -->
    <?php include_once(get_template_directory() .'/template-parts/four_pilars.php'); ?>


        <?php if (have_posts()) : ?>

            <?php if (is_home() && !is_front_page()) : ?>
                <header>
                    <h1 class="page-title screen-reader-text"><?php single_post_title(); ?></h1>
                </header>

            <?php endif; ?>

            <?php
                // args the custom post type blog
                $args =  array(
                    'post_type' => array ('media', 'article', 'post'),
                    'numberposts' => -1,
                    'meta_query' => array(
                        array(
                            'value' => 'first',
                        ),

                    ),
                );

                // query
                $the_query = new WP_Query( $args );
                ?>
                <?php if( $the_query->have_posts() ): ?>
                    <?php while( $the_query->have_posts() ) : $the_query->the_post(); ?>
                             <?php get_template_part('template-parts/content', get_post_format());?>
                    <?php endwhile; ?>
                <?php endif; ?>

                <?php wp_reset_query();  // Restore global post data stomped by the_post(). ?>

                <?php

                  // media_args the custom post type media
                $media_args =  array(
                    'post_type' => array ('media', 'article', 'post'),
                        'numberposts' => -1,
                    'meta_query' => array(
                        array(
                            'value' => 'second',
                        ),

                    ),
                );

                // media_query
                $media_query = new WP_Query( $media_args );
                ?>
                <?php if( $media_query->have_posts() ): ?>
                    <?php while( $media_query->have_posts() ) : $media_query->the_post(); ?>
                             <?php get_template_part('template-parts/content-media', get_post_format()); ?>
                    <?php endwhile; ?>
                <?php endif; ?>

                <?php wp_reset_query();  // Restore global post data stomped by the_post(). ?>

                 <?php
                // args the custom post type blog
                $args =  array(
                    'post_type' => array ('media', 'article', 'post'),
                        'numberposts' => -1,
                    'meta_query' => array(
                        array(
                            'value' => 'third',
                        ),

                    ),
                );

                // query
                $the_query = new WP_Query( $args );
                ?>
                <?php if( $the_query->have_posts() ): ?>
                        <ul>
                        <?php while( $the_query->have_posts() ) : $the_query->the_post(); ?>
                                 <?php get_template_part('template-parts/content-article', get_post_format());?>
                        <?php endwhile; ?>
                        </ul>
                <?php endif; ?>

                <?php wp_reset_query();  // Restore global post data stomped by the_post(). ?>
                <?php
                //posts
                    $args = array(
                     'posts_per_page'   => 5,
                     'offset'           => 0,
                     'orderby'          => 'date',
                     'order'            => 'DESC',
                     'post_type'        => 'post',
                     'post_status'      => 'publish',
                     'suppress_filters' => true
                    );
                    $blog_array = new WP_Query( $args );
                ?>

                <div class="blog-wrapper desktop-only">
                    <h2>Ecocity World Summit</h2>
                    <div class="blog-page owl-carousel">
                        <?php if( $blog_array->have_posts() ): ?>
                            <?php while( $blog_array->have_posts() ) : $blog_array->the_post(); ?>
                                <?php get_template_part('template-parts/content-blog', get_post_format()); ?>
                            <?php endwhile; ?>
                        <?php endif; ?>
                    </div>
                </div>

                <div class="blog-wrapper mobile-only">
                    <h2>Ecocity World Summit</h2>
                    <div class="blog-page owl-carousel">
                        <?php if( $blog_array->have_posts() ): ?>
                            <?php while( $blog_array->have_posts() ) : $blog_array->the_post(); ?>
                                <?php get_template_part('template-parts/content-blog', get_post_format()); ?>
                            <?php endwhile; ?>
                        <?php endif; ?>
                    </div>
                </div>

                <?php wp_reset_query();  // Restore global post data stomped by the_post(). ?>


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


        get_blockhome();
        include_once(get_template_directory() .'/template-parts/twitter-facebook.php');
        ?>

    </main><!-- .site-main -->
  <!-- build:include ../global/footer/footer.php --><!-- /build -->
</div>