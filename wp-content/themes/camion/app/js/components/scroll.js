var $ = require('jquery');
require("gsap");


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
/**
 * Created by Thib on 07/03/2017.
 */
