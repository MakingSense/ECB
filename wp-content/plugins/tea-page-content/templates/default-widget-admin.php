<div class="tpc-columns-wrapper">
	<div class="tpc-column tpc-full-width">
		<p>
			<label for="<?php echo $bind->get_field_id('title') ?>">
				<?php _e('Title', 'tea-page-content'); ?>:
			</label>
			<input class="widefat" type="text" id="<?php echo $bind->get_field_id('title') ?>" name="<?php echo $bind->get_field_name('title') ?>" value="<?php echo $instance['title'] ?>" />
		</p>
	</div>

	<div class="tpc-columns-group">
		<div class="tpc-column">
			<?php if(is_array($entries) && count($entries) ) : ?>
                                <?php // var_dump($entries) ?>
				<?php $instance['posts'] = unserialize($instance['posts']) ? unserialize($instance['posts']) : array();  ?>

				<span class="tpc-column-label">
					<?php _e('Please, select one or more posts from lists below:', 'tea-page-content') ?>
				</span>
				<div class="tpc-posts-list">
					<?php foreach ($entries as $postType => $postsByType) : ?>
					
                                                <?php 
                                        if (($postType == 'post' || $postType == 'page') ) {?>
    
                                        <div class="tpc-post-type-block tpc-accordeon post-type <?php echo 'type'.$num++ ?>">
					
						<div class="tpc-accordeon-top">
							<h4><?php echo $postType ?></h4>
						</div>
						<div class="tpc-accordeon-body">
						<?php foreach ($postsByType as $postKey => $postData) : ?>
                                                    <?php   
                                                 if ( $postData['post_status'] == 'publish') {?>
                                                            <?php $num = 1+$num ;?>
                                                            <?php $checked = in_array($postData['id'], $instance['posts']) ? 'checked' : ''; ?>
                                                            <?php $raw_page_variables = isset($instance['page_variables'][$postData['id']]) ? $instance['page_variables'][$postData['id']] : '' ; ?>
                                                            <?php $item_class = trim($raw_page_variables) ? 'configured-item' : 'empty-item'; ?>
                                                            <?php $data_thumbnail_url = isset($page_variables[$postData['id']]['page_thumbnail']) ? $page_variables[$postData['id']]['page_thumbnail'] : ''; ?>

                                                            <label for="<?php echo $bind->get_field_id('posts') . '-' . $postData['id'] ?>" class="tpc-accordeon-item <?php echo $item_class ?>" id="<?php echo $bind->get_field_id('item') . '-' . $postData['id'] ?>">
                                                                    <input type="checkbox" name="<?php echo $bind->get_field_name('posts') ?>[]" id="<?php echo $bind->get_field_id('posts') . '-' . $postData['id'] ?>" value="<?php echo $postData['id'] ?>" <?php echo $checked ?> />

                                                                    <input type="hidden" name="<?php echo $bind->get_field_name('page_variables') ?>[<?php echo $postData['id'] ?>]" id="<?php echo $bind->get_field_id('page_variables') . '-' . $postData['id'] ?>" value="<?php echo $raw_page_variables ?>" data-thumbnail-url="<?php echo $data_thumbnail_url ?>" autocomplete="off" />

                                                                    <span class="tpc-item-title"><?php echo $postData['title'] ?></span>
                                                            </label>
                                                    <?php 
    }
                                                    endforeach; ?>
                                                    </div>
                                                </div>
                                                <?php }
                                                ?>
					
					<?php endforeach; ?>
				</div>
			<?php endif; ?>
		</div>

	</div>

	<div class="tpc-column tpc-full-width">

		<p class="tpc-preloader is-hidden">
			<label for="<?php echo $bind->get_field_id('template') ?>">
				<?php _e('Template', 'tea-page-content'); ?>:
			</label>
			<select class="widefat tpc-template-list" data-variables-area="tpc-<?php echo $bind->get_field_id('template-variables') ?>-wrapper" id="<?php echo $bind->get_field_id('template') ?>" name="<?php echo $bind->get_field_name('template') ?>" autocomplete="off">
				<?php foreach ($templates as $alias) : ?>
					<?php $selected = $alias == $instance['template'] ? 'selected' : ''; ?>
					<option value="<?php echo $alias ?>" <?php echo $selected ?>>
						<?php echo ucwords(str_replace(array('.php', 'tpc-', '-'), ' ', $alias)) ?>
					</option>
				<?php endforeach; ?>
			</select>
		</p>

		<div class="tpc-template-params" id="tpc-<?php echo $bind->get_field_id('template-variables') ?>-wrapper" data-mask-name="<?php echo $bind->get_field_name('{mask}') ?>">
			<?php echo $partials['template_variables'] ?>
		</div>
	</div>
	
</div>
<script>
    
</script>