<?php
/*
Template Name: Page Blog
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
  wp_reset_query();
  $paged = ( get_query_var( 'paged' ) ) ? absint( get_query_var( 'paged' ) ) : 1;
  $args = array(
    'posts_per_page' => 8,//change the number the post(8) as shown in the mockup
    'paged' => $paged,
  );

  $the_query = new WP_Query( $args );
?>

<?php get_header(); ?>
<main role="main" class="section--blog">
  <div class="head">
    <h1>Blog</h1>
  </div>
  <section class="content">
  <?php if( get_field('featured_articles',get_the_ID())) { ?>
  <?php $mobile=array();?>
    <section>
      <h2>Featured</h2>
      <section class="component--featured">
      	<div class="article-wrapper">
    		    <section class="article-container desktop-only">
             <?php foreach( get_field('featured_articles',get_the_ID()) as $featured) { ?>
              <article class="article featured">
    						<div class="wrapper">
    							<a class="text" style="background-image: url();" href="<?=get_permalink($featured->ID)?>">
                    <?php
                    $cat="Uncategorized";
                    $date="";
                    if(get_post_type($featured->ID)=='post'){
                      $date=get_field('date',$featured->ID);
                      $cats=get_the_category($featured->ID);
                      if(count($cats) > 0) {
                        $cat=$cats[0]->name;
                      }
                    }
                    else {
                       if(get_post_type($featured->ID)=='page'){
                         if(get_field('category', $featured->ID)) {
                           $cat=get_field('category', $featured->ID);
                         }
                       }
                    }
                    ?>
                    <?php if($cat!=="Uncategorized") { ?>
                    <h2><?=$cat?></h2>
                    <?php } ?>
    								<h3><?=get_the_title($featured->ID)?></h3>
                    <?php if(trim($date)=="") {
                            $date=get_the_date('F d, Y', $featured->ID);
                     }  ?>
                    <h4><?=$date?></h4>
    							</a>
    						</div>
    					</article>
              <?php
                $mobile[]=array('cat'=>$cat,'url'=>get_permalink($featured->ID),'title'=>get_the_title($featured->ID),'date'=>$date);
              } ?>
    				</section>
          </div>
          <section class="article-container mobile-only owl-carousel owl-loaded owl-drag">
    					<div class="owl-stage-outer">
                <div class="owl-stage" style="transform: translate3d(0px, 0px, 0px); transition: 0s;">
                  <?php foreach($mobile as $item) { ?>
                  <div class="owl-item">
                    <article class="article featured">
      						    <div class="wrapper">
      							    <a class="text" style="background-image: url();" href="<?=$item['url']?>">
                          <?php if($cat!=="Uncategorized") { ?>
                          <h2><?=$item['cat']?></h2>
                          <?php } ?>
      								    <h3><?=$item['title']?></h3>
      								    <h4><?=$date?></h4>
      							     </a>
      						    </div>
      					    </article>
                  </div>
                <?php } ?>
                </div>
              </div>
    	       </section>
           </section>
    <?php } ?>
    <h1><?php _e('All articles'); ?></h1>
    <form  id="filter-form">
        <?php wp_dropdown_categories(array('name' =>'category')); ?>
        <?php wp_dropdown_users(array('name' => 'author')); ?>

        <select name='date' id="date-filter" class="filter-blog">
            <option value='DESC'>Newest First</option>
            <option value='ASC'>Oldest First</option>
         </select>
        <input id="btn-filter-blog" type="submit" name="submit" value="mostrar categorias" hidden/>

    </form>

    <section class="article-container" id="results">
      <!-- Articles injected here with ajax -->
    </section>

  </section>
</main>

<?php get_footer(); ?>
