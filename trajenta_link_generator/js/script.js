(function ($, Drupal, drupalSettings) {
  Drupal.behaviors.my_library = {
    attach: function (context, settings) {

      alert(drupalSettings.trajenta_js.some_variable1); //alerts the value of PHP's $value
      alert("hello"); //alerts the value of PHP's $value

    }
  };
})(jQuery, Drupal, drupalSettings);