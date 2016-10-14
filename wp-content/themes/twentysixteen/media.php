<?php
/**
 *  Template Name: Page Media
 */
get_header(); ?>
 <!-- build:include ../global/header/header.html --><!-- /build -->

<?php

  class Media {
    public function __construct() {
      $this->title = get_field('title',get_the_ID());
      $this->subtitle = get_field('subtitule',get_the_ID());
      $this->date = get_field('date',get_the_ID());
      $this->image = get_field('image',get_the_ID());
      $this->link = (object) [
        'url' => get_field('link_url',get_the_ID()),
        'text' => get_field('link_text',get_the_ID())
      ];

      $this->articles = [];
      for ($index = 1; $index < 4; $index ++) {
        $articleObject = (object) [
          'value' => get_field('value_' . $index, get_the_ID()),
          'text' => get_field('text_' . $index, get_the_ID())
        ];
        secure_array_push($this->articles, $articleObject, $articleObject->value);
      }

      $this->media_posts = get_field('media_posts',get_the_ID());
      $this->isNavigationVisible = get_field('navigation_visible',get_the_ID()) == 'Yes';
    }

    public function getPostById($mp) {
      $id = $mp->ID;

      $images = [];
      for ($index = 1; $index < 3; $index ++) {
        $image = (object) [
          'src' => get_field('image_' . $index, $id),
          'link' => get_field('link_image_' . $index, $id)
        ];
        secure_array_push($images, $image, $image->src);
      }

      return (object) [
        'title' => get_the_title($id),
        'content' => str_replace(']]>', ']]&gt;', apply_filters('the_content', $mp->post_content)),
        'image_feature' => get_field('image_feature', $id),
        'video' => get_field('video', $id),
        'images' => $images

      ];
    }

    public function generateAsideMenu($activeIndex) {
      $box="<aside class='desktop-only'><ul>";
      $mediaIndex = 0;
      foreach($this->media_posts as $mp ){
        $active = ($mediaIndex === $activeIndex) ? 'class="active"' : '';
        $box.="<li ".$active."><a href='#".$mp->post_name."'>".get_the_title($mp->ID)."</a></li>";
        $mediaIndex++;
      }
      $box.="</ul></aside>";

      return $box;
    }

  }

  $media = new Media;
?>
    <main role="main" class="section--media">
     <section class="content">
      <aside id="block-media" class="block widget-area" role="complementary">
      <section id="simpleimage-2" class="widget widget_simpleimage">
          <article class="media">
            <div class="wrapper">
                <div class="text-before" style="background-image: url(<?= $media->image ?>);"></div>
              <div class="text">
                <h2><?= $media->subtitle ?></h2>
                <h3><?= $media->title ?></h3>
                <h4><?= $media->date ?></h4>
                  <?php if($media->link->url) :?>
                    <div class="button-container">
                      <a href="<?= $media->link->url ?>">
                        <button class="more-button"><?= $media->link->text ?></button>
                      </a>
                    </div>
                  <?php endif; ?>

                </div>
            </div>
          </article>
      </section>

      <section class="stats desktop-only">
        <?php foreach ($media->articles as $article) : ?>
          <article class="stat">
            <span class="number"><?= $article->value ?></span>
            <span class="text"><?= $article->text ?></span>
          </article>
        <?php endforeach; ?>
      </section>
      <section class="stats mobile-only owl-carousel">
        <?php foreach ($media->articles as $article) : ?>
          <article class="stat">
            <span class="number"><?= $article->value ?></span>
            <span class="text"><?= $article->text ?></span>
          </article>
        <?php endforeach; ?>
      </section>
  </aside>
  <?php if(is_array($media->media_posts)) : ?>
  <section class="medias">
      <?php
      $mediaIndex = -1;
      foreach ($media->media_posts as $mp) :
        $mediapost = $media->getPostById($mp);
        $mediaIndex++;?>
        <hr>
        <article class="media">
          <?php
          if ($media->isNavigationVisible) {
            echo $media->generateAsideMenu($mediaIndex);
          }
          ?>
          <div class="text <?= (!$media->isNavigationVisible) ? 'full': ''; ?>" id="<?=$mp->post_name?>">
            <h2><?= $mediapost->title ?></h2>
            <p><?= $mediapost->content ?></p>

            <?php if ($mediapost->image_feature) :?>
              <div class="video">
                <img src="<?= $mediapost->image_feature ?>"/>
              </div>
            <?php endif; ?>

            <?php if ($mediapost->video) : ?>
              <div class="video-wrapper">
                <iframe width="420" height="315" webkitallowfullscreen="" mozallowfullscreen="" allowfullscreen="" src="<?= $mediapost->video ?>"></iframe>
              </div>
            <?php endif; ?>

            <?php if (count($mediapost->images) > 0 ) : ?>
              <div class="video-collection desktop-only">
                <?php foreach ($mediapost->images as $image) : ?>
                  <div class="video">
                    <?php if($image->link) : ?>
                      <a href="<?= $image->link ?>" target="_blank"><img src="<?= $image->src ?>"></a>
                    <?php endif; ?>

                    <?php if(!$image->link) : ?>
                      <img src="<?= $image->src ?>">
                    <?php endif; ?>
                  </div>
                <?php endforeach; ?>
              </div>

              <div class="video-collection mobile-only owl-carousel">
                <?php foreach ($mediapost->images as $image) : ?>
                  <div class="video">
                    <?php if($image->link) : ?>
                      <a href="<?= $image->link ?>" target="_blank"><img src="<?= $image->src ?>"></a>
                    <?php endif; ?>

                    <?php if(!$image->link) : ?>
                      <img src="<?= $image->src ?>">
                    <?php endif; ?>
                  </div>
                <?php endforeach; ?>
              </div>
            <?php endif; ?>


            <?php if( (get_field('form',$mp->ID)=='Yes')&& (get_field('email_to_send',$mp->ID)) && (get_field('text_button',$mp->ID)) && (get_field('placeholder',$mp->ID)) ) : ?>
              <form id="form-<?=get_the_ID();?>" class="apply-container">
                <label>
                  <input type="text" name="email" placeholder="<?=get_field('placeholder',$mp->ID)?>">
                </label>
                <button class="submit-button media-submit-button"><?=get_field('text_button',$mp->ID)?></button>
                <span class="submit-message">Submit Message</span>
                <input type="hidden" name="to_send" value="<?=get_field('email_to_send',$mp->ID);?>"/>
                <input type="hidden" name="url" value="<?=get_home_url();?>"/>
              </form>
            <?php endif; ?>

          </div>
        </article>
      <?php endforeach; ?>

      <?php wp_reset_postdata(); ?>
    </section>
	<?php endif;?>
  </section>
</main>

<?php get_footer(); ?>
