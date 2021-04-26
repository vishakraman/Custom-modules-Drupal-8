Drupal.behaviors.covid_cases = {
  attach: function(context, settings) {
	$(document).ready( function () {
	$('#corona_tracker').DataTable();
	$('table#corona_tracker tr td').css('color', 'black');
	} );

  },
  detach: function(context, settings, trigger) {
  }
};