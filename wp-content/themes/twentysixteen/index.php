<?php
  /**
   *  Main Template File
   */
  get_header();

  class Home {    
    public function __construct(){
      $this->block_first = new WP_Query($this->getArgsByType('first'));
      $this->block_second = new WP_Query($this->getArgsByType('second'));
      $this->block_third = new WP_Query($this->getArgsByType('third'));
      $this->block_blog = new WP_Query([
       'posts_per_page'   => 5,
       'orderby'          => 'date',
       'order'            => 'DESC',
       'post_type'        => 'post',
       'post_status'      => 'publish',
       'suppress_filters' => true
      ]);
    }

    private function getArgsByType($type) {
      return [
        'post_type' => ['media', 'post'],
        'numberposts'   => -1,
        'meta_query' => [['value' => $type]],
      ];
    }
  }

  $home = new Home;  
?>

<div id="primary">
  <main id="main" class="site-main section--home" role="main">

    <?php include_once(get_template_directory() .'/template-parts/home/block-jumbo.php'); ?>
      
    <?php if (have_posts()) : ?>
      <?php if (is_home() && !is_front_page()) : ?>
        <h1 class="page-title screen-reader-text"><?php single_post_title(); ?></h1>
      <?php endif; ?>
      
      <?php while( $home->block_first->have_posts() ) : $home->block_first->the_post(); ?>
        <?php get_template_part('template-parts/home/block-first', get_post_format());?>
      <?php endwhile; ?>

      <?php while( $home->block_second->have_posts() ) : $home->block_second->the_post(); ?>
        <?php get_template_part('template-parts/home/block-second', get_post_format()); ?>
      <?php endwhile; ?>

      <?php while( $home->block_third->have_posts() ) : $home->block_third->the_post(); ?>
        <?php get_template_part('template-parts/home/block-third', get_post_format());?>
      <?php endwhile; ?>

      <div class="blog-wrapper desktop-only">
        <h2>Latest from the Blog</h2>
        <div class="blog-page owl-carousel">
          <?php while( $home->block_blog->have_posts() ) : $home->block_blog->the_post(); ?>
            <?php get_template_part('template-parts/home/block-blog', get_post_format()); ?>
          <?php endwhile; ?>
        </div>
      </div>

      <div class="blog-wrapper mobile-only">
        <h2>Ecocity World Summit</h2>
        <div class="blog-page owl-carousel">
          <?php while( $home->block_blog->have_posts() ) : $home->block_blog->the_post(); ?>
            <?php get_template_part('template-parts/home/block-blog', get_post_format()); ?>
          <?php endwhile; ?>
        </div>
      </div>

    <?php else : get_template_part('template-parts/home/block-first', 'none');
      endif;
      get_blockhome();
      include_once(get_template_directory() .'/template-parts/home/block-social.php');
    ?>
  </main>
</div>

<?php get_footer(); ?>
