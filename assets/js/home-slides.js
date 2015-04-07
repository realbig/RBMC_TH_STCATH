/**
 Home page slide-show.

 @since 0.1.0
 @package StCatherine
 */
(function ($) {
    'use strict';

    $(function () {

        var delay = 8000,
            $slides = $('.home-slides').find('.slide'),
            timer;

        timer = setInterval(slideChange, delay);

        function slideChange() {

            var $current = $slides.filter(':not(.hidden)');

            $slides.addClass('hidden');

            if ($current.index() + 1 >= $slides.length) {
                $slides.eq(0).removeClass('hidden');
            } else {
                $slides.eq($current.index() + 1).removeClass('hidden');
            }
        }
    });

})(jQuery);