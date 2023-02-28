/**
 *  TABS
 */

 (($) => {
    const section = $("#tabs");

    section.find(".tab").click(function() {
        if (!$(this).hasClass('active')) {
            const current = section.find(".tab.active");
            current.removeClass('active');
            $(this).addClass('active');

            $("#"+current.data('tab')).removeClass('active');
            $("#"+$(this).data('tab')).addClass('active');
        }
    })
 })(jQuery);

 /**
 *  FILTERING
 */
(($) => {
    const filters = $(".filters");
    const master_copys = {};

    const filter_display = (id) => {
        const filter = $("#"+id);
        const table_data = filter.parents('.filters').next('.table_data');

        let filter_by_fy = "";
        if (filter.val() !== "") filter_by_fy = "[data-fy='"+filter.val()+"']";

        table_data.html(master_copys[id]);
        table_data.find('li').addClass('hide');
        table_data.find('li'+filter_by_fy).removeClass('hide');
        table_data.find('li.hide').remove();

        if (table_data.find('li').length === 0) {
            table_data.html("<ul><li class='none-found'>No documents found.</li></ul>");
        }
    }

    filters.each(function() {
        let filter = $(this).find('select');
        let id = filter.attr('id');
        let table_data = $(this).next('.table_data');
        master_copys[id] = table_data.html();

        filter.change(function() {
            filter_display(id);
        });

        filter_display(id);
    });
})(jQuery);

/***
 *  LOAD MORE POSTS
 */
(($) => {
    $("body").on("click", "#loaderAction", function() {
        const button = $(this),
            loader = $("#loader"),
		    data = {
                'action': 'loadmoremedia',
                'page' : investors_params.current_page
            };
        const maxpages = button.data('maxpages');
 
		$.ajax({
			url : investors_params.ajaxurl,
			data : data,
			type : 'POST',
			beforeSend : function ( xhr ) {
				button.text('Loading...');
			},
			success : function( data ){
				if( data ) { 
                    button.text( 'Load more' );
                    loader.prev().append(data);
					investors_params.current_page++;
                    
					if ( investors_params.current_page === maxpages ) 
						button.remove();
				} else {
					button.remove();
				}
			}
		});
    });
})(jQuery);

/**
 *  SLIDE THROUGH
 */

(($) => {
    const sliders = $(".team-list");
    let motion = false;

    const move_cards = (move, slider) => {
        motion = true;
        const current = slider.data('move');
        if (!$.isNumeric(move)) {
            if (move === 'left') move = current + 1;
            else if (move === 'right') move = current - 1;
            else return;
        }
        const max = slider.data('max');
        const direction = current < move ? "20px" : "-20px";
        if (move === max) move = 0;
        if (move < 0) move = max-1;
        
        /* Handle cards */
        slider.css({"left":"-"+(move*100)+"%"}).children().removeClass('active').removeAttr('style');
        slider.children().eq((move*2)).css({left:direction}).animate({left:0, opacity:1}, 800, function() {$(this).addClass('active'); motion = false;});
        slider.children().eq((move*2)+1).css({left:direction}).animate({left:0, opacity:1}, 800, function() {$(this).addClass('active')});

        /* Handle settings */
        slider.data('move', move);
    }

    sliders.each(function() {
        let slider = $(this);
        let controls = $(this).next('.section-nav');
        let max = Math.ceil(slider.children().length / 2);
        slider.data('max', max);

        controls.children('span').click(function() {
            const direction = $(this).data('dir');
            const move = slider.data('move') + direction;
    
            if (!motion) move_cards(move, slider);
        });

        $.detectSwipe(slider.parent(), move_cards, slider);
    });
})(jQuery);

/**
 *  SEARCH FORM FUNCTIONALITY
 */
(function($) {
    const searchContainer = $("#latest-news #media-releases .search");
    const btn = searchContainer.children('span');
    const form = searchContainer.children('form');

    btn.click(function() {
        btn.hide();
        form.show();
    })
})(jQuery);

/***
 *  TEAM MEMBER BIOS
 */

(($) => {
    const members = $(".team-member");
    members.click(function() {
        $(this).children('.bio-container').toggleClass('active');
    });
})(jQuery);