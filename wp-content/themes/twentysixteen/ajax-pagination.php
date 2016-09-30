<?php
session_start(); //set session to remember the categories while traversing through the paginated results


//continue only if $_POST is set and it is a Ajax request
if(isset($_POST) && isset($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest'){

require_once('../../../wp-load.php');
global $wpdb;

$item_per_page = 2;


if( !isset( $_SESSION['cats'] ) ){
      $_SESSION['cats'] = "-1"; //Set a default category to display on page load
}
	if( isset( $_POST['cat']) ) {
            $_SESSION['cats'] = $_POST['cat']; /* save it to a session so that the query remembers */
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

	} else{

		$page_number = 1; //if there's no page number, set it to 1

	}
        var_dump($_SESSION['date']);
$results = $wpdb->get_var("
    SELECT COUNT(*) FROM {$wpdb->posts} INNER JOIN {$wpdb->term_relationships} ON ({$wpdb->posts}.ID = {$wpdb->term_relationships}.object_id)
    INNER JOIN {$wpdb->term_taxonomy} ON ({$wpdb->term_relationships}.term_taxonomy_id = {$wpdb->term_taxonomy}.term_taxonomy_id)
    WHERE ((". $_SESSION['cats']." = '-1' OR {$wpdb->term_taxonomy}.term_id = ". $_SESSION['cats'].")
       AND (". $_SESSION['author']." = '-1' OR {$wpdb->posts}.post_author = ". $_SESSION['author'].")
    AND {$wpdb->term_taxonomy}.taxonomy = 'category'
    AND {$wpdb->posts}.post_type = 'post'
    AND {$wpdb->posts}.post_status = 'publish')"
);

	$get_total_rows = $results; //hold  number of rows in a variable

	$total_pages = ceil( $get_total_rows[0]/$item_per_page );
	//get starting position to fetch the records
	$page_position = ( ( $page_number-1 ) * $item_per_page );
	

$sql = "
        SELECT  {$wpdb->posts}.* FROM {$wpdb->posts}
        INNER JOIN {$wpdb->term_relationships} ON ({$wpdb->posts}.ID = {$wpdb->term_relationships}.object_id)
        INNER JOIN {$wpdb->term_taxonomy} ON ({$wpdb->term_relationships}.term_taxonomy_id = {$wpdb->term_taxonomy}.term_taxonomy_id)
        WHERE ((". $_SESSION['cats']." = '-1' OR {$wpdb->term_taxonomy}.term_id IN(". $_SESSION['cats']."))
            AND (". $_SESSION['author']." = '-1' OR {$wpdb->posts}.post_author = ". $_SESSION['author'].")
        AND {$wpdb->term_taxonomy}.taxonomy = 'category'
        AND {$wpdb->posts}.post_type = 'post'
        AND {$wpdb->posts}.post_status = 'publish')
        ORDER BY {$wpdb->posts}.post_date  ". $_SESSION['date']." LIMIT ".$page_position.", ".$item_per_page."; 
     ";
	
	//Prepare our MySQL results so that we can output each and every blog post related to the current categories
$getall = $wpdb->get_col( $sql );

if ( $getall ) 
{
    foreach ( $getall as $id ) 
    { 
        $post = get_post( intval( $id ) );
        setup_postdata( $post );
?>





<!--Begin output of blog posts-->
               <div class="blog-post" >
                <div class="header"> 
                    <?php
                    $categories = get_the_category(); 
                      foreach($categories as $category) {
                           echo "<span>" . $category->cat_name . "</span>";
                    }
                    ?>
                </div>
                <h1><?php the_title(); ?></h1>
                    <div class="article">
                        <div class="lhs-column">
                    <?php
                        if ( has_post_thumbnail() ) {
                            the_post_thumbnail('ajax-pagination');
                        }
                    ?>
                        </div>
                        <div class="rhs-column">

                            <div class="meta-row-one">
                                <div class="author">
                                    <b><?php the_time('M d Y'); ?></b> 
                                    <b>By</b> <?php the_author_posts_link(); ?>
                                </div>
                                <div style="clear:both;"></div>
                            </div>
                    
                            <div class="meta-row-two">
                            <?php

                            $content = get_the_content();
                            echo substr($content, 0, 209);  

                             ?>
                            </div>
                            <div class="meta-row-three">
                            <a href=""></a>
                            </div>
                    </div>
                    <div style="clear:both;"></div>
                </div><!--End of container -->
                </div>

<div class="divider">&nbsp;</div>

<!--End output of blog posts-->
        <?php
    } 
}	

	echo '<div align="center">';

	echo paginate_function( $item_per_page, $page_number, $get_total_rows[0], $total_pages ); /* The pagination func to display the links etc */

	echo '</div>';
}


################ pagination function #########################################
function paginate_function($item_per_page, $current_page, $total_records, $total_pages)
{
    $pagination = '';


    if($total_pages > 0 && $total_pages != 1 && $current_page <= $total_pages){ //verify total pages and current page number

        $pagination .= '<ul class="ajax-pagination">';
        
        $right_links    = $current_page + 3; 
        $previous       = $current_page - 3; //previous link 
        $previ       =   $current_page - 1; // Additional variable to go back only one page      
        $next           = $current_page + 1; //next link
        $first_link     = true; //boolean var to decide our first link
        
        if($current_page > 1){
			$previous_link = ($previous==0)?1:$previous;
            $pagination .= '<li class="pagi-prev"><a href="#"  data-page="'.$previ.'" title="Previous">&lt; Previous</a></li>'; //previous link
//                for($i = ($current_page-2); $i < $current_page; $i++){ //Create left-hand side links
//                    if($i > 0){
//                        $pagination .= '<li><a href="#" data-page="'.$i.'" title="Page'.$i.'">'.$i.'</a></li>';
//                    }
//                }   
            $first_link = false; //set first link to false
        } else { // Setup a dud link if were on the first page already - Had to set this to keep the links in order
            $pagination .= '<li class="pagi-prev-dud">&lt; PREVIOUS</li>'; //previous link
        }
//        
//        if($first_link){ //if current active page is first link
//            $pagination .= '<li class="first active">'.$current_page.'</li>';
//        }elseif($current_page == $total_pages){ //if it's the last active link
//            $pagination .= '<li class="last active">'.$current_page.'</li>';
//        }else{ //regular current link
//            $pagination .= '<li class="active">'.$current_page.'</li>';
//        }
//            
//
//        for($i = $current_page+1; $i < $right_links ; $i++){ //create right-hand side links
//            if($i<=$total_pages){
//                $pagination .= '<li><a href="#" data-page="'.$i.'" title="Page '.$i.'">'.$i.'</a></li>';
//            }
//        }


        if($current_page < $total_pages){ 
				$next_link = ($i > $total_pages)? $total_pages : $i;
                $pagination .= '<li class="pagi-next"><a href="#"   data-page="'.$next.'" title="Next">See More &gt;</a></li>'; //next link
        } else { // Setup a dud link if were on the first page already - Had to set this to keep the links in order
            $pagination .= '<li class="pagi-next-dud">NEXT &gt;</li>'; 
        }
        

        $pagination .= '</ul>'; 


    }
    return $pagination; //return pagination links
}


