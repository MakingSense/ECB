<?php
  session_start(); //set session to remember the categories while traversing through the paginated results


  //continue only if $_POST is set and it is a Ajax request
  if(isset($_POST) && isset($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest') {

  require_once('../../../wp-load.php');
  global $wpdb;

  $item_per_page = 8;

  if( !isset( $_SESSION['cats'] ) ){
    $_SESSION['cats'] = "-1"; //Set a default category to display on page load
  }
   if( !isset( $_SESSION['cats_page'] ) ){
    $_SESSION['cats_page'] = "-1"; //Set a default category to display on page load
  }

  if( isset( $_POST['cat']) ) {
      if ($_POST['cat'] != "-1") {
        if ($_POST['cat'] == 'media' || $_POST['cat'] == 'article') {
            $_SESSION['cats_page'] =  $_POST['cat'].'.php';
            $_SESSION['cats'] = "-2";
        }else{
            $_SESSION['cats'] = $_POST['cat']; /* save it to a session so that the query remembers */
            $_SESSION['cats_page'] =  "-2";
        }
      }else{
          $_SESSION['cats'] = $_POST['cat']; /* save it to a session so that the query remembers */
          $_SESSION['cats_page'] =  $_POST['cat'];
      }
  }

  if( !isset( $_SESSION['author'] ) ){
    $_SESSION['author'] = "-1"; //Set a default category to display on page load
  }

  if( isset( $_POST['auth']) ) {
    $_SESSION['author'] = $_POST['auth']; /* save it to a session so that the query remembers */
  }

  if( !isset( $_SESSION['date'] ) ){
    $_SESSION['date'] = "DESC"; //Set a default category to display on page load
  }

  if( isset( $_POST['dat']) ) {
    $_SESSION['date'] = $_POST['dat']; /* save it to a session so that the query remembers */
  }

  //Get page number from Ajax POST
  if(isset($_POST["page"])) {

    $page_number = filter_var($_POST["page"], FILTER_SANITIZE_NUMBER_INT, FILTER_FLAG_STRIP_HIGH); //filter number

      if( !is_numeric($page_number)) {
        die('Invalid page number!'); //incase of invalid page number
      }

  } else {
    $page_number = 1; //if there's no page number, set it to 1
  }

  $query_blog = "
    SELECT COUNT(*) FROM (
        SELECT  {$wpdb->posts}.*
        FROM {$wpdb->posts}
            INNER JOIN {$wpdb->term_relationships} ON ({$wpdb->posts}.ID = {$wpdb->term_relationships}.object_id)
            INNER JOIN {$wpdb->term_taxonomy} ON ({$wpdb->term_relationships}.term_taxonomy_id = {$wpdb->term_taxonomy}.term_taxonomy_id)
        WHERE (". $_SESSION['cats']." = '-1' OR {$wpdb->term_taxonomy}.term_id IN(". $_SESSION['cats']."))
            AND (". $_SESSION['author']." = '-1' OR {$wpdb->posts}.post_author = ". $_SESSION['author'].")
            AND {$wpdb->term_taxonomy}.taxonomy = 'category'
            AND {$wpdb->posts}.post_type = 'post'
            AND {$wpdb->posts}.post_status = 'publish'
    UNION
        SELECT  {$wpdb->posts}.* FROM {$wpdb->posts} INNER JOIN {$wpdb->postmeta} ON {$wpdb->postmeta}.post_id = {$wpdb->posts}.ID
        WHERE
        (". $_SESSION['author']." = '-1' OR {$wpdb->posts}.post_author = ". $_SESSION['author'].")
            AND (('". $_SESSION['cats_page']."' = '-1' AND {$wpdb->postmeta}.meta_value IN ('media.php', 'article.php' ) ) OR {$wpdb->postmeta}.meta_value = '". $_SESSION['cats_page']."' )
            AND {$wpdb->posts}.post_type = 'page'

            AND {$wpdb->posts}.post_status = 'publish'
    ) AS RESULT2";
  $results = $wpdb->get_var($query_blog);

  $get_total_rows = $results; //hold  number of rows in a variable
  $total_pages = ceil($get_total_rows/$item_per_page );
  //get starting position to fetch the records
  $page_position = ( ( $page_number-1 ) * $item_per_page );


  $sql = "SELECT * FROM (
        SELECT  {$wpdb->posts}.*
        FROM {$wpdb->posts}
            INNER JOIN {$wpdb->term_relationships} ON ({$wpdb->posts}.ID = {$wpdb->term_relationships}.object_id)
            INNER JOIN {$wpdb->term_taxonomy} ON ({$wpdb->term_relationships}.term_taxonomy_id = {$wpdb->term_taxonomy}.term_taxonomy_id)
        WHERE (". $_SESSION['cats']." = '-1' OR {$wpdb->term_taxonomy}.term_id IN(". $_SESSION['cats']."))
            AND (". $_SESSION['author']." = '-1' OR {$wpdb->posts}.post_author = ". $_SESSION['author'].")
            AND {$wpdb->term_taxonomy}.taxonomy = 'category'
            AND {$wpdb->posts}.post_type = 'post'
            AND {$wpdb->posts}.post_status = 'publish'
    UNION
        SELECT  {$wpdb->posts}.* FROM {$wpdb->posts} INNER JOIN {$wpdb->postmeta} ON {$wpdb->postmeta}.post_id = {$wpdb->posts}.ID
        WHERE
        (". $_SESSION['author']." = '-1' OR {$wpdb->posts}.post_author = ". $_SESSION['author'].")
            AND (('". $_SESSION['cats_page']."' = '-1' AND {$wpdb->postmeta}.meta_value IN ('media.php', 'article.php' ) ) OR {$wpdb->postmeta}.meta_value = '". $_SESSION['cats_page']."' )
            AND {$wpdb->posts}.post_type = 'page'
            AND {$wpdb->posts}.post_status = 'publish'

    ) AS RESULT2
    ORDER BY RESULT2.post_date  ". $_SESSION['date']." LIMIT ".$page_position.", ".$item_per_page.";
  ";

  //Prepare our MySQL results so that we can output each and every blog post related to the current categories
  $getall = $wpdb->get_col( $sql );

  if ( $getall ) {
    foreach ( $getall as $id ) {
      $post = get_post( intval( $id ) );
      setup_postdata( $post );

      //category
      $categoryName = "";
      foreach(get_the_category() as $category) {
        $categoryName .= ' ' . $category->cat_name;
      }

      //content
      $content = substr(get_the_content(), 0, 209);
?>

<article class="article blog">
  <a class="wrapper" href="<?=get_the_permalink();?>">
    <span class="text">
      <h2><?php echo $categoryName; ?></h2>
      <h3><?php the_title(); ?></h3>
      <h4><?php the_time('M d Y'); ?></h4>
      <span class="desktop-only"><?php custom_excerpt_length(the_excerpt()); ?></span>
    </span>
  </a>
</article>

<?php
      }
    }

    echo paginate_function( $item_per_page, $page_number, $get_total_rows[0], $total_pages ); /* The pagination func to display the links etc */
  }


  ################ pagination function #########################################
  function paginate_function($item_per_page, $current_page, $total_records, $total_pages) {
    $pagination = '';

    if($total_pages > 0 && $total_pages != 1 && $current_page <= $total_pages) { //verify total pages and current page number

      $pagination .= '<div class="pagination-container">';

      $right_links = $current_page + 3;
      $previous    = $current_page - 3; // previous link
      $previ       = $current_page - 1; // Additional variable to go back only one page
      $next        = $current_page + 1; // next link
      $first_link  = true; //boolean var to decide our first link

      if($current_page > 1){
        $previous_link = ($previous == 0)? 1 : $previous;
        //$pagination .= '<a href="#" class="prev" data-page="'.$previ.'" title="Previous">&lt; Previous</a></li>';
        $first_link = false; //set first link to false
      } else { // Setup a dud link if were on the first page already - Had to set this to keep the links in order
        //$pagination .= '<li class="pagi-prev-dud">&lt; PREVIOUS</li>'; //previous link
      }

      if($current_page < $total_pages) {
        $next_link = ($i > $total_pages)? $total_pages : $i;
        $pagination .= '<a href="#" id="nextbutton" class="next" data-page="'.$next.'" title="Next">See More</a></li>'; //next link
      } else { // Setup a dud link if were on the first page already - Had to set this to keep the links in order
        //$pagination .= '<li class="pagi-next-dud">NEXT &gt;</li>';
      }

      $pagination .= '</div>';
    }
    return $pagination; //return pagination links
  }


?>
