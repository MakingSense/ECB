<?php
/**
 * The template for displaying all single posts and attachments
 *
 * @package WordPress
 * @subpackage Twenty_Sixteen
 * @since Twenty Sixteen 1.0
 */

get_header(); ?>

<div id="primary" class="content-area">
	<main id="main" class="section--post" role="main">
		<div class="hr-wrapper"><hr class="slim"></div>
		<section class="content">
			<?php
			// Start the loop.
			while ( have_posts() ) : the_post();
				// Include the single post content template.
				if($post->post_type=="post")
					get_template_part( 'template-parts/content', 'post' );
				else
					get_template_part( 'template-parts/content', 'single' );
				// End of the loop.
			endwhile;
			?>
		</section>
	</main><!-- .site-main -->

	<?php get_sidebar( 'content-bottom' ); ?>

	<div style="clear: both;"></div>

</div><!-- .content-area -->
<?php get_footer(); ?>
