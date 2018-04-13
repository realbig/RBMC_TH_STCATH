/**
 Header.

 @since 0.1.0
 @package StCatherine
 */
(function ($) {
    'use strict';

    var $header = $('#site-header');

    // Header background change on scroll
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

    // Nav menu toggle
    $header.find('.site-nav-toggle').click(function () {
       $(this).toggleClass('active').siblings('.site-nav-container').toggleClass('visible');
    });

    // Nav menu mobile toggle
    $header.find('.site-nav').find('.menu-item').click(function (e) {

        if ( $(window).width() > 640 ) {
            return;
        }

        e.stopPropagation();

        var active = $(this).hasClass('mHover');

        $(this).closest('.site-nav').find('.menu-item').removeClass('mHover');
        $(this).parents('.menu-item').addClass('mHover');

        if (!active) {
            $(this).addClass('mHover');
            e.preventDefault();
        }
    });

    // Mobile nav menu height
    $(navHeight);
    $(window).resize(navHeight);

    function navHeight() {
        $header.find('.site-nav-container').css('max-height', $(window).height() - $header.height());
    }

})(jQuery);