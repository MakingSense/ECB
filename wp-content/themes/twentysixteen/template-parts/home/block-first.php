<article id="post-<?php the_ID(); ?>" class="block block-first">
  <h2>Ecocity World Summit</h2>
  <div class="wrapper">
    <?php twentysixteen_post_thumbnail(); ?>
    <div class="text">
      <?php the_title( sprintf( '<h3>', esc_url( get_permalink() ) ), '</h3>' ); ?>
      <?php date_block_home() ?>
      <?php custom_excerpt_length(the_excerpt()); ?>
      <?php
          buttom_block_home();
      ?>
    </div>
  </div>
</article>
