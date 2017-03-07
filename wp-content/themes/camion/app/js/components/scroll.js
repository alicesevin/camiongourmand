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

        //ALICE
        animCoverTpl();
        timeline();

        //SCROLL
        $(window).scroll(timeline);

    });

    function animations() {

        var $icons = $('.section__bg').find('i');
        var animationLiberty = 0.1;   // j'avais pas de nom de variable

        function iconsParralaxe() {
            TweenMax.to($icons, 0.5, {y: -$('body').scrollTop() * animationLiberty});
        }

        function fadeText(element) {
            for (i = 0; i <= element.length; i++) {
               // console.log(element.offset().top)
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

    //ALICE

    var timeline = function () {

        if (inSection('.section-histoire')) {
            console.log('histoire');
            //HISTOIRE SCROLL INTERACTIONS
        }
        if (inSection('.section-trouver')) {
            console.log('trouver');
            //NOUS TROUVER SCROLL INTERACTIONS
            if(!trouverActive){
                tl.from(".section-trouver .section__detailPart-map", 1, {alpha: 0, x: -30}, .3);
                trouverActive = true;
            }

        }
        if (inSection('.section-menus')) {
            //MENUS SCROLL INTERACTIONS

        }
        if (inSection('.footer')) {
            //FOOTER SCROLL INTERACTIONS

        }

        function inSection(elem) {
            var elemTarget = $(elem);
            if (elemTarget.length) {
                var elemTargetH = elemTarget.outerHeight(),
                    deltaIn = elemTarget.offset().top - $('header').height(),
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
