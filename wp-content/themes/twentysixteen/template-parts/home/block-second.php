<article id="post-<?php the_ID(); ?>" class="block block-second">
  <h2>Urbinsight</h2>
  <div class="wrapper">
    <div class="arturo" style="background: url(<?php echo get_field('image_feature'); ?>); background-size: cover; -webkit-filter: grayscale(100%); filter: grayscale(100%);"></div>
    <div class="text">
      <?php the_title( sprintf( '<h3>', esc_url( get_permalink() ) ), '</h3>' ); ?>
      <?php date_block_home() ?>
      <p><?php custom_excerpt_length(the_excerpt()); ?></p>
      <?php
          buttom_block_home();
      ?>
    </div>
  </div>
</article>
