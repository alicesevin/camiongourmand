var $ = require('jquery');

module.exports = function () {

    var origin, path, hash;

    $(document).ready(function () {

        var location = window.location;

        origin = location.origin;
        path = location.pathname;

        //GENERATE FAKE CONFIG FOR DEV ENV
        if (location.hostname == 'localhost') {
            localEnvConf();
        }
        //EVENTS

        $('.menu-item').click(function (e) {
            e.preventDefault();
            var href = $(this).find('a').attr('href');
            if ($('.current-menu-item').length > 1 && $(this).hasClass('current-menu-item')) {
                var hash = href.split(origin + path)[1];
                smoothScrollTo(hash);
                window.location.hash = hash;
            } else {
                window.location.href = href;
            }
        });
        $('.cover__container-tryptique:nth-child(2)').on('click', function (e) {
            e.preventDefault();
            var $target = $(e.currentTarget).find('.cover__nav');
            smoothScrollTo($target.attr('href'));
        });

        $(window).on('hashchange', verifyHash(window.location.hash));

    });

    var localEnvConf = function () {
        origin = location.origin + '/camion/';
        path = location.pathname.split("/")[2];
        hash = location.hash;
        return true;
    };

    var verifyHash = function (currentHash) {
        console.log('hello');
        var $links = $('.current_page_item');
        if ($links && $links.length > 1) {
            $.each($links, function (i, $link) {
                var href = $($link).find('a').attr('href');
                href = href.split(origin + path)[1];
                if (!currentHash || currentHash != href) {
                    $($link).removeClass('current_page_item');
                } else {
                    $($link).addClass('current_page_item');
                    smoothScrollTo(currentHash);
                }
            });
        }
    };

    var smoothScrollTo = function (x) {
        var $x = $(x);
        if ($x.length) {
            $('body').animate({
                scrollTop: $x.offset().top
            });
        }
    };
};
