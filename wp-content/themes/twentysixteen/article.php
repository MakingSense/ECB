<?php
  get_header();
  wp_reset_postdata();

  $title = get_the_title();
  $category = 'ECOCITY WORLD SUMMIT';
  $date = 'June 17, 2016  | Sven Eberlein';
  $quote = get_field('quote',get_the_ID());
  $content_1 = get_the_content();
  $content_2 = get_field('content_2',get_the_ID());

  $images_carrousel = [];
  secure_array_push($images_carrousel, get_field('image_1',get_the_ID()));
  secure_array_push($images_carrousel, get_field('image_2',get_the_ID()));
  secure_array_push($images_carrousel, get_field('image_3',get_the_ID()));
  secure_array_push($images_carrousel, get_field('image_4',get_the_ID()));

  $images_sidebar = [];
  secure_array_push($images_sidebar, get_field('image_sidebar_1',get_the_ID()));
  secure_array_push($images_sidebar, get_field('image_sidebar_2',get_the_ID()));
  secure_array_push($images_sidebar, get_field('image_sidebar_3',get_the_ID()));

  $author = (object)[
    'avatar' => get_avatar($post->post_author),
    'description' => nl2br(get_the_author_meta("description", $post->post_author))
  ];
?>  

<main role="main" class="section--article">
  <section class="content">

    <div class="wrapper">
      <div class="text">
        <header>
          <h2><?= $category ?></h2>
          <h1><?= $title ?></h1>
          <h4><?= $date ?></h4>
          <?php include(get_template_directory() .'/template-parts/social_networks.php'); ?>
        </header>

        <p><?= $content_1 ?></p>
        <p class="quote"><?= $quote ?></p>

        <div class="images-container owl-carousel">
          <?php foreach ($images_carrousel as $image) { ?>
            <div><img src="<?= $image ?>" /></div>
          <?php } ?>
        </div>

        <p><?= $content_2 ?></p>
      </div>

      <aside>
        <article>
          <?= $author->avatar ?>
          <?= $author->description ?>
        </article>

        <div class="image-container">
          <?php foreach ($images_sidebar as $image) { ?>
            <img src="<?= $image ?>" />
          <?php } ?>
        </div>
      </aside>
    </div>

  </section>
</main>

<?php
  get_footer(); 
?>

