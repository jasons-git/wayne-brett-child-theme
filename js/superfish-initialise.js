		(function($){ //create closure so we can safely use $ as alias for jQuery

			$(document).ready(function(){
				$('ul.sf-menu').superfish({
					delay:       1000,                            // one second delay on mouseout
					animation:   {opacity:'show',height:'show'},  // fade-in and slide-down animation
					speed:       'fast',                          // faster animation speed
					autoArrows:  false                            // disable generation of arrow mark-up
				});

		})(jQuery);
