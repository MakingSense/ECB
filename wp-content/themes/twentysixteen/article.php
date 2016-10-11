
<?php
/*
Template Name: Page Article
*/
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
  $post_articles=get_field('post_articles',get_the_ID());
   
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
          <?php foreach ($images_carrousel as $image) : ?>
            <div><img src="<?= $image ?>" /></div>
          <?php endforeach; ?>
        </div>

        <p><?= $content_2 ?></p>
      </div>

      <aside>
        <article>
          <?= $author->avatar ?>
          <?= $author->description ?>
        </article>

        <div class="image-container">
          <?php foreach ($images_sidebar as $image) : ?>
            <img src="<?= $image ?>" />
          <?php endforeach; ?>
        </div>
      </aside>
    </div>

  </section>    
    <hr>
    <section class="component--featured">
        <h2>You May Also Like</h2>
                  
        <div class="article-wrapper">
		<section class="article-container desktop-only">
			<?php if ($post_articles): ?>
                             <?php foreach ($post_articles as $mp) {?>
				<article class="article featured">
                                    <div class="wrapper" href="<?= get_the_permalink($mp->ID)?>">
                                        <div class="text">
                                            <div><img src="<?php $thumb = wp_get_attachment_image_src( get_post_thumbnail_id($mp->ID), 'post'); 
                                            echo $thumb[0];?>"></img></div>
                                            <h4><?=  search_category_post($mp->ID)?></h4>
                                            <h3 class="tpc-title"><?=get_the_title($mp->ID)?></h3>
                                            <h4><?=  get_the_date()?></h4>
                                            <h4><?= get_the_author()?></h4>
                                        </div>
						
                                    </div>
				</article>
                                <?php } ?>
                        <?php endif; ?>
                               
		              
		</section>
	</div>

		 
        
    </section>
    <?php wp_reset_postdata(); ?>
</main>

<?php
  get_footer(); 
?>

