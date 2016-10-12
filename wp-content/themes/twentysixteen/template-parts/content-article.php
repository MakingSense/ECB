<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<header class="entry-header-article">
		<?php if ( is_sticky() && is_home() && ! is_paged() ) : ?>
			<span class="sticky-post"><?php _e( 'Featured', 'twentysixteen' ); ?></span>
		<?php endif; ?>

		<?php the_title( sprintf( '<h3>', esc_url( get_permalink() ) ), '</h3>' ); ?>
                
    <h4><?php the_date(); ?><h4>
	</header>

	<?php twentysixteen_excerpt(); ?>
	<?php twentysixteen_post_thumbnail(); ?>

	<div class="text">
		<?php custom_excerpt_length(the_excerpt()); ?> 
	</div>
        
	<footer class="entry-footer">
		<?php
      edit_post_link(
          sprintf(
            __( '<div><a class="button-container"><button class="more-button">Learn More</button></a></div>', 'twentysixteen' ),
            get_the_title()
          ),
          '<span class="edit-link">',
          '</span>'
        );       
		?>
	</footer>
</article>




