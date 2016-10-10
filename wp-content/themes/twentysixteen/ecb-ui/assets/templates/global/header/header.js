(function(){
  var component = $('.component--header');

  component.find('.menu-button').on('click', function (ev) {
    component.toggleClass('menu-open');
  });

  component.find('.mobile-menubar li > a').on('click', function (ev) {
    $(this).siblings('.sub-menu').slideToggle();
  });
  
})();