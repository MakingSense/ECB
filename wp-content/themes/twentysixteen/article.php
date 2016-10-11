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
      $this->date = get_the_date('M d, Y');
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
        'description' => nl2br(get_the_author_meta("description", $post->post_author)),
		'display_name' => nl2br(get_the_author_meta("display_name", $post->post_author))
      ];
    }
  }
   
  $article = new Article;
  $post_articles=get_field('post_articles',get_the_ID());

  

?>  

<main role="main" class="section--article">
  <section class="content">

    <div class="wrapper">
      <div class="text">
        <header>
          <h2><?= $article->category ?></h2>
          <h1><?= $article->title ?></h1>
          <h4><?= $article->date. " | ". $article->author->display_name ?></h4>
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

      <aside style="padding-bottom: <?= (count($article->images_sidebar) * 350 + 700).'px' ?>">
        <article class="author">
          <figure><?= $article->author->avatar ?></figure>
          <p><?= $article->author->description ?></p>
        </article>
      </aside>
    </div>

  </section>    
    <hr>
    <section class="component--featured">
      <h2>You May Also Like</h2>
                
      <div class="article-wrapper">
        <section class="article-container desktop-only">
          <?php if ($post_articles): ?>
            <?php foreach ($post_articles as $mp) : ?>
              <article class="article featured">
                <div class="wrapper" href="<?= get_the_permalink($mp->ID)?>">
                    <div class="text">
                      <div><img src="<?php 
                      $thumb = wp_get_attachment_image_src(get_post_thumbnail_id($mp->ID), 'post'); 
                      echo $thumb[0];?>"></img></div>
                      <h4><?= search_category_post($mp->ID)?></h4>
                      <h3 class="tpc-title"><?=get_the_title($mp->ID)?></h3>
                      <h4><?= get_the_date()?></h4>
                      <h4><?= get_the_author()?></h4>
                    </div>
                </div>
              </article>
            <?php endforeach; ?>
          <?php endif; ?>
        </section>
      </div>
      
    </section>

    <?php wp_reset_postdata(); ?>
</main>

<?php
  get_footer(); 
?>

