<article id="post-<?php the_ID(); ?>" class="block block-third">
  <h2>Featured Project</h2>
  <div class="wrapper">
    <div class="text">
      <?php the_title( sprintf( '<h3>', esc_url( get_permalink() ) ), '</h3>' ); ?>
      <?php get_date_block_home() ?>
      <?php custom_excerpt_length(the_excerpt()); ?>
      <?php
          get_text_link_button_home();
      ?>
    </div>
    <a class="post-thumbnail" href="<?php echo get_field('link_button'); ?>"><img src="<?php echo get_field('feature_image'); ?>"></a>
    <?php // twentysixteen_post_thumbnail(); ?>
  </div>
</article>
