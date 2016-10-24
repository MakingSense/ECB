<article id="post-<?php the_ID(); ?> - <?=the_ID(); ?>" class="blog">
  <div class="wrapper">
    <div class="text">
      <?php if(get_field('feature_image')) {
        $style = "background: url(".get_field('feature_image').")";
      } else {
        $style = "background-color: white";
      }
      ?>
      <div class="background-img"  style="<?= $style ?>"></div>
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
