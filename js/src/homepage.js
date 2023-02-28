/**
 *  Department section functionality
 */
(function($) {
    const section = $("#departments");

    section.find(".departmentItem").click(function() {
        if (!$(this).hasClass('active')) {
            const current = $(this).parent().children(".active").data('department');
            const next = $(this).data('department');
    
            section.find("[data-department='"+current+"']").removeClass('active');
            section.find("[data-department='"+next+"']").addClass('active');
    
            // add active class to first three items
            section.find('.departmentItem').removeClass('active').slice(0, 3).addClass('active');
        }
    });

    section.find('h5').click(function() {
        if (!section.find(".departmentMenu").is(":visible") && !$(this).parents(".contentBlock").hasClass('active')) {
            const current = $(this).parents(".contentBlocks").children(".active").data('department');
            const next = $(this).parents(".contentBlock").data('department');

            section.find("[data-department='"+current+"']").removeClass('active');
            section.find("[data-department='"+next+"']").addClass('active');
        }
    })
})(jQuery);




