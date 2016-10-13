(function(){
  var component = $('.component--header');

  component.find('.menu-button').on('click', function (ev) {
    component.toggleClass('menu-open');
  });

  component.find('.mobile-menubar .main-menu > li > a').on('click', function (ev) {
    var $this = $(this);
    $this.siblings('.sub-menu').slideToggle();

    if ( $this.find('.sub-menu').length ) {
      ev.preventDefault();
    }
  });
  
})();