/**
 Header.

 @since 0.1.0
 @package StCatherine
 */
(function ($) {
    'use strict';

    var $header = $('#site-header');

    $(changeHeader);
    $(window).scroll(changeHeader);

    function changeHeader() {

        var current_scroll = $(window).scrollTop(),
            breakpoint = 200;

        if (current_scroll > breakpoint) {
            $header.addClass('alt');
        } else {
            $header.removeClass('alt');
        }
    }

})(jQuery);