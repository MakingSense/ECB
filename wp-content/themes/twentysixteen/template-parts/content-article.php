<?php

  get_header();
  wp_reset_postdata();
  ?>

<main role="main" class="section--article">
  <section class="content">
    <div class="wrapper">
      <div class="text">
        <header>
          <h1><?= get_the_title() ?></h1>
          <h4><?= get_the_date('M d, Y');?></h4>
          <?php include(get_template_directory() .'/template-parts/social_networks.php'); ?>
        </header>
        <p><?= get_the_content() ?></p>
  </section>    
    <?php wp_reset_postdata(); ?>
</main>

<?php
  get_footer(); 
?>