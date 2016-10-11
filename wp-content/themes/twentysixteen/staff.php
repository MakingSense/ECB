
<?php
/*
Template Name: Page Staff
*/
  get_header();
  wp_reset_postdata();
  $staff_posts=get_field('staff_posts',get_the_ID());
  
?>  

<main role="main" class="section--article">
  <section class="content">

    <?php foreach($staff_posts as $post) { ?>
    	<fieldset>
    		<legend>Member</legend>
    		<p>Nombre: <?=get_the_title()?></p>
    		<img src="<?=get_field('image',$post->ID)?>" />
    		<p>Position: <?=get_field('position',$post->ID)?></p>
    		<p><?php
    			$content = apply_filters('the_content', $post->post_content);
  				$content = str_replace(']]>', ']]&gt;', $content);
  				echo $content;	
    			?>
    		</p>
    	</fieldset>
    	<br />

    <?php } ?>
      

  </section>

</main>

<?php
  get_footer(); 
?>

