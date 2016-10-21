<article id="post-<?php the_ID(); ?>" class="block block-first">
  <h2>Ecocity World Summit</h2>
  <div class="wrapper">
    <a class="post-thumbnail" href="<?php echo get_field('link_button'); ?>"><img src="<?php echo get_field('feature_image'); ?>"></a>
    <div class="text">
      <?php the_title( sprintf( '<h3>', esc_url( get_permalink() ) ), '</h3>' ); ?>
      <?php get_date_block_home() ?>
      <?php custom_excerpt_length(the_excerpt()); ?>
      <?php
          get_text_link_button_home();
      ?>
    </div>
  </div>
</article>
