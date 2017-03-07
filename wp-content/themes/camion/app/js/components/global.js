var $ = require('jquery');

module.exports = function () {

    var origin, path, hash;

    $(document).ready(function () {

        var location = window.location;

        origin = location.origin;
        path = location.pathname;

        if(window.location.hash) {
            setTimeout(function () {
                smoothScrollTo(window.location.hash);
            }, 0);
        }
        //GENERATE FAKE CONFIG FOR DEV ENV
        if (location.hostname == 'localhost') {
            localEnvConf();
        }
        //EVENTS

        $('.menu-item').on('click', function (e) {
            e.preventDefault();
            var href = $(this).find('a').attr('href');
            if (href) {
                if ($('.current-menu-item').length > 1 && $(this).hasClass('current-menu-item')) {
                    var hash = href.split(origin + path);
                    if (hash)
                        smoothScrollTo(hash[1]);
                } else {
                    window.location.href = href;
                }
            }
        });
        $('.cover__container-tryptique:nth-child(2)').on('click', function (e) {
            e.preventDefault();
            var hash = $(this).find('.cover__nav').attr('href');
            smoothScrollTo(hash);
        });

    });

    var localEnvConf = function () {
        origin = location.origin + '/camion/';
        path = location.pathname.split("/")[2];
        hash = location.hash;
        return true;
    };

    var smoothScrollTo = function (x) {
        var $x = $(x),
            links = $('.current-menu-item');
        if ($x.length > 0 && links.length > 1) {
            links.removeClass('current_page_item');
            $.each(links, function (i, v) {
                var isActive = $(v).find('a').attr('href') == origin + x;
                if (isActive) {
                    $(v).addClass('current_page_item');
                }
            });
            $('html,body').animate({
                scrollTop: $x.offset().top
            }, 300, function () {
                if (window.location.hash != x)
                    window.location.hash = x;
            });
            console.log($x.offset().top, $('html,body').scrollTop());
        }
    };
};
