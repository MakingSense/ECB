(function(){
  var section = $('.section--article');
  setCarousels();

  function setCarousels() {
    section.find('.main.images-container.owl-carousel').owlCarousel(getCarouselConfig({
      items: 1,
      nav: true
    }));

    section.find('.aside.images-container.owl-carousel.mobile-only').owlCarousel(getCarouselConfig({
      items: 2,
      nav: false,
      dots: false
    }));

    section.find('.article-container.owl-carousel.mobile-only').owlCarousel(getCarouselConfig({
      items: 1,
      dots: false
    }));
  }
})();
