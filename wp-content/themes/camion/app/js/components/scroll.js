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

        //ALICE
        animCoverTpl();
        timeline();

        //SCROLL
        $(window).scroll(timeline);

    });

    function animations() {

        var $icons = $('.section__bg').find('i'),
            animationLiberty = 0.1,   // j'avais pas de nom de variable
            animationsRandom = [];

        //pour que la position y soit différente entre chaques élément
        for (i = 0; i <= $icons.length; i++) {
            animationsRandom.push(Math.random() * (1 + i * 0.3))
        }

        //parralaxe des icons
        function iconsParralaxe() {
            for (i = 0; i <= $icons.length - 1; i++) {
                TweenMax.to($icons[i], animationsRandom[i], {bottom: -($('body').scrollTop()) * animationLiberty})
            }
            return false;
        }

        $(window).on('scroll', function () {
            iconsParralaxe();
        });
    }

    //ALICE

    var timeline = function () {

        if (inSection('.section-histoire', 350)) {
            console.log('histoire')
            tl.to(('.section__description'), 0.3, {alpha: 1, ease: Power4.easeOut})

        } else if (inSection('.section-trouver') && !trouverActive) {

        }
        if (inSection('.section-trouver', 100)) {
            console.log('trouver');
            //NOUS TROUVER SCROLL INTERACTIONS
            tl.to($('.section__detail'), 0, {alpha: 1, ease: Power4.easeOut}, 0);
            if (!trouverActive) {
                tl.from(".section-trouver .section__detailPart-map", 1, {alpha: 1, x: -30}, 0);
                trouverActive = true;
            }

        }
        if (inSection('.section-menus')) {
            //MENUS SCROLL INTERACTIONS

        }
        if (inSection('.footer')) {
            //FOOTER SCROLL INTERACTIONS

        }

        function inSection(elem, delay) {
            var elemTarget = $(elem);
            if (elemTarget.length) {
                var elemTargetH = elemTarget.outerHeight(),
                    deltaIn = elemTarget.offset().top - $('header').height() - delay,
                    deltaOut = deltaIn + elemTargetH - $('header').height();

                if ($(window).scrollTop() > deltaIn && $(window).scrollTop() < deltaOut) {
                    return true;
                }

            }
            return false;
        }
    };
    var animCoverTpl = function () {
        coverActive = true;
        if ($(window).scrollTop() > 60) {
            tl.from('.head', 1, {y: -200, ease: Power4.easeOut}, '-=1');
        }
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
