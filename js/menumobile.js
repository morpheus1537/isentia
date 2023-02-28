jQuery(document).ready(function($) {
	if (window.screen.width <= 980) {
		// collapse function here
		$('#menu-drop-down > li.menu-item-has-children').append("<div class='toggle-collapse'></div>")

		$(document).on('click', '.toggle-collapse', function(){
			$('#menu-drop-down > li.menu-item-has-children').not($(this).parent()).addClass('close');
			$(this).parent().toggleClass('close');
		});

		var $heightSubmenu = $('#menu-drop-down > li.menu-item-has-children > .sub-menu').height()
		$('#menu-drop-down > li.menu-item-has-children > .sub-menu').css('max-height', $heightSubmenu)

		var $level2menu = $('#menu-drop-down > li.menu-item-has-children > .sub-menu > li.menu-item-has-children')
		$level2menu.append("<div class='toggle-collapse2'></div>")
		$(document).on('click', '.toggle-collapse2', function(){
		  $level2menu.not($(this).parent()).addClass('close');
		  $(this).parent().toggleClass('close');
		});

		var $heightSubmenu2 = $('#menu-drop-down > li.menu-item-has-children > .sub-menu > li.menu-item-has-children > .sub-menu').height()
		$('#menu-drop-down > li.menu-item-has-children > .sub-menu > li.menu-item-has-children > .sub-menu').css('max-height', $heightSubmenu2)

		$('#menu-drop-down > li.menu-item-has-children').addClass('close')
		$level2menu.addClass('close')
		
		// prevent body scroll
		$('.mobile-handle').on('click', function() {
		  $('body').addClass('menu-opened')
		});

		$('.close-menu').on('click', function() {
		  $('body').removeClass('menu-opened')
		});
	}
});
