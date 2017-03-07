/**
 * Created by Thib on 06/03/2017.
 */
var $ = require('jquery');
require("gsap");

//section__bgIcon icon-champi
module.exports = function () {

    //VARIABLES
    var tl = new TimelineLite(),
        trouverActive = false,
        coverActive = false;

    $(document).ready(function () {

        //READY
        animations();
        smoothScroll();

        //ALICE
        animCoverTpl();
        timeline();
        activeNav();

        //SCROLL
        $(window).scroll(timeline());

    });

    function animations() {

        var $icons = $('.section__bg').find('i');
        var animationLiberty = 0.1;   // j'avais pas de nom de variable

        function iconsParralaxe() {
            TweenMax.to($icons, 0.5, {y: -$('body').scrollTop() * animationLiberty});
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

    //ALICE

    var activeNav = function () {
        if ($(window).scrollTop() > 60) {
            tl.from('.head', 1, {y: -200, ease: Power4.easeOut}, '-=1');
        }
    };

    var timeline = function () {

        if (inSection('.section-histoire')) {
            //HISTOIRE SCROLL INTERACTIONS

        } else if (inSection('.section-trouver') && !trouverActive) {
            //NOUS TROUVER SCROLL INTERACTIONS
            trouverActive = true;
            tl.staggerFrom(".section-trouver .section__detailPart", 1, {alpha: 0, x: -30}, .3);

        } else if (inSection('.section-menus')) {
            //MENUS SCROLL INTERACTIONS

        } else if (inSection('.footer')) {
            //FOOTER SCROLL INTERACTIONS

        }

        function inSection(elem) {
            var elemTarget = $(elem);
            if (elemTarget.length) {
                var elemTargetH = elemTarget.outerHeight(),
                    deltaIn = elemTarget.offset().top,
                    deltaOut = deltaIn + elemTargetH;

                if ($(window).scrollTop() > deltaIn && $(window).scrollTop() < deltaOut) {
                    return true;
                }

            }
            return false;
        }
    };
    var animCoverTpl = function () {
        coverActive = true;
        tl.staggerFromTo(".cover img", 1,
            {alpha: 0},
            {alpha: 1, ease: Power4.easeOut, clearProps: 'all'}, .3)
            .staggerFromTo(".cover__title", .6,
                {alpha: 0, y: -30},
                {alpha: 1, y: 0, ease: Power4.easeOut, clearProps: 'all'}, .6, "-=1.3")
            .from(".cover__navIcon.icon__arrow-left", 1, {alpha: 0, x: 30, ease: Power4.easeOut}, "-=0.6")
            .from(".cover__navIcon.icon__arrow-right", 1, {alpha: 0, x: -30, ease: Power4.easeOut}, "-=1.2")
            .from(".cover__navIcon.icon__arrow-bottom", 1, {alpha: 0, y: -30}, "-=1.2");


    }
};
