(function(){
  var section = $('.section--home');
  setCarousels();

  function setCarousels() {
    section.find('.blog-wrapper.desktop-only .owl-carousel').owlCarousel(getCarouselConfig({
      nav: true
    }));
    
    section.find('.blog-wrapper.mobile-only .owl-carousel').owlCarousel(getCarouselConfig({
      items: 1,
      dots: true,
      nav: false
    }));
    
    section.find('.instagram.mobile-only .image-container').owlCarousel(getCarouselConfig({
      items: 3
    }));
  }

  
})();