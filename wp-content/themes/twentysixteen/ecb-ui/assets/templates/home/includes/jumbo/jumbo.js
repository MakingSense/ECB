(function(){
  var $jumbo = $('.component--jumbo');
  var $jumboSelector = $('.component--jumbo-selector');
  var $jumboSelectorButtons = $jumboSelector.find('.button-container').children('a');

  $(document).ready(function(){
    setTimeout(removeJumboGrayscale, 5000);
    setInterval(autochangeJumboImage, 10000);
  });

  $jumboSelectorButtons.on('click', changeJumboActive);

  function changeJumboActive(e, newIndex){
    var index = (typeof (newIndex) === 'number') ? newIndex : parseInt($(this).data('jumbo-id'));
    var activeClass = 'active';

    function switchActiveElement(collection, index) {
      return collection.removeClass(activeClass).eq(index).addClass(activeClass);
    }

    switchActiveElement($jumbo.children(), index);
    switchActiveElement($jumbo.find('.owl-dots').children(), index);
    switchActiveElement($jumboSelector.find('.text-container').children(), index);
    switchActiveElement($jumboSelector.find('.button-container .text'), index);
    switchActiveElement($jumboSelectorButtons, index);

    if (e) {
      e.preventDefault();
    }
  }

  function removeJumboGrayscale(){
    $jumbo.find('.grayscale').removeClass('grayscale');
  }

  function autochangeJumboImage(){
    var index = parseInt($jumboSelectorButtons.filter('.active').data('jumbo-id'));
    index = (index < $jumboSelectorButtons.length - 1) ? index+1 : 0;
    changeJumboActive(null, index);
  }

})();
