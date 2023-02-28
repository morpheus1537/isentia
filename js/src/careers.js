/**
 *  Team mobile navigation
 */

(($) => {
    const section = $("#teams");
    const cards = section.find(".teams");
    const nav = section.find(".teams-nav");

    const move_cards = (move) => {
        const current = cards.data('move');
        if (!$.isNumeric(move)) {
            if (move === 'left') move = current + 1;
            else if (move === 'right') move = current - 1;
            else return;
        }
        if (move < 0 || move > cards.children().length - 1) return;
        const direction = current < move ? "20px" : "-20px";

        /* Handle nav */
        nav.children().removeClass('active');
        nav.children('span[data-move='+move+']').addClass('active');

        /* Handle cards */
        cards.css({"margin-left":"-"+(move*100)+"%"}).children().removeClass('active').removeAttr('style');
        cards.children().eq((move)).css({left:direction}).animate({left:0, opacity:1}, 800, function() {$(this).addClass('active')});

        /* Handle settings */
        cards.data('move', move);
    }

    nav.children('span').click(function() {
        if (!$(this).hasClass('active')) {
            move_cards($(this).data('move'));
        }
    });

    $.detectSwipe(section, move_cards);
})(jQuery);

/**
 *  Benefits navigation
 */

(($) => {
    const section = $("#benefits");
    const cards = section.find(".benefits");
    const buttons = section.find(".benefits-buttons");
    const nav = section.find(".benefits-nav, .benefits-mobile-nav");

    const max = cards.data('max');
    const mobile_max = cards.children().length;

    const move_cards = (move) => {
        const current = cards.data('move');
        const direction = current < move ? "20px" : "-20px";
        const run_mobile = $(window).outerWidth() > 680 ? false : true;
        const set_max = run_mobile ? mobile_max : max
        
        /* Handle buttons */
        buttons.children().addClass('active');
        if (move === 0) buttons.children('.prev').removeClass('active');
        if (move === (set_max-1)) buttons.children('.next').removeClass('active');

        /* Handle nav */
        nav.children().removeClass('active');
        nav.children('span[data-move='+move+']').addClass('active');

        /* Handle cards */
        cards.css({"margin-left":"-"+(move*100)+"%"}).children().removeClass('active active-mobile').removeAttr('style');
        if (run_mobile) {
            /* Mobile */
            cards.children().eq((move)).css({left:direction}).animate({left:0, opacity:1}, 800, function() {$(this).addClass('active-mobile')});
        } else {
            /* Desktop */
            cards.children().eq((move*2)).css({left:direction}).animate({left:0, opacity:1}, 800, function() {$(this).addClass('active')});
            cards.children().eq((move*2)+1).css({left:direction}).animate({left:0, opacity:1}, 800, function() {$(this).addClass('active')});
        }

        /* Handle settings */
        cards.data('move', move);
    }

    buttons.children('span').click(function() {
        const direction = $(this).data('dir');
        const move = cards.data('move') + direction;

        move_cards(move);
    });

    nav.children('span').click(function() {
        if (!$(this).hasClass('active')) {
            move_cards($(this).data('move'));
        }
    });
})(jQuery);

/**
 *  Handle job listings on page sections
 */
(($) => {

    // Quick & dirty toggle to demonstrate modal toggle behavior
    $('.modal-toggle').on('click', function(e) {
    e.preventDefault();
    $('.custom-modal').toggleClass('is-visible');
  });
       

    const locations_filter = $("#location_selection");
    const departments_filter = $("#department_selection");
    const listings_paging = $("#listing-pagination");
    const filter_container = locations_filter.parents('.filters');
    const listings_container = $("#listings");
    let master_copy = null;
    let page_copy = null;
    const listing_display = 10;

    const feedSource = $('#listings').data('job-source');
    const feedDataJobAdder = JSON.parse(`${jobAdderData}`);

    let locations = [];

    let locations_set = [];
    let departments = [];
    let departments_set = [];
    const teams_count = {
        "technology": 0,
        "product cx & marketing": 0,
        "operations": 0,
        "sales": 0,
        "insights": 0,
        "corporate": 0
    };
    let listings = [];

    

    // console.log(feedSource);
    if ( feedSource === 'jobadder' && feedDataJobAdder.length > 0 ) {

        // console.log(feedDataJobAdder);

        $.each(feedDataJobAdder, function(i, job) {
            const jobCity = job.Location;

            // console.log(job);

            if ($.trim(jobCity) !== "") {
                let city = $.trim(jobCity).toLowerCase();
                if (locations_set.indexOf(city) === -1) {
                    locations_set.push(city);
                    locations.push("<option value='"+city+"'>"+job.Location+"</option>");
                }

                const addClassification = (job, item) => {
                    const deptItem = $.trim(item).toLowerCase();
                    if ( (departments_set.indexOf(deptItem) === -1 && deptItem.indexOf('time') === -1)  ) {
                        if (deptItem.indexOf('time') === -1 ) {
                            if (deptItem.indexOf('sydney') === -1 ) {
                                departments_set.push(deptItem);
                                departments.push("<option value='"+deptItem+"'>"+item+"</option>");
                            }
                        }
                    }    

                    if (teams_count[deptItem] < 4) {
                        const container = $("#teams .block[data-department='"+deptItem+"'] .links");
                        if (teams_count[deptItem] === 0) {
                            container.html('');
                        }
                        teams_count[deptItem]++;
                        container.append("<a rel='modal:open' data-modal='#modal-"+job.jobID+"' class='textCta' target='_blank' rel='nofollow noopener'>"+job.Title+"</a>")
                    }
                };

                const deptArray = job.Category;
                let departmentLabel = '';
                
                if(Array.isArray(deptArray)){
                    departmentLabel = job.Category.join(', ');
                    $.each(deptArray, function(i, item) {
                        addClassification(job, item);
                    });
                }else{
                    departmentLabel = job.Category;
                    addClassification(job, departmentLabel);
                }
                
                const departmentValue = $.trim(departmentLabel).toLowerCase();
                
                listings.push("<li data-location='"+city+"' data-department='"+departmentValue+"'>"+
                    "<span class='job-title'>"+job.Title+"</span>"+
                    "<span class='job-department'>"+departmentLabel+"</span>"+
                    "<span class='job-location'>"+job.Location+"</span>"+
                    "<span class='job-link'><a class='textCta' rel='modal:open' data-modal='#modal-"+job.jobID+"' target='_blank' rel='nofollow noopener'>Apply now</a></span>"+

                    "<div id='modal-"+job.jobID+"' class='custom-modal' style='display: none;'>" +
                        "<h5>" + job.Title + "</h5>" +
                        "<div id='modal-content'>" + job.Description + "</div>" +
                        "<div class='apply-button'><a href='"+job.Apply.Url+"' class='button' target='_blank'>Apply for this job</a></div>" +
                    "</div>" +

                    "</li>");
            }
        });

        locations_filter.append(locations.join(""));
        locations_filter.html(locations_filter.find('option').sort(function(x, y) {
            return $(x).text() > $(y).text() ? 1 : -1;
        }));
        locations_filter.prepend('<option value="" selected>All Locations</option>');

        departments_filter.append(departments.join(""));
        departments_filter.html(departments_filter.find('option').sort(function(x, y) {
            return $(x).text() > $(y).text() ? 1 : -1;
        }));
        departments_filter.prepend('<option value="" selected>All Categories</option>');

        filter_container.show();
        listings_container.html('');

        const pages = Math.ceil(listings.length / listing_display);
        let current = " active";
        for (let p=1;p<=pages;p++) {
            listings_paging.append("<span class='listings-page"+current+"' data-page='"+p+"'>"+p+"</span>");
            current = '';
        }

        let segment_listings = listings.slice(0, 9);

        $( "<ul/>", {
            html: segment_listings.join("")
        }).appendTo( listings_container );

        master_copy = listings;
        page_copy = master_copy;

        $(function() {
            $('body').on('click', 'a[data-modal]', function() {
                console.log('clicked');
                $($(this).data('modal')).modal();
                return false;
            });
        });

        /**
         * Filtering
         */
        const filter_display = () => {
            const location = locations_filter.val();
            const department = departments_filter.val();
    
            let filter_by_location = "";
            if (location !== "") filter_by_location = "data-location='"+location+"'";
    
            let filter_by_department = "";
            if (department !== "") filter_by_department = department;
    
            let segment_listings = [];
            for (let m=0;m<master_copy.length;m++) {
                if (master_copy[m].indexOf(filter_by_location) > -1 && master_copy[m].indexOf(filter_by_department) > -1) {
                    segment_listings.push(master_copy[m]);
                }
            }
            page_copy = segment_listings;
    
            paging_display(1);
    
            listings_paging.html('');
            const pages = Math.ceil(page_copy.length / listing_display);
            let current = " active";
            for (let p=1;p<=pages;p++) {
                listings_paging.append("<span class='listings-page"+current+"' data-page='"+p+"'>"+p+"</span>");
                current = '';
            }
    
            // listings_container.html(master_copy);
            // listings_container.find('li').addClass('hide');
            // listings_container.find('li'+filter_by_location+filter_by_department).removeClass('hide');
            // listings_container.find('li.hide').remove();
    
            // if (listings_container.find('li').length === 0) {
            //     listings_container.html("<span class='none-found'>There are no job opportunities in the filter set you have used. Please select different options above to see other available roles.</span>")
            // }
        }

        locations_filter.change(function() {
            filter_display();
        });
    
        departments_filter.change(function() {
            filter_display();
        });

    
    } else {
        $.getJSON( "https://api.recruitee.com/c/isentia/careers/offers", function( feed_data ) {
            let locations = [];
            let locations_set = [];
            let departments = [];
            let departments_set = [];
            const teams_count = {
                "technology": 0,
                "product cx & marketing": 0,
                "operations": 0,
                "sales": 0,
                "insights": 0,
                "corporate": 0
            };
            let listings = [];

            $.each(feed_data.offers, function(i, job) {
                if ($.trim(job.city) !== "" && $.trim(job.department)) {
                    let city = $.trim(job.city).toLowerCase();
                    if (locations_set.indexOf(city) === -1) {
                        locations_set.push(city);
                        locations.push("<option value='"+city+"'>"+job.location+"</option>");
                    }

                    let department = $.trim(job.department).toLowerCase();
                    if (departments_set.indexOf(department) === -1) {
                        departments_set.push(department);
                        departments.push("<option value='"+department+"'>"+job.department+"</option>");
                    }

                    listings.push("<li data-location='"+city+"' data-department='"+department+"'>"+
                        "<span class='job-title'>"+job.title+"</span>"+
                        "<span class='job-department'>"+job.department+"</span>"+
                        "<span class='job-location'>"+job.city+"</span>"+
                        "<span class='job-link'><a href='"+job.careers_url+"' class='textCta' target='_blank' rel='nofollow noopener'>Apply now</a></span>"+
                        "</li>");

                    if (teams_count[department] < 4) {
                        const container = $("#teams .block[data-department='"+department+"'] .links");
                        if (teams_count[department] === 0) {
                            container.html('');
                        }
                        teams_count[department]++;
                        container.append("<a href='"+job.careers_url+"' class='textCta' target='_blank' rel='nofollow noopener'>"+job.title+"</a>")
                    }
                }
            });

            locations_filter.append(locations.join(""));
            locations_filter.html(locations_filter.find('option').sort(function(x, y) {
                return $(x).text() > $(y).text() ? 1 : -1;
            }));
            locations_filter.prepend('<option value="" selected>All Locations</option>');

            departments_filter.append(departments.join(""));
            departments_filter.html(departments_filter.find('option').sort(function(x, y) {
                return $(x).text() > $(y).text() ? 1 : -1;
            }));
            departments_filter.prepend('<option value="" selected>All Departments</option>');

            filter_container.show();
            listings_container.html('');

            const pages = Math.ceil(listings.length / listing_display);
            let current = " active";
            for (let p=1;p<=pages;p++) {
                listings_paging.append("<span class='listings-page"+current+"' data-page='"+p+"'>"+p+"</span>");
                current = '';
            }

            let segment_listings = listings.slice(0, 9);

            $( "<ul/>", {
            html: segment_listings.join("")
            }).appendTo( listings_container );

            master_copy = listings;
            page_copy = master_copy;
        });

        const filter_display = () => {
            const location = locations_filter.val();
            const department = departments_filter.val();
    
            let filter_by_location = "";
            if (location !== "") filter_by_location = "data-location='"+location+"'";
    
            let filter_by_department = "";
            if (department !== "") filter_by_department = "data-department='"+department+"'";
    
            let segment_listings = [];
            for (let m=0;m<master_copy.length;m++) {
                // console.log(master_copy[m]);
                if (master_copy[m].indexOf(filter_by_location) > -1 && master_copy[m].indexOf(filter_by_department) > -1) {
                    segment_listings.push(master_copy[m]);
                }
            }
            page_copy = segment_listings;
    
            paging_display(1);
    
            listings_paging.html('');
            const pages = Math.ceil(page_copy.length / listing_display);
            let current = " active";
            for (let p=1;p<=pages;p++) {
                listings_paging.append("<span class='listings-page"+current+"' data-page='"+p+"'>"+p+"</span>");
                current = '';
            }
    
            // listings_container.html(master_copy);
            // listings_container.find('li').addClass('hide');
            // listings_container.find('li'+filter_by_location+filter_by_department).removeClass('hide');
            // listings_container.find('li.hide').remove();
    
            // if (listings_container.find('li').length === 0) {
            //     listings_container.html("<span class='none-found'>There are no job opportunities in the filter set you have used. Please select different options above to see other available roles.</span>")
            // }
        }

        locations_filter.change(function() {
            filter_display();
        });
    
        departments_filter.change(function() {
            filter_display();
        });
    }
        

    const paging_display = (page) => {
        listings_container.html('');
        let segment_listings = page_copy.slice( (listing_display * (page - 1)), ((listing_display * page) - 1) );

        $( "<ul/>", {
          html: segment_listings.join("")
        }).appendTo( listings_container );
        
    }

    listings_paging.on("click", listings_paging.children('.listings-page'), function(e) {
        if ($(e.target)[0] !== $(this)[0]) {
            paging_display($(e.target).data('page'));
            $(e.target).parent().find('.active').removeClass('active');
            $(e.target).addClass('active');
        }
    });
})(jQuery);