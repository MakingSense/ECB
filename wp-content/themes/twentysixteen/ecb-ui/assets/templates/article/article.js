(function(){
  var section = $('.section--article');
  setCarousels();

  function setCarousels() {
    console.log(section.find('.images-container.owl-carousel'));
    section.find('.images-container.owl-carousel').owlCarousel(getCarouselConfig({
      items: 1,
      nav: true
    }));
  }
})();