/**
 *  Active section functionality
 */
(function ($) {
    function discover() {
        // var viewport = /Android|webOS|iPhone|iPad|iPod|BlackBerry|IEMobile|Opera Mini/i.test(navigator.userAgent);
        if ($(window).width() >= 768) {
            var sectionWrapper = $("#discover");
            sectionWrapper.find(".hoverMenu").first().addClass('active');
            sectionWrapper.find(".hoverMenuItem").first().addClass('active');
            sectionWrapper.find(".hoverMenu").hover(function () {
                if (!$(this).hasClass("active")) {
                    var id = $(this).parent().children(".active").data("section"),
                        id2 = $(this).data("section");
                    sectionWrapper.find("[data-section='" + id + "']").removeClass("active"),
                        sectionWrapper.find("[data-section='" + id2 + "']").addClass("active")
                }
            })
        } else {
            var sectionWrapper = $("#discover");
            sectionWrapper.find(".hoverMenu").first().removeClass('active');
            sectionWrapper.find(".hoverMenuItem").first().removeClass('active');
            sectionWrapper.find(".hoverMenu").off('mouseenter mouseleave');
        }
    }
    $(discover)
    $(window).resize(discover)
})(jQuery);