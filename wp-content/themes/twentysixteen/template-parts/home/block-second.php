<article id="post-<?php the_ID(); ?>" class="block-second">
  <h2>Urbinsight</h2>
  <div class="wrapper">
    <div class="text" style="background: url(<?php echo get_field('image_feature'); ?>); background-size: cover; -webkit-filter: grayscale(100%); filter: grayscale(100%);">
      <?php the_title( sprintf( '<h3>', esc_url( get_permalink() ) ), '</h3>' ); ?>
      <?php if(trim(get_field("date", get_the_ID() ))!="") {?>
        <h4><?=get_field("date", get_the_ID() ) ?></h4>
      <?php } ?>
      <p><?php custom_excerpt_length(the_excerpt()); ?></p>
      <?php
          $link_button = get_field('link_button');
          $button = get_field('button_name');
          echo sprintf(
            __( '<div><a class="button-container" href="'.$link_button.'"><button class="more-button">'.$button.'</button></a></div>', 'twentysixteen' ),
            get_the_title()
          );
      ?>
    </div>
  </div>
</article>
