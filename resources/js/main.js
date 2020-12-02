
$(document).ready(function () {
    // etc
        (function($) {

        "use strict";

        var fullHeight = function() {

            $('.js-fullheight').css('height', $(window).height());
            $(window).resize(function(){
                $('.js-fullheight').css('height', $(window).height());
            });

        };
        // fullHeight();


        $('#sidebarCollapse').on('click', function () {
            $('#sidebar').toggleClass('active');
        });

    })(jQuery);
});




// console.log('edjgvhsbjs wh ekfs')
