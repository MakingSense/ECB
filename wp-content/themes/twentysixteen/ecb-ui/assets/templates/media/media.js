(function(){
  var section = $('.section--media');
  setCarousels();
  setAsideMenu();

  function setAsideMenu() {
    var menus = section.find('.media-menu');
    menus.find('.menuitem').on('click', function(e){
      menus.removeClass('active').eq($(this).index()).addClass('active');
    });
  }

  function setCarousels() {
    section.find('.stats.mobile-only.owl-carousel').owlCarousel(getCarouselConfig({
      items: 1,
      nav: true
    }));

    section.find('.video-collection.mobile-only.owl-carousel').owlCarousel(getCarouselConfig({
      items: 1,
      dots: true,
      nav: false
    }));
  }
})();
