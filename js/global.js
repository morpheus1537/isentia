jQuery(document).ready(function($) {
    const winParam = window.location.search
    if (winParam.search('et_fb=1') > 0) {
        $('body').addClass('edit-divi');
    }
});
