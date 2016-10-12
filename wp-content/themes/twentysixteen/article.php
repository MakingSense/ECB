<?php
  /**
   * Template Name: Page Article
   */

  get_header();
  wp_reset_postdata();


  class Article {
    
    public function __construct(){

      $this->title = get_the_title();
      $this->category = get_field('category',get_the_ID());
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
        $imageObject = (object) array('src' => $image_src, 'description' => get_field('text_sidebar_' . $index, get_the_ID()));
        secure_array_push($this->images_sidebar, $imageObject, $image_src);
      }


      $this->author = (object)[
        'description' => nl2br(get_the_author_meta("description", $post->post_author)),
        'display_name' => nl2br(get_the_author(get_the_ID()))
      ];

      if(trim($this->author->display_name)!="")
        $this->date = get_the_date('M d, Y') ." | ". $this->author->display_name;
      else
        $this->date = get_the_date('M d, Y');

      $this->related_articles = get_field('post_articles', get_the_ID());
    }

    public function getArticleById($id) {
      return $post = (object) [
        'title' => get_the_title($id),
        'category' => search_category_post($id),
        'date' => get_the_date(),
        'image' => wp_get_attachment_image_src(get_post_thumbnail_id($id), 'post')[0],
        'author' => get_the_author($id),
        'link' => get_the_permalink($id)
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
          <h4><?= $article->date?></h4>
          <?php include(get_template_directory() .'/template-parts/social_networks.php'); ?>
        </header>
        <?php if(trim($article->content_1)) { ?>
        <p><?= $article->content_1 ?></p>
        <?php } ?>
        <?php if(trim($article->quote)!="") { ?>
        <p class="quote"><?= $article->quote ?></p>
        <?php } ?>

        <?php if(count($article->images_carrousel) > 0) { ?>
        <div class="carousel-wrapper">
          <div class="main images-container owl-carousel">
            <?php foreach ($article->images_carrousel as $article->image) : ?>
              <div class="image"><img src="<?= $article->image ?>" /></div>
            <?php endforeach; ?>
          </div>
        </div>
        <?php } ?>
        <?php if(count($article->images_sidebar) > 0) { ?>
        <div class="aside images-container desktop-only">
          <?php foreach ($article->images_sidebar as $article->image) : ?>
            <div class="image">
              <img src="<?= $article->image->src ?>" />
              <p><?= $article->image->description ?></p>
            </div>
          <?php endforeach; ?>
        </div>
        <?php } ?>

        <?php if(trim($article->content_2 )!="") { ?>
        <p><?= $article->content_2 ?></p>
        <?php } ?>
        <?php if(count($article->images_sidebar) > 0) { ?>
        <div class="aside images-container mobile-only owl-carousel">
          <?php foreach ($article->images_sidebar as $article->image) : ?>
            <div class="image">
              <img src="<?= $article->image->src ?>" />
              <p><?= $article->image->description ?></p>
            </div>
          <?php endforeach; ?>
        </div>
        <?php } ?>
      </div>

      <aside>
      <?php if($post->post_author !=0) { ?>
        <article class="author">
          <figure><?= get_avatar($post->post_author) ?></figure>
          <p><?= $article->author->description ?></p>
        </article>
      <?php } ?>  
        <div class="desktop-only" style="padding-bottom: <?= (count($article->images_sidebar) * 350 + 700).'px' ?>"></div>
      </aside>
    </div>
    <?php if(is_array($article->related_articles)) { ?>
    <hr>

    <section class="component--featured">
      <h2>You May Also Like</h2>

      <div class="article-wrapper">
        <section class="article-container desktop-only">
          <?php foreach ($article->related_articles as $mp) : $related = $article->getArticleById($mp->ID) ?>
            <article class="article featured">
              <a class="wrapper" href="<?= $related->link ?>" />
                <div class="text" style="background-image: <?= ($related->image) ? 'url('. $related->image . ')' : '';  ?>; ">
                  <h4><?= $related->category ?></h4>
                  <h3 class="tpc-title"><?= $related->title ?></h3>
                  <h4><?= $related->date ?> | <?= $related->author ?></h4>
                </div>
              </a>
            </article>
          <?php endforeach; ?>
        </section>

        <section class="article-container owl-carousel mobile-only">
          <?php foreach ($article->related_articles as $mp) : $related = $article->getArticleById($mp->ID) ?>
            <article class="article featured">
              <a class="wrapper" href="<?= $related->link ?>" />
                <div class="text" style="background-image: <?= ($related->image) ? 'url('. $related->image . ')' : '';  ?>; ">
                  <h4><?= $related->category ?></h4>
                  <h3 class="tpc-title"><?= $related->title ?></h3>
                  <h4><?= $related->date ?></h4>
                  <h4><?= $related->author ?></h4>
                </div>
              </a>
            </article>
          <?php endforeach; ?>
        </section>
      </div>
      
    </section>
   <?php } ?>
 
  </section>    

    <?php wp_reset_postdata(); ?>
</main>

<?php
  get_footer(); 
?>