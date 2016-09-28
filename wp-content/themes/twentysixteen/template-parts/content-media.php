<?php


?>
<!-- Article with image -->
<article id="post-<?php the_ID(); ?>" class="right-aligned">

	<h2>Content Media</h2>
	<div class="wrapper">
		<?php twentysixteen_post_thumbnail(); ?>
		<div class="text">
				<?php the_title( sprintf( '<h3>', esc_url( get_permalink() ) ), '</h3>' ); ?>
			<h4><?php the_date(); ?></h4>
			<p>
				<?php
					/* translators: %s: Name of current post */
					the_content( sprintf(
						__( 'Read More<span class="screen-reader-text"> "%s"</span>', 'twentysixteen' ),
						get_the_title()
					) );

					wp_link_pages( array(
						'before'      => '<div class="page-links"><span class="page-links-title">' . __( 'Pages:', 'twentysixteen' ) . '</span>',
						'after'       => '</div>',
						'link_before' => '<span>',
						'link_after'  => '</span>',
						'pagelink'    => '<span class="screen-reader-text">' . __( 'Page', 'twentysixteen' ) . ' </span>%',
						'separator'   => '<span class="screen-reader-text">, </span>',
					) );
				?>
			</p>
			<div class="button-container"><button class="more-button">Learn More</button></div>
			<?php
				edit_post_link(
					sprintf(
						/* translators: %s: Name of current post */
						__( 'Edit<span class="screen-reader-text"> "%s"</span>', 'twentysixteen' ),
						get_the_title()
					),
					'<span class="edit-link">',
					'</span>'
				);
			?>
		</div>
	</div>
</article>
