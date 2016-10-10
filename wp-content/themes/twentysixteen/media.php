<?php
/*
Template Name: Page Media
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
get_header(); ?>  
 <!-- build:include ../global/header/header.html --><!-- /build -->

<?php


	$media_posts=get_field('media_posts',get_the_ID());

	if(get_field('navigation_visible',get_the_ID())=="Yes"){
		$box="<aside class='desktop-only'><ul>";
		foreach($media_posts as $mp ){
			$box.="<li><a href='#".$mp->post_name."'>".get_the_title($mp->ID)."</a></li>";
		}
		$box.="</ul></aside>";

		wp_reset_query();


	}
?>
    <main role="main" class="section--media"> 
	   <section class="content">
	   <?php get_blockmedia() ?>
			<section class="medias">
			<?php foreach ($media_posts as $mp) {?>
                <hr>
		 		<article class="media">	
					<?php
					if(get_field('navigation_visible',get_the_ID())=="Yes"){
						echo $box;
					}	
					?>
					<div class="text" id="<?=$mp->post_name?>">
						<h2><?=	get_the_title($mp->ID)?></h2>
						<p><?php 
							$content = apply_filters('the_content', $mp->post_content);
  							$content = str_replace(']]>', ']]&gt;', $content);
  							echo $content;	
							?>
						<?php if(get_field('image_feature', $mp->ID)){?>
							<div class="video">
                				<img src="<?=get_field('image_feature',$mp->ID)?>?txtsize=33&txt=350%C3%97150&w=556&h=377"/>
              				</div>

					<?php } ?>

					<?php if(get_field('video',$mp->ID)){?>
							<iframe width="420" height="315"
								src="<?=get_field('video',$mp->ID)?>">
							</iframe>
							

					<?php } ?>

					<?php if((get_field('image_1',$mp->ID))&& (get_field('image_2',$mp->ID)) ){?>
					<div class="video-collection desktop-only">
                		<div class="video">
                		<?php if(get_field('link_image_1',$mp->ID)){?>
                		<a href="<?=get_field('link_image_1',get_the_ID())?>" target="_blank">
                		<?php }?>
                		<img src="<?=get_field('image_1',$mp->ID)?>?txtsize=33&txt=350%C3%97150&w=268&h=180">
                		<?php if(get_field('link_image_1',$mp->ID)){?>
                		</a>
                		<?php }?>
                		</div>
                		<div class="video">
                		<?php if(get_field('link_image_2',$mp->ID)){?>
                		<a href="<?=get_field('link_image_2',$mp->ID)?>" target="_blank">
                		<?php }?>                		
                		<img src="<?=get_field('image_2',$mp->ID)?>?txtsize=33&txt=350%C3%97150&w=268&h=180">
             			<?php if(get_field('link_image_2',$mp->ID)){?>
                		</a>
                		<?php }?>                		
                		</div>
              		</div>

	              <div class="video-collection mobile-only owl-carousel">
	                <div class="video">
                	<?php if(get_field('link_image_1',$mp->ID)){?>
                	<a href="<?=get_field('link_image_1',$mp->ID)?>" target="_blank">
                	<?php }?>	                
	                <img src="<?=get_field('image_1',$mp->ID)?>?txtsize=33&txt=350%C3%97150&w=268&h=180">
                	<?php if(get_field('link_image_1',$mp->ID)){?>
                	</a>
                	<?php }?>	                
	                </div>
	                <div class="video">
                	<?php if(get_field('link_image_2',$mp->ID)){?>
                	<a href="<?=get_field('link_image_2',get_the_ID())?>" target="_blank">
                	<?php }?>    	                
	                <img src="<?=get_field('image_2',$mp->ID)?>?txtsize=33&txt=350%C3%97150&w=268&h=180">
	       			<?php if(get_field('link_image_2',$mp->ID)){?>
               		</a>
               		<?php }?>     
	                </div>
	              </div>
								

					<?php } ?>
					<?php if( (get_field('form',$mp->ID)=='Yes')&& (get_field('email_to_send',$mp->ID)) && (get_field('text_button',$mp->ID)) && (get_field('placeholder',$mp->ID)) ) {?>
					 <form id="form-<?=get_the_ID();?>"class="apply-container">
		                <label>
		                  <input type="text" name="email" placeholder="<?=get_field('placeholder',$mp->ID)?>">
		                </label>
		                <button class="submit-button media-submit-button"><?=get_field('text_button',$mp->ID)?></button>
		                <span class="submit-message">Submit Message</span>
		                <input type="hidden" name="to_send" value="<?=get_field('email_to_send',$mp->ID);?>"/>
		                <input type="hidden" name="url" value="<?=get_home_url();?>"/>
		              </form>
		            <?php }?>  

					</p>	
					</div>

			          
        		</article>
        
      		
			<?php } ?>
		 
		    <?php wp_reset_postdata(); ?>
			

		</section>
	</section>	

	</main>


 
<?php get_footer(); ?>


