

<article id="post-<?php the_ID(); ?>" class="block block-third">
  <h2>Featured Project</h2>
  <div class="wrapper">
    <div class="text">
      <?php
        echo the_title('<h3>','</h3>');
       get_date_block_home();
       echo mb_strimwidth(strip_tags(get_the_content()), 0, 258, "..." );
       get_text_link_button_home();
      ?>
    </div>
    <a class="post-thumbnail" href="<?php echo get_field('link_button'); ?>"><img src="<?php echo get_field('feature_image'); ?>"></a>
    <?php // twentysixteen_post_thumbnail(); ?>
  </div>
</article>
