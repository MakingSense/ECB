<article id="post-<?php the_ID(); ?>" class="block-first">
  <h2>Ecocity World Summit</h2>
  <div class="wrapper">
    <?php twentysixteen_post_thumbnail(); ?>
    <div class="text">
      <?php the_title( sprintf( '<h3>', esc_url( get_permalink() ) ), '</h3>' ); ?>
      <?php if(trim(get_field("date", get_the_ID() ))!="") {?>
      <h4><?=get_field("date", get_the_ID() ) ?></h4>
      <?php } ?>
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
