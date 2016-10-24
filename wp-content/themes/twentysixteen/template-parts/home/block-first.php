<article id="post-<?php the_ID(); ?>" class="block block-first">
  <h2>Ecocity World Summit</h2>
  <div class="wrapper">
    <a class="post-thumbnail" href="<?php echo get_field('link_button'); ?>"><img src="<?php echo get_field('feature_image'); ?>"></a>
    <div class="text">
      <h3><?=mb_strimwidth( get_the_title(),0, 18, '...' )?></h3>
      <?php
       get_date_block_home();
       echo mb_strimwidth(strip_tags(get_the_content()), 0, 253, "..." );
       get_text_link_button_home();
      ?>
    </div>
  </div>
</article>
