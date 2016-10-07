<?php
/*
Template Name: Page Article
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
get_header();

wp_reset_postdata();
 ?>  
	<main role="main" class="section--media"> 
	   <section class="content">
	   <fieldset style="border:1px solid">
	   <div><h1><?=get_the_title(); ?></h1></div>
	   <div><p><?php the_content(); ?></p></div>
	   </fieldset>
	   <fieldset style="border:1px solid">
	   	<legend>Author data</legend>
	   	<div>
	   	<label>Foto</label>
	   	<p><?= get_avatar($post->post_author);?></p>
	   	<label>Biografia</label>
	   	<p><?=nl2br(get_the_author_meta("description", $post->post_author))?></p>

	   	</div>
	   </fieldset>
	   <fieldset style="border:1px solid">
	   	<legend>quote</legend>
	   	<?php if(get_field('quote',get_the_ID())) {?>
	   		<p><?=get_field('quote',get_the_ID())?></p>
	   	<?php } ?>

	   </fieldset>
	   <fieldset style="border:1px solid">
	   <legend>Images Carrousel</legend>
		<?php if(get_field('image_1',get_the_ID())){?>
		<div class="video">
    		<img src="<?=get_field('image_1',get_the_ID())?>?txtsize=33&txt=350%C3%97150&w=556&h=377"/>
    	</div>

		<?php } ?>
		<?php if(get_field('image_2',get_the_ID())){?>
		<div class="video">
    		<img src="<?=get_field('image_2',get_the_ID())?>?txtsize=33&txt=350%C3%97150&w=556&h=377"/>
    	</div>

		<?php } ?>
		<?php if(get_field('image_3',get_the_ID())){?>
		<div class="video">
    		<img src="<?=get_field('image_3',get_the_ID())?>?txtsize=33&txt=350%C3%97150&w=556&h=377"/>
    	</div>

		<?php } ?>		
		<?php if(get_field('image_4',get_the_ID())){?>
		<div class="video">
    		<img src="<?=get_field('image_4',get_the_ID())?>?txtsize=33&txt=350%C3%97150&w=556&h=377"/>
    	</div>

		<?php } ?>		

	   </fieldset>
	   <fieldset style="border:1px solid">
	   <legend>Content 2</legend>
	   	<?php if(get_field('content_2',get_the_ID())) {?>
	   		<p><?=get_field('content_2',get_the_ID())?></p>
	   	<?php } ?>

	   </fieldset>

	   	   <fieldset style="border:1px solid">
	   <legend>Images Sidebar</legend>
		<?php if(get_field('image_sidebar_1',get_the_ID())){?>
		<div class="video">
    		<img src="<?=get_field('image_sidebar_1',get_the_ID())?>?txtsize=33&txt=350%C3%97150&w=556&h=377"/>
    	</div>

		<?php } ?>
		<?php if(get_field('image_sidebar_2',get_the_ID())){?>
		<div class="video">
    		<img src="<?=get_field('image_sidebar_2',get_the_ID())?>?txtsize=33&txt=350%C3%97150&w=556&h=377"/>
    	</div>

		<?php } ?>
		<?php if(get_field('image_sidebar_3',get_the_ID())){?>
		<div class="video">
    		<img src="<?=get_field('image_sidebar_3',get_the_ID())?>?txtsize=33&txt=350%C3%97150&w=556&h=377"/>
    	</div>

		<?php } ?>		


	   </section>
	</main>   
<?php
	get_footer(); ?>

