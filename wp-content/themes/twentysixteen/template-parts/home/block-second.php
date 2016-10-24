<article id="post-<?php the_ID(); ?>" class="block block-second">
  <h2>Urbinsight</h2>
  <div class="wrapper">
    <div class="background-img" style="background: url(<?php echo get_field('feature_image'); ?>); background-size: cover; -webkit-filter: grayscale(1); filter: grayscale(1);"></div>
    <div class="text">
      <?php
      echo the_title('<h3>','</h3>');
       get_date_block_home();
       echo mb_strimwidth(strip_tags(get_the_content()), 0, 270, "..." );
       get_text_link_button_home();
      ?>
    </div>
  </div>
</article>
