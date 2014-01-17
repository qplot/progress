/**
 * @file
 * A JavaScript file for the theme.
 *
 * In order for this JavaScript to be loaded on pages, see the instructions in
 * the README.txt next to this file.
 */

// JavaScript should be made compatible with libraries other than jQuery by
// wrapping it with an "anonymous closure". See:
// - https://drupal.org/node/1446420
// - http://www.adequatelygood.com/2010/3/JavaScript-Module-Pattern-In-Depth
(function ($, Drupal, window, document, undefined) {


// To understand behaviors, see https://drupal.org/node/756722#behaviors
Drupal.behaviors.my_custom_behavior = {
  attach: function(context, settings) {
	console.log('called');

    // Place your code here.
	$(document).ready(function() {
		if (!($("#block-menu-block-1 .menu-block-wrapper > ul.menu").hasClass('skin-color'))) {
			console.log('menu applied');
			$("#block-menu-block-1 .menu-block-wrapper > ul.menu").addClass('skin-color');
			$("#block-menu-block-1 .menu-block-wrapper > ul.menu").ctAccordion();
		}
		if (!($("#block-views-companies-block-1 .view-content > ul.menu").hasClass('skin-color'))) {
			console.log('menu applied');
			$("#block-views-companies-block-1 .view-content > ul.menu").addClass('skin-color');
			$("#block-views-companies-block-1 .view-content > ul.menu").ctAccordion();
		}

	});

  }
};


})(jQuery, Drupal, this, this.document);
