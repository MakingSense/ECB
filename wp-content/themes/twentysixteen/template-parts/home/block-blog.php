<article id="post-<?php the_ID(); ?> - <?=the_ID(); ?>" class="blog">
  <div class="wrapper">
    <div class="background-img" style="background: url(<?php echo get_field('feature_image'); ?>); background-size: cover;"></div>
    <div class="text">
      <span><?= search_category_post($post->ID) ?></span>
      <?php the_title( sprintf( '<h3>', esc_url( get_permalink() ) ), '</h3>' ); ?>
      <h4><?= get_the_date() . ' | '; ?><?= get_author_name() ?></h4>
      <?php
          echo sprintf(
            __( '<div class="button-wrapper"><a class="button-container" href="'.get_permalink().'"><button class="more-button">Read More</button></a></div>', 'twentysixteen' ),
            get_the_title()
          );
      ?>
    </div>
  </div>
</article>
