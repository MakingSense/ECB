<article id="post-<?php the_ID(); ?>" class="block block-second">
  <h2>Urbinsight</h2>
  <div class="wrapper">
    <img class="background-img" src="<?php echo get_field('feature_image'); ?>">
    <div class="text">
      <h3><?=mb_strimwidth( get_the_title(),0, 53, '...' )?></h3>
      <?php
       get_date_block_home();
       echo mb_strimwidth(strip_tags(get_the_content()), 0, 269, "..." );
       get_text_link_button_home();
      ?>
    </div>
  </div>
</article>
