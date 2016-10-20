<article id="post-<?php the_ID(); ?>" class="block block-second">
  <h2>Urbinsight</h2>
  <div class="wrapper">
    <div class="background-img" style="background: url(<?php echo get_field('image_feature'); ?>); background-size: cover; -webkit-filter: grayscale(1); filter: grayscale(1);"></div>
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
