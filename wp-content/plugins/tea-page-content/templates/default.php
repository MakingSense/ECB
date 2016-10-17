<?php 
/**
 * @param is-padded checkbox 0
 */

// prevention for old version of this plugin, @deprecated since 1.1
$isPadded = false;
if(isset($template_variables['is-padded']) && $template_variables['is-padded']) {
	$isPadded = true;
}?>

<?php if(isset($instance['title']) && $caller === 'shortcode') : ?>
	<h2 class="tpc-shortcode-main-title"><?php echo $instance['title']; ?></h2>
<?php endif; ?>

<?php if(isset($entries) && $count) : ?>
<section class="component--featured">

	<div class="article-wrapper">
		<section class="article-container desktop-only">
			<?php foreach ($entries as $key => $entry) : ?>  
				<article class="article featured">
					<div class="wrapper" style="background-image: <?= ($entry['link_thumbnail']) ? 'url('. $entry['link_thumbnail'] . ')' : '';  ?>; "   href="<?php echo $entry['link'] ?>">
						<div class="text">
							<?php if($instance['show_page_title'] || $instance['show_page_content']) : ?>
							<div class="tpc-body">
								<h2><?php echo $entry['cat'] ?></h2>
								<?php if($instance['show_page_title']) : ?>
									<h3 class="tpc-title">
                                                                            <a href="<?php echo $entry['link']?>" target="_blank">
										<?php if($instance['linked_page_title'] && $entry['link']) : ?>
											<?php echo $entry['title'] ?>      
										<?php else : ?>
											<?php echo $entry['title'] ?>
										<?php endif; ?>
                                                                            </a>
									</h3>
									<h4>
										<?php echo $entry['date']; ?>
									</h4>
								<?php endif; ?>
								<?php if($instance['show_page_content']) : ?>
									<div class="tpc-content post-content">
										<?php echo $entry['content'] ?>
									</div>
								<?php endif; ?>
							</div>
							<?php endif; ?>
						</div>
					</div>
				</article>
		                 <?php 
		                         wp_reset_query();
		                  ?>
			<?php endforeach; ?>
		</section>
	</div>
</section>
<?php endif;