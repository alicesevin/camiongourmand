/**
 * Created by Thib on 06/03/2017.
 */
var ScrollMagic = require('scrollmagic');
var $ = require('jquery');


module.exports = function () {

    $(document).ready(function () {
        scroll()
    });

    function scroll() {
        //Enter all elements here that you want to be scroll and set their offset

        var elementsTab = [
            // {name: '.cover', offset: 0},
            {name: '.section-histoire', offset: 200},
            {name: '.section-trouver', offset: 200}
        ];

        function topPosition(element) {
            return $(element).offset().top;
        }

        //fade your text
        // function fadeText (text) {
        //     text.css('opacity', '1')
        // }

        var controller = new ScrollMagic.Controller();
        for (var i = 0; i <= elementsTab.length - 1; i++) {

            new ScrollMagic.Scene({
                duration: 2000,
                offset: topPosition(elementsTab[i].name) - elementsTab[i].offset
            })

                .setPin(elementsTab[i].name)
                .addTo(controller)
                // .on('start', fadeText($(elementsTab[i].name)))
        }
    }
};
