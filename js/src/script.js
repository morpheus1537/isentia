/***
 *  Define userAgent for all things fancy
 */

var b = document.documentElement;
b.className = b.className.replace('no-js', 'js');
b.setAttribute("data-useragent",  navigator.userAgent);
b.setAttribute("data-platform", navigator.platform );

/***
 *  Header scroll functionality
 */

 (($) => {
    $(window).scroll(function() {
        const scrollTop = $(this).scrollTop();
        const header = $("header");

        if (scrollTop > 0 && !header.hasClass('hover')) {
            header.addClass('hover');
        } else if (header.hasClass('hover') && scrollTop === 0) {
            header.removeClass('hover');
        }
    });
 })(jQuery);

/**
 *  Header search form functionality
 */
(($) => {
    const searchContainer = $("#pre-navigation .menu-container > .search");
    const btn = searchContainer.children('span');
    const form = searchContainer.children('form');

    btn.click(function() {
        btn.hide();
        form.show();
    })
})(jQuery);

/**
 *  Mobile nav functionality
 */

(($) => {
    const header = $("header");
    const handle = header.find('.mobile-handle');
    const close = header.find('.close-menu');

    handle.click(function() {
        $(this).next('.menu-container').addClass('active');
    });

    close.click(function() {
        $(this).parents('.menu-container').removeClass('active');
    });
})(jQuery);

/**
 *  Load script function
 */
(($) => {
    $.loadScript = function (url, callback) {
        $.ajax({
            url: url,
            dataType: 'script',
            success: callback,
            async: true
        });
    }
})(jQuery);

/**
 *  Marketo form control
 */
(($) => {
    const forms = $("form[data-mktoFormID]");

    // Load script if a marketo form is found
    if (forms.length > 0) {
        $.loadScript('//app-sn03.marketo.com/js/forms2/js/forms2.min.js', function(){
            // Stuff to do after someScript has loaded
            // Process all forms
            forms.each(function(i, form) {
                MktoForms2.loadForm("//app-sn03.marketo.com", "114-HJX-968", $(form).data('mktoformid'), function(mktoFormObj) {
                    // General form functionality
                    const mktoForm = mktoFormObj.getFormElem();
                    $(mktoForm).find('input[type=text], input[type=tel], input[type=email], textarea')
                        .on('focus', function() {
                            $(this).parent().addClass('dirty');
                        })
                        .on('blur', function() {
                            if ($(this).val() === '')
                                $(this).parent().removeClass('dirty');
                        })

                    mktoFormObj.onValidate(function() {
                        //console.log('Validate');
                    })

                    mktoFormObj.onSubmit(function() {
                        //console.log('Submit');
                        //mktoFormObj.submittable(false);
                        if ( 1189 == $(form).data('mktoformid') ) {
                            ga('gtm2.send', {
                              hitType: 'event',
                              eventCategory: 'contact-form',
                              eventAction: 'click',
                            });
                        }
                        if ( 1709 == $(form).data('mktoformid') ) {
                            ga('gtm2.send', {
                              hitType: 'event',
                              eventCategory: 'request-demo-btn',
                              eventAction: 'click',
                            });
                        }
                        ga('gtm2.send', {
                              hitType: 'event',
                              eventCategory: 'submit-any-form',
                              eventAction: 'click',
                        });
                    });

                    mktoFormObj.onSuccess(function() {
                        //console.log('Success');
                        const mktoForm = mktoFormObj.getFormElem();
                        mktoForm.addClass('hide');
                        mktoForm.next('.formSuccess').addClass('active');
                        return false;
                    });
                });
            });
        });
    }
})(jQuery);

/***
 *  ScrollTo functionality
 */

(($) => {
    $("body").on("click", "[data-scrollto]", function(e) {
        e.preventDefault();
        const body = $("html, body");
        const btn = $(this);
        const target = $("#"+btn.data('scrollto'));

        body.stop().animate({scrollTop:target.offset().top}, 500, 'swing');
    })
})(jQuery);

/***
 *  Mobile swipe function
 */

 (($) => {
    $.detectSwipe = function(el, f, passEl) {
        var detect = {
            startX: 0,
            startY: 0,
            endX: 0,
            endY: 0,
            minX: 30,   // min X swipe for horizontal swipe
            maxX: 30,   // max X difference for vertical swipe
            minY: 50,   // min Y swipe for vertical swipe
            maxY: 60    // max Y difference for horizontal swipe
        },
            direction = null,
            element = el[0];
    
        element.addEventListener('touchstart', function (event) {
            var touch = event.touches[0];
            detect.startX = touch.screenX;
            detect.startY = touch.screenY;
        });
    
        element.addEventListener('touchmove', function (event) {
            event.preventDefault();
            var touch = event.touches[0];
            detect.endX = touch.screenX;
            detect.endY = touch.screenY;
        });
    
        element.addEventListener('touchend', function (event) {
            if (
                // Horizontal move.
                (Math.abs(detect.endX - detect.startX) > detect.minX)
                    && (Math.abs(detect.endY - detect.startY) < detect.maxY)
            ) {
                direction = (detect.endX > detect.startX) ? 'right' : 'left';
            } else if (
                // Vertical move.
                (Math.abs(detect.endY - detect.startY) > detect.minY)
                    && (Math.abs(detect.endX - detect.startX) < detect.maxX)
            ) {
                direction = (detect.endY > detect.startY) ? 'down' : 'up';
            }
    
            if ((direction !== null) && (typeof f === 'function')) {
                f(direction, passEl);
            }
        });
    }
 })(jQuery);

/* COMPONENTS */

/***
 *  Tabbed content image
 */
(function($) {
    const section = $(".sectionTemplate.tabbedContentImage");

    section.find(".sectionItem").click(function() {
        // Ensure we aren't clicking on the currently active section
        if (!$(this).hasClass('active')) {
            // Get section names
            const current = $(this).parent().children(".active").data('section');
            const next = $(this).data('section');

            // Add/remove classes on found sections
            section.find("[data-section='"+current+"']").removeClass('active');
            section.find("[data-section='"+next+"']").addClass('active');
        }
    });
})(jQuery);

/***
 * Testimonials
 */

(function($) {
    const section = $("#testimonials, .sectionTemplate.testimonial");
    const navigation = section.find(".navigation");

    navigation.children().click(function() {
        const direction = $(this).data('dir');
        const current = $(this).closest('.testimonial');

        if (direction > 0) {
            // Next
            let next = current.next(".testimonial");
            if (next.length === 0) next = current.parent().children().first();
            current.removeClass('active');
            next.addClass('active');
        } else {
            // Prev
            let prev = current.prev(".testimonial");
            if (prev.length === 0) prev = current.parent().children().last();
            current.removeClass('active');
            prev.addClass('active');
        }
    })
})(jQuery);