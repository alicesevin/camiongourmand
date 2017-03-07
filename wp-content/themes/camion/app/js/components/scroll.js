var $ = require('jquery');
var TweenMax = require('gsap');


module.exports = function () {

    function animations() {

        var $icons = $('.section__bg').find('i');
        var animationLiberty = 0.1;   // j'avais pas de nom de variable
        var animationsRandom = [];

        //pour que la osition y soit différente entre chaques élément
        for (i = 0; i <= $icons.length; i++) {
            animationsRandom.push(Math.random() * (1+ i * 0.3))
        }

        //parralaxe des icons
        function iconsParralaxe() {
            for (i = 0; i <= $icons.length-1; i++) {
                TweenMax.to($icons[i], animationsRandom[i], {y: -($('body').scrollTop()) * animationLiberty})
            }
            return false;
        }

        function fadeText(elements) {
            for (i = 0; i <= elements.length-1; i++) {
                console.log(elements[i].offsetTop)
                console.log($(window).scrollTop())
                if ( $(window).scrollTop() === elements[i].offsetTop) {
                    console.log(elements[i].offsetTop)
                    console.log('yolo')
                }
            }
        }

        $(window).on('scroll', function () {
            iconsParralaxe();
            fadeText($('.section__description'));

        });
    }

    function smoothScroll() {

        $('.cover__nav-link').on('click', function () {
            var page = $(this).attr('href');
            $('html, body').animate({scrollTop: $(page).offset().top}, 300);
            return false;
        });

    }

    $(document).ready(function () {

        animations();
        smoothScroll();

    });
};
/**
 * Created by Thib on 07/03/2017.
 */
