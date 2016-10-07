(function($) {

  $(document).ready(function(){
    rememberstates(); //Function remembers the checkboxes states
    getFilteredPosts();

    $("#results").on("click", "#nextbutton", paginationHandler);

    $('.filter-blog').on('change', function(e) {
      setLocalCookies(); //Function to set the cookies states
      getFilteredPosts();
      e.preventDefault();
    });
  });

  /* When clicking ajax pagination links display loading logo while loading results */
  function paginationHandler(e) {
    var page = $(this).attr("data-page"); //get page number from link
    $(this).remove();
    getFilteredPosts(page);
    e.preventDefault();
  }

  /*
  Loop through all localstorage cookies and assign them to a variable, then check all the checkboxes ID's to see if 
  they match and if they do we set the checkboxes attribute the checked so that it stays checked after page refresh
  */
  function rememberstates() {
    for (var i = 0; i < localStorage.length; i++) {
      var cookies = localStorage.key(i);

      $(".checkboxcat").each(function(i, e) {
        var getCheckboxID = $(this).attr('id');

        if (getCheckboxID === cookies) {
          $(this).attr('checked', 'checked');
        }
      });
    }
  }

  /*
  When clicking checkboxes this function will create or destroy a cookie depending what state you 
  leave the checkbox after clicking
  */
  function setLocalCookies() {
    $(".checkboxcat").each(function(i, e) {
      if ($(this).is(":checked")) {
        var checkboxID = $(this).attr("id"); //set the name of the cookie equal to the dynamic ID name
        var checkboxDataTag = $(this).attr("data-cat") //set the cookie value equal to the data-cat attribute, just an integer
        localStorage.setItem(checkboxID, checkboxDataTag);
      } else if ($(this).is(":not(:checked)")) {
        var checkboxID = $(this).attr("id");
        localStorage.removeItem(checkboxID);
      }
    });
  }

  function getFilteredPosts(page) {
    var categoryChosen = $('#category').val();
    var authorChosen = $('#author').val();
    var dateChosen = $('#date-filter').val();

    $.ajax({
      cache: false,
      timeout: 8000,
      url: wnm_custom.template_url + "/ajax-pagination.php",
      type: "POST",
      data: {
        'cat': categoryChosen,
        'auth': authorChosen,
        'dat': dateChosen,
        'page': page || 1
      },

      success: function(data, textStatus, jqXHR) {
        if (page) {
          $('#results').append(data).fadeIn();
        } else {
          $('#results').html(data).fadeIn();
        }
      },

      error: function(jqXHR, textStatus, errorThrown) {
        console.log('The following error occured: ' + textStatus, errorThrown);
      }

    });
  }

})(jQuery);

