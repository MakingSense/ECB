var isMobile = window.innerWidth < 1024;

function getCarouselConfig(config) {
  var defaultValues = {
    items: 2,
    loop: true,
    dots: false,
    nav: true,
    navText: [
      '<img src="' + DIRECTORY_URI + '/img/arrow-left.svg" />',
      '<img src="' + DIRECTORY_URI + '/img/arrow-right.svg" />',
    ]
  };

  for (key in config) {
    defaultValues[key] = config[key];
  }

  return defaultValues;
}
