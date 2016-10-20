<article id="post-<?php the_ID(); ?>" class="block-third">
  <h2>Featured Project</h2>
  <div class="wrapper">
    <div class="text">
      <?php the_title( sprintf( '<h3>', esc_url( get_permalink() ) ), '</h3>' ); ?>
      <?php get_date_block_home() ?>  
      <p><?php custom_excerpt_length(the_excerpt()); ?></p>
      <?php
          get_text_link_button_home();
      ?>
    </div>
    <?php twentysixteen_post_thumbnail(); ?>
  </div>
</article>
