(function(){
  var section = $('.component--featured');
  
  section.find('.article-container.mobile-only.owl-carousel').owlCarousel(getCarouselConfig({
    items: 1,
    dots: true,
    nav: false
  }));

})();