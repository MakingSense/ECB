<article id="post-<?php the_ID(); ?>" class="block-second">
  <h2>Urbinsight</h2>
  <div class="wrapper">
    <div class="text" style="background: url(<?php echo get_field('image_feature'); ?>); background-size: cover">
      <?php the_title( sprintf( '<h3>', esc_url( get_permalink() ) ), '</h3>' ); ?>
      <h4><?php the_date(); ?></h4>
      <p><?php custom_excerpt_length(the_excerpt()); ?></p>
      <?php

          echo sprintf(
            __( '<div><a class="button-container" href="'.get_permalink().'"><button class="more-button">Learn More</button></a></div>', 'twentysixteen' ),
            get_the_title()
          );
      ?>
    </div>
  </div>
</article>
