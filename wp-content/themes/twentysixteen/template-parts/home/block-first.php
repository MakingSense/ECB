<article id="post-<?php the_ID(); ?>" class="block block-first">
  <h2>Ecocity World Summit</h2>
  <div class="wrapper">
    <a class="post-thumbnail" href="<?php echo get_field('link_button'); ?>"><img src="<?php echo get_field('feature_image'); ?>"></a>
    <div class="text">
      <?php
       echo the_title('<h3>','</h3>');
       get_date_block_home();
       echo mb_strimwidth(strip_tags(get_the_content()), 0, 252, "..." );
       get_text_link_button_home();
      ?>
    </div>
  </div>
</article>
