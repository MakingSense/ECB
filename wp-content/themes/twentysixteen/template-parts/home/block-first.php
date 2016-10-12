<article id="post-<?php the_ID(); ?>" class="block-first">
  <h2>Ecocity World Summit</h2>
  <div class="wrapper">
    <?php twentysixteen_post_thumbnail(); ?>
    <div class="text">
      <?php the_title( sprintf( '<h3>', esc_url( get_permalink() ) ), '</h3>' ); ?>
      <h4><?php the_date(); ?></h4>
      <p><?php custom_excerpt_length(the_excerpt()); ?></p>
      <?php
        edit_post_link(
          sprintf(
            __( '<div><a class="button-container"><button class="more-button">Learn More</button></a></div>', 'twentysixteen' ),
            get_the_title()
          ),
          '<span class="edit-link">',
          '</span>'
        );
      ?>
    </div>
  </div>
</article>