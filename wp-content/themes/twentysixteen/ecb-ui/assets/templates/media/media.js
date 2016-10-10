(function(){
  var section = $('.section--media');
  setCarousels();

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