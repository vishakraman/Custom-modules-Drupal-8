Drupal.behaviors.image_api = {
  attach: function(context, settings) {
  	jQuery('.owl-carousel').owlCarousel({
    loop:true,
    margin:10,
    nav:true,
    dots:true,
    responsive:{
        0:{
            items:1
        },
        600:{
            items:3
        },
        1000:{
            items:5
        }
    }
})
  },
  detach: function(context, settings, trigger) {
  }
};