var $ = require('jquery');

module.exports = function () {

    $(document).ready(function () {
        $('.head__barBurger').click(function(){
            if(!$(this).hasClass('head__barBurger-open')){
                $(this).addClass('head__barBurger-open');
                $('.head__menu').addClass('head__menu-open');
            }else{
                $(this).removeClass('head__barBurger-open');
                $('.head__menu').removeClass('head__menu-open');
            }
        });
        initApp();
    });

    function initApp() {
        console.log('hello');
    }
};
