(function ($) {
    $.fn.myCarousel = function (options) {
        var defaults = {
            transition : 'fade',
        },
            options = $.extend(defaults, options);

        this.each(function () {
            $('#ul_carousel').wrap('<div class="slider-wrap"></div>');
            $(this).css({
                'width' : '800px',
                'height' : '500px',
                'position' : 'relative',
                'padding' : 0
            });

            if (options.transition === 'fade') {
                $(this).children().css({
                    'width' : $(this).children().width(),
                    'position' : 'absolute',
                    'left' : 0
                });
                var slideIndex = 1;
                showSlide(slideIndex);
            }

            function slideChange(index)
            {
                showSlide(slideIndex += index);
            }

            function showSlide()
            {
                var slides = $('.carousel_slides');

                if (slideIndex < 1) {
                    slideIndex = slides.length;
                }
                if (slideIndex > slides.length) {
                    slideIndex = 1;
                }
                var i;
                for (i = 0; i < slides.length; i++) {
                    slides.eq(i).hide();
                }
                slides.eq(slideIndex-1).slideDown(1000);
            }

            $("#carousel_right_arrow").on('click', (function () {
                slideChange(1);
            }));
            $("#carousel_left_arrow").on('click', (function () {
                slideChange(-1);
            }));
        });
    }
}(jQuery));