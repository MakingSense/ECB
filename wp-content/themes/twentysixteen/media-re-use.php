<?php

/*
Template Name:  Page Media re-use
 */
/**
 * The media template file
 *
 * This is the most generic template file in a WordPress theme
 * and one of the two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query.
 * E.g., it puts together the home page when no home.php file exists.
 *
 * @link http://codex.wordpress.org/Template_Hierarchy
 *
 * @package WordPress
 * @subpackage Twenty_Sixteen
 * @since Twenty Sixteen 1.0
 */
get_header(); ?>


  <main role="main" class="section--media">
   <section class="content">
    <?php get_blockmedia_reuse();?>

    <?php
    $box="<aside class='desktop-only'><ul>";
    $args = array(
        'post_type' => 'media',
        'meta_key'		=> 'show_list_media_page',
        'meta_value'	=> 'Yes',
        'posts_per_page' => 6
        );

    $the_query = new WP_Query( $args );?>
    <?php if ( $the_query->have_posts() ) : ?>
        <?php while ( $the_query->have_posts() ) : $the_query->the_post(); ?>
          <?php $box.="<li><a href='#".$post->post_name."'>".get_the_title()."</a></li>";?>
       <?php endwhile; ?>
      <?php wp_reset_postdata(); ?>
    <?php endif; ?>
    <?php $box.="</ul></aside>";
    wp_reset_query();

    $the_query = new WP_Query( $args );?>


    <section class="medias">
    <?php if ( $the_query->have_posts() ) : ?>
      <?php while ( $the_query->have_posts() ) : $the_query->the_post(); ?>
                              <hr>
      <article class="media">
        <?=$box?>
        <div class="text" id="<?=$post->post_name?>">
          <h2><?=	get_the_title()?></h2>
          <p><?=get_the_content()?>
          <?php if(get_field('image_feature',get_the_ID())){?>
            <div class="video">
                      <img src="<?=get_field('image_feature',get_the_ID())?>?txtsize=33&txt=350%C3%97150&w=556&h=377"/>
                    </div>

        <?php } ?>

        <?php if(get_field('video',get_the_ID())){?>
            <iframe width="420" height="315"
              src="<?=get_field('video',get_the_ID())?>">
            </iframe>


        <?php } ?>

        <?php if((get_field('image_1',get_the_ID()))&& (get_field('image_2',get_the_ID())) ){?>
        <div class="video-collection desktop-only">
                  <div class="video">
                  <?php if(get_field('link_image_1',get_the_ID())){?>
                  <a href="<?=get_field('link_image_1',get_the_ID())?>" target="_blank">
                  <?php }?>
                  <img src="<?=get_field('image_1',get_the_ID())?>?txtsize=33&txt=350%C3%97150&w=268&h=180">
                  <?php if(get_field('link_image_1',get_the_ID())){?>
                  </a>
                  <?php }?>
                  </div>
                  <div class="video">
                  <?php if(get_field('link_image_2',get_the_ID())){?>
                  <a href="<?=get_field('link_image_2',get_the_ID())?>" target="_blank">
                  <?php }?>
                  <img src="<?=get_field('image_2',get_the_ID())?>?txtsize=33&txt=350%C3%97150&w=268&h=180">
                <?php if(get_field('link_image_2',get_the_ID())){?>
                  </a>
                  <?php }?>
                  </div>
                </div>

              <div class="video-collection mobile-only owl-carousel">
                <div class="video">
                <?php if(get_field('link_image_1',get_the_ID())){?>
                <a href="<?=get_field('link_image_1',get_the_ID())?>" target="_blank">
                <?php }?>
                <img src="<?=get_field('image_1',get_the_ID())?>?txtsize=33&txt=350%C3%97150&w=268&h=180">
                <?php if(get_field('link_image_1',get_the_ID())){?>
                </a>
                <?php }?>
                </div>
                <div class="video">
                <?php if(get_field('link_image_2',get_the_ID())){?>
                <a href="<?=get_field('link_image_2',get_the_ID())?>" target="_blank">
                <?php }?>
                <img src="<?=get_field('image_2',get_the_ID())?>?txtsize=33&txt=350%C3%97150&w=268&h=180">
            <?php if(get_field('link_image_2',get_the_ID())){?>
                </a>
                <?php }?>
                </div>
              </div>


        <?php } ?>
        <?php if( (get_field('form',get_the_ID())=='Yes')&& (get_field('email_to_send',get_the_ID())) && (get_field('text_button',get_the_ID())) && (get_field('placeholder',get_the_ID())) ) {?>
         <form id="form-<?=get_the_ID();?>"class="apply-container">
                  <label>
                    <input type="text" name="email" placeholder="<?=get_field('placeholder',get_the_ID())?>">
                  </label>
                  <button class="submit-button media-submit-button"><?=get_field('text_button',get_the_ID())?></button>
                  <span class="submit-message">Submit Message</span>
                  <input type="hidden" name="to_send" value="<?=get_field('email_to_send',get_the_ID());?>"/>
                  <input type="hidden" name="url" value="<?=get_home_url();?>"/>
                </form>
              <?php }?>

        </p>
        </div>


          </article>


    <?php endwhile; ?>

      <?php wp_reset_postdata(); ?>
    <?php endif; ?>

  </section>
  </section>

  </main>



<?php get_footer(); ?>
