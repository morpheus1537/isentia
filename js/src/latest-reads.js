/**
 *  FILTER NAV AND FUNCTIONALITY
 */
(($) => {
    const filters = $("#filterBar .filters");
    const articles = $("#all-posts .articles");

    filters.children('.filter').click(function(e) {
        e.preventDefault();
        const button = $(this),
            loader = $("#loader"),
            data = {
                'action': 'filterposts',
                'category': $(this).data('set')
            };

        
 
		$.ajax({
			url : latest_reads_params.ajaxurl,
			data : data,
			type : 'POST',
			beforeSend : function ( xhr ) {
                articles.html("<span class='message'>Filtering...</span>");
                loader.remove();
                filters.find('.active').removeClass('active');
                button.addClass('active');
			},
			success : function( data ){
				if( data ) { 
                    data = JSON.parse(data);
                    articles.hide().html(data.posts).slideDown(400);
                    if (data.max_pages > 1) {
                        articles.after('<div id="loader">'+
                            '<span class="ibtn secondary large" id="loaderAction" data-category="'+data.category+'" data-maxpages="'+data.max_pages+'">Load more</span>'+
                        '</div>');
                    }
				} else {
                    articles.html("<span class='message'>No post found for filter</span>");
                }
			}
		});
    });
})(jQuery);

/***
 *  LOAD MORE
 */
(($) => {
    $("body").on("click", "#loaderAction", function() {
        const button = $(this),
            loader = $("#loader"),
		    data = {
                'action': 'loadmore',
                'page' : latest_reads_params.current_page,
                'category' : $(this).data('category')
            };
        const maxpages = button.data('maxpages');
 
		$.ajax({
			url : latest_reads_params.ajaxurl,
			data : data,
			type : 'POST',
			beforeSend : function ( xhr ) {
				button.text('Loading...');
			},
			success : function( data ){
				if( data ) { 
                    button.text( 'Load more' );
                    loader.prev().append(data);
					latest_reads_params.current_page++;
                    
					if ( latest_reads_params.current_page === maxpages ) 
						button.remove();
				} else {
					button.remove();
				}
			}
		});
    });
})(jQuery);

/***
 *  LOAD MORE SEARCH
 */
(($) => {
    $("body").on("click", "#loaderSearchAction", function() {
        const button = $(this),
            loader = $("#loader"),
		    data = {
                'action': 'loadmoresearch',
                'page' : latest_reads_params.current_page
            };
        const maxpages = button.data('maxpages');
 
		$.ajax({
			url : latest_reads_params.ajaxurl,
			data : data,
			type : 'POST',
			beforeSend : function ( xhr ) {
				button.text('Loading...');
			},
			success : function( data ){
				if( data ) { 
                    button.text( 'Load more' );
                    loader.prev().append(data);
					latest_reads_params.current_page++;
                    
					if ( latest_reads_params.current_page === maxpages ) 
						button.remove();
				} else {
					button.remove();
				}
			}
		});
    });
})(jQuery);