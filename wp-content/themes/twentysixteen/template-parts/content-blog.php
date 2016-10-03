<article id="post-<?php the_ID(); ?>" class="blog">
  <div class="wrapper">
    <div class="text">
      <span><?php search_category_post($post->ID) ?></span>
      <?php the_title( sprintf( '<h3>', esc_url( get_permalink() ) ), '</h3>' ); ?>
      <h4><?php the_date(); ?></h4>
      <p>
        <?php
          the_content( sprintf(
            __( '<div class="button-container"><button class="more-button">Learn More</button></div>', 'twentysixteen' ),
            get_the_title()
          ) );
        ?>
      </p>
      
      <!--div>
        <a class="button-container" href="<?php esc_url( get_permalink() ); ?>">
          <button class="more-button">Learn More</button>
        </a>
      </div-->
      
      <?php
        edit_post_link(
          sprintf(
            /* translators: %s: Name of current post */
            __( '<div><a class="button-container"><button class="more-button">"%s"</button></a></div>', 'twentysixteen' ),
            get_the_title()
          ),
          '<span class="edit-link">',
          '</span>'
        );
      ?>
    </div>
  </div>
</article>
