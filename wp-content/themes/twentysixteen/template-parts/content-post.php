<?php

  get_header();
  wp_reset_postdata();
  ?>

<main role="main" class="section--post-generic">
  <section class="content">
    <div class="wrapper">
      <div class="text">
        <header>
          <h1><?= get_the_title() ?></h1>
          <?php if(trim(get_field("date", get_the_ID() ))!="") {?>
            <h4><?=get_field("date", get_the_ID() ) ?></h4>
          <?php } ?>
          <?php include(get_template_directory() .'/template-parts/social_networks.php'); ?>
        </header>
        <p><?= wpautop( get_the_content() ); ?></p>
      </div>
    </div>
  </section>
    <?php wp_reset_postdata(); ?>
</main>
