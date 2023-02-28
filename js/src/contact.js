/**
 *  Office locations functionality
 */
(function($) {
    const section = $("#offices");

    section.find(".handle").click(function() {
        $(this).parent().toggleClass('open');
    });
})(jQuery);