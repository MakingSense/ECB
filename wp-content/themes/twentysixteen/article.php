<?php
  /**
   * Template Name: Page Article
   */

  get_header();
  wp_reset_postdata();

  class Article {
    public function __construct(){

      $this->title = get_the_title();
      $this->category = 'ECOCITY WORLD SUMMIT';
      $this->date = 'June 17, 2016  | Sven Eberlein';
      $this->quote = get_field('quote',get_the_ID());
      $this->content_1 = get_the_content();
      $this->content_2 = get_field('content_2',get_the_ID());

      $this->images_carrousel = [];
      for ($index = 1; $index < 5; $index ++) {
        secure_array_push($this->images_carrousel, get_field('image_' . $index, get_the_ID()));
      }

      $this->images_sidebar = [];
      for ($index = 1; $index < 4; $index ++) {
        $image_src = get_field('image_sidebar_' . $index, get_the_ID());
        $imageObject = (object) array('src' => $image_src, 'description' => 'Insert Description');
        secure_array_push($this->images_sidebar, $imageObject, $image_src);
      }

      $this->author = (object)[
        'avatar' => get_avatar($post->post_author),
        'description' => nl2br(get_the_author_meta("description", $post->post_author))
      ];
    }
  }
   
  $article = new Article;
?>  

<main role="main" class="section--article">
  <section class="content">

    <div class="wrapper">
      <div class="text">
        <header>
          <h2><?= $article->category ?></h2>
          <h1><?= $article->title ?></h1>
          <h4><?= $article->date ?></h4>
          <?php include(get_template_directory() .'/template-parts/social_networks.php'); ?>
        </header>

        <p><?= $article->content_1 ?></p>
        <p class="quote"><?= $article->quote ?></p>

        <div class="carousel-wrapper">
          <div class="main images-container owl-carousel">
            <?php foreach ($article->images_carrousel as $article->image) : ?>
              <div class="image"><img src="<?= $article->image ?>" /></div>
            <?php endforeach; ?>
          </div>
        </div>

        <div class="aside images-container desktop-only">
          <?php foreach ($article->images_sidebar as $article->image) : ?>
            <div class="image">
              <img src="<?= $article->image->src ?>" />
              <p><?= $article->image->description ?></p>
            </div>
          <?php endforeach; ?>
        </div>

        <p><?= $article->content_2 ?></p>
        
        <div class="aside images-container mobile-only owl-carousel">
          <?php foreach ($article->images_sidebar as $article->image) : ?>
            <div class="image">
              <img src="<?= $article->image->src ?>" />
              <p><?= $article->image->description ?></p>
            </div>
          <?php endforeach; ?>
        </div>
      </div>

      <aside>
        <article class="author">
          <figure><?= $article->author->avatar ?></figure>
          <p><?= $article->author->description ?></p>
        </article>
      </aside>
    </div>

  </section>
</main>

<?php
  get_footer(); 
?>

