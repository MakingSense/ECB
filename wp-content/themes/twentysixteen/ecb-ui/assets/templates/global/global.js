function getCarouselConfig(config) {
  var defaultValues = {
    items: 2,
    loop: true,
    dots: false,
    nav: true,
    navText: [
      '<span class="ms-icon icon-arrow-left"></span>',
      '<span class="ms-icon icon-arrow-right"></span>'
    ]
  };

  for (key in config) {
    defaultValues[key] = config[key];
  }

  return defaultValues;
}