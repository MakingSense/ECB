/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */


(function($) {


/* When clicking ajax pagination links display loading logo while loading results */
function AjaxPaginationButtons(){

    $("#results").on( "click", ".ajax-pagination a", function (e){

        e.preventDefault();

        $(".loading-div").show(); //show loading element

        var page = $(this).attr("data-page"); //get page number from link

        $("#results").load( wnm_custom.template_url + "/ajax-pagination.php",{"page":page}, function(){ //Load results from fetch_pages.php and post the page number in a variable

            $(".loading-div").hide(); //once done, hide loading element

        });
        
    });

}



/*
Loop through all localstorage cookies and assign them to a variable, then check all the checkboxes ID's to see if 
they match and if they do we set the checkboxes attribute the checked so that it stays checked after page refresh
*/
function rememberstates(){

for(var i = 0; i < localStorage.length; i++){
    
    var cookies = localStorage.key(i);

        $(".checkboxcat").each(function(i,e){

            var getCheckboxID = $(this).attr('id');

            if ( getCheckboxID === cookies)

               $(this).attr('checked', 'checked');

           });
}

}



/*
When clicking checkboxes this function will create or destroy a cookie depending what state you 
leave the checkbox after clicking
*/
function setLocalCookies(){

    $(".checkboxcat").each(function(i,e){
        if( $(this).is(":checked") )
        {

                var checkboxID = $(this).attr("id"); //set the name of the cookie equal to the dynamic ID name

                var checkboxDataTag = $(this).attr("data-cat")  //set the cookie value equal to the data-cat attribute, just an integer
                // alert(checkboxID);
                localStorage.setItem( checkboxID, checkboxDataTag);

        } else if( $(this).is(":not(:checked)") ) {
                
                var checkboxID = $(this).attr("id");
                //alert(checkboxID);
                localStorage.removeItem( checkboxID );
        }
    });
    
}



/*
When we first load the page this will load whatever category we specified as the default to display in fetch_pages.php where you 
can set $_SESSION['cats'] = "3";  on line 20, substituting whatever default category ID you wish
*/
$( window ).load(function() {

    rememberstates(); //Function remembers the checkboxes states

            $.ajax({
                cache: false,
                timeout: 8000,
                url:  wnm_custom.template_url + "/ajax-pagination.php",
                type: "POST",

                success: function( data, textStatus, jqXHR ){
                    var $ajax_response = $( data );
                   $("#results").append( data );
                },

                error: function( jqXHR, textStatus, errorThrown ){
                    console.log( 'The following error occured: ' + textStatus, errorThrown );   
                },

                complete: function( jqXHR, textStatus ){

                }
            });



    });





/*
This is the normal function which will be utilized whenever choosing categories and navigating through the paginated results
*/
$(document).ready(function(){

    rememberstates(); //Function remembers the checkboxes states
   
    $( '.filter-blog' ).on( 'change', function( e ) { 

        e.preventDefault();

        setLocalCookies(); //Function to set the cookies states

        var categoryChosen = $('#category').val(); 
        var authorChosen = $('#author').val(); 
        var dateChosen = $('#date-filter').val(); 


           $.ajax({
                cache: false,
                timeout: 8000,
                url:  wnm_custom.template_url + "/ajax-pagination.php",
                type: "POST",
                data: {'cat' : categoryChosen, 'auth' : authorChosen, 'dat' : dateChosen },

               beforeSend: function() {                    
                    $( '#results' ).html( '<img class="loadingSVG" src="' + wnm_custom.template_url + '/images/loading-cylon-red.svg" width="256" height="32" >' );
                },

                success: function( data, textStatus, jqXHR ){

                    var $ajax_response = $( data );

                    $('#results').html($ajax_response).fadeIn(); 
                },

                error: function( jqXHR, textStatus, errorThrown ){
                    console.log( 'The following error occured: ' + textStatus, errorThrown );   
                },

                complete: function( jqXHR, textStatus ){

                }

            });

    });
    
AjaxPaginationButtons();


});



})(jQuery);


