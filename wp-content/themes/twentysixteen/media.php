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
        secure_array_push($this->articles, $articleObject, $articleObject->src);
      }

      $this->media_posts = get_field('media_posts',get_the_ID());
      $this->isNavigationVisible = get_field('navigation_visible',get_the_ID()) == 'Yes';
    }

    public function generateAsideMenu() {
      $box="<aside class='desktop-only'><ul>";
      foreach($this->media_posts as $mp ){
        $box.="<li><a href='#".$mp->post_name."'>".get_the_title($mp->ID)."</a></li>";
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
                <div class="text-before" style="background: url(<?= $media->image ?>); background-size: cover;"></div>
              <div class="text">
                <h2><?= $media->subtitle ?></h2>
                <h3><?= $media->title ?></h3>
                <h4><?= $media->date ?></h4>
                  <?php if($media->link->url) :?>
                    <div class="button-container">
                      <button onclick="window.location.href=&quot;<?= $media->link->url ?>&quot;;" class="more-button"><?= $media->link->text ?></button>
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

      <section class="stats desktop-only owl-carousel">
        <?php foreach ($media->articles as $article) : ?>
          <article class="stat">
            <span class="number"><?= $article->value ?></span>
            <span class="text"><?= $article->text ?></span>
          </article>
        <?php endforeach; ?>
      </section>
  </aside>

<?php if(is_array($media->media_posts)) { ?>
  <section class="medias">
      <?php foreach ($media->media_posts as $mp) {?>
        <hr>
        <article class="media">
          <?php
          if ($media->isNavigationVisible) {
            echo $media->generateAsideMenu();
          }
          ?>
          <div class="text <?= (!$media->isNavigationVisible) ? 'full': ''; ?>" id="<?=$mp->post_name?>">
            <h2><?= get_the_title($mp->ID)?></h2>
            <p><?php
              $content = apply_filters('the_content', $mp->post_content);
                $content = str_replace(']]>', ']]&gt;', $content);
                echo $content;
              ?>
            <?php if(get_field('image_feature', $mp->ID)){?>
              <div class="video">
                <img src="<?=get_field('image_feature',$mp->ID)?>?txtsize=33&txt=350%C3%97150&w=556&h=377"/>
              </div>

          <?php } ?>

          <?php if(get_field('video',$mp->ID)){?>
              <iframe width="420" height="315"
                src="<?=get_field('video',$mp->ID)?>">
              </iframe>


          <?php } ?>

          <?php if((get_field('image_1',$mp->ID))&& (get_field('image_2',$mp->ID)) ){?>
            <div class="video-collection desktop-only">
              <div class="video">
              <?php if(get_field('link_image_1',$mp->ID)){?>
              <a href="<?=get_field('link_image_1',get_the_ID())?>" target="_blank">
              <?php }?>
              <img src="<?=get_field('image_1',$mp->ID)?>?txtsize=33&txt=350%C3%97150&w=268&h=180">
              <?php if(get_field('link_image_1',$mp->ID)){?>
              </a>
              <?php }?>
              </div>
              <div class="video">
              <?php if(get_field('link_image_2',$mp->ID)){?>
              <a href="<?=get_field('link_image_2',$mp->ID)?>" target="_blank">
              <?php }?>
              <img src="<?=get_field('image_2',$mp->ID)?>?txtsize=33&txt=350%C3%97150&w=268&h=180">
            <?php if(get_field('link_image_2',$mp->ID)){?>
              </a>
              <?php }?>
              </div>
            </div>

            <div class="video-collection mobile-only owl-carousel">
              <div class="video">
              <?php if(get_field('link_image_1',$mp->ID)){?>
              <a href="<?=get_field('link_image_1',$mp->ID)?>" target="_blank">
              <?php }?>
              <img src="<?=get_field('image_1',$mp->ID)?>?txtsize=33&txt=350%C3%97150&w=268&h=180">
              <?php if(get_field('link_image_1',$mp->ID)){?>
              </a>
              <?php }?>
              </div>
              <div class="video">
              <?php if(get_field('link_image_2',$mp->ID)){?>
              <a href="<?=get_field('link_image_2',get_the_ID())?>" target="_blank">
              <?php }?>
              <img src="<?=get_field('image_2',$mp->ID)?>?txtsize=33&txt=350%C3%97150&w=268&h=180">
              <?php if(get_field('link_image_2',$mp->ID)){?>
              </a>
              <?php }?>
              </div>
            </div>


          <?php } ?>
          <?php if( (get_field('form',$mp->ID)=='Yes')&& (get_field('email_to_send',$mp->ID)) && (get_field('text_button',$mp->ID)) && (get_field('placeholder',$mp->ID)) ) {?>
           <form id="form-<?=get_the_ID();?>"class="apply-container">
            <label>
              <input type="text" name="email" placeholder="<?=get_field('placeholder',$mp->ID)?>">
            </label>
            <button class="submit-button media-submit-button"><?=get_field('text_button',$mp->ID)?></button>
            <span class="submit-message">Submit Message</span>
            <input type="hidden" name="to_send" value="<?=get_field('email_to_send',$mp->ID);?>"/>
            <input type="hidden" name="url" value="<?=get_home_url();?>"/>
          </form>
        <?php }?>

          </p>
          </div>
            </article>

      <?php } ?>

        <?php wp_reset_postdata(); ?>
    </section>
    <?php } ?>
  </section>
</main>
<?php get_footer(); ?>
