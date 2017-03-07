/**
 * Created by Thib on 06/03/2017.
 */
var $ = require('jquery');
var TweenMax = require('gsap');

//section__bgIcon icon-champi
module.exports = function () {

    function animations() {

        var $icons = $('.section__bg').find('i');
        var animationLiberty = 0.1;   // j'avais pas de nom de variable

        function iconsParralaxe() {
            TweenMax.to($icons, 0.5, {y: - $('body').scrollTop() * animationLiberty});
        }

        function fadeText(element) {
            for (i = 0; i <= element.length; i++) {
                console.log(element.offset().top)
                if (element.offset().top === $(window).scrollTop()) {
                    console.log('done')
                }
            }
        }

        $(window).on('scroll', function () {
            iconsParralaxe();
            fadeText($('.section__bg'));
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
