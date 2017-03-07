var $ = require('jquery');

module.exports = function () {

    $(document).ready(function () {

        initCarousel();

        $('.carousel__navArrow').on('click', function (e) {
            e.preventDefault();
            var way = ($(this).hasClass('carousel__navArrow-left')) ? 'prev' : 'next';
            navigate(way);
        });

    });

    function initCarousel() {
        $('.carousel__navArrow-left').hide();
    }

    function navigate(way) {
        console.log('event');
        var $active = $('.carousel__containerImg-active'),
            $left = $('.carousel__navArrow-left'),
            $right = $('.carousel__navArrow-right'),
            $imgs = $('.carousel__containerImg');

        console.log($($imgs[0]), $($imgs[$imgs.length - 1]));
        if (way == 'next') {
            var $next = $active.next('.carousel__containerImg');

            $active
                .addClass('carousel__containerImg-prev')
                .prev('.carousel__containerImg').removeClass('carousel__containerImg-prev');
            $next
                .addClass('carousel__containerImg-active').removeClass('carousel__containerImg-next')
                .next('.carousel__containerImg').addClass('carousel__containerImg-next');

            $left.show();
            (!$($imgs[$imgs.length - 1]).hasClass('carousel__containerImg-active')) ? $right.show() : $right.hide();
        } else {
            var $previous = $active.prev('.carousel__containerImg');

            $active
                .addClass('carousel__containerImg-next')
                .next('.carousel__containerImg').removeClass('carousel__containerImg-next');
            $previous
                .addClass('carousel__containerImg-active').removeClass('carousel__containerImg-prev')
                .prev('.carousel__containerImg').addClass('carousel__containerImg-prev');

            $right.show();
            (!$($imgs[0]).hasClass('carousel__containerImg-active')) ? $left.show() : $left.hide();
        }

        $active.removeClass('carousel__containerImg-active');

    }
};
