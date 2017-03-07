var $ = require('jquery');

module.exports = function () {


    var $headBurger, $headMenu, $body;

    $(document).ready(function () {

        $headBurger = $('.head__barBurger');
        $headMenu = $('.head__menu');
        $body = $('body');

        //EVENTS

        $headBurger.click(toggleMenu);
        $(window).resize(function () {
            if ($(window).width() >= 768) closeMenu();
        });
    });
//MENU
var toggleMenu = function () {
    if (!$headBurger.hasClass('head__barBurger-open')) {
        openMenu();
    } else {
        closeMenu();
    }
};

var openMenu = function () {
    console.log('open', $headBurger);
    $headBurger.addClass('head__barBurger-open');
    $body.addClass('menu-open');
    $headMenu.addClass('head__menu-open');
};

var closeMenu = function () {
    console.log('close');
    $headBurger.removeClass('head__barBurger-open');
    $body.removeClass('menu-open');
    $headMenu.removeClass('head__menu-open');
};
};
