$(function () {

    var Main = {

        run: function () {
            $.ajaxPrefilter(function (options, originalOptions, jqXHR) {
                jqXHR.setRequestHeader('X-CSRF-Token', window.Laravel.csrfToken);
            });
            $(".dropdown-button").dropdown();
            $(".button-collapse").sideNav();
            $('.parallax').parallax();
            $('.modal').modal();
            this.footerMove();
        },
        resizeFunctions: function () {
            this.footerMove();
        },
        scrollFunctions: function () {

        },
        footerMove: function () {
            var ua = navigator.userAgent.toLowerCase();
            var isOpera = (ua.indexOf('opera') > -1);
            var isIE = (!isOpera && ua.indexOf('msie') > -1);
            var viewportHeight = getViewportHeight();
            var wrapper = $("main");
            var footer = $("footer");
            var noWrapper = footer.outerHeight(true) + $("nav").outerHeight(true);

            function getViewportHeight() {
                return ((document.compatMode || isIE) && !isOpera)
                    ? (document.compatMode == 'CSS1Compat') ? document.documentElement.clientHeight : document.body.clientHeight : (document.parentWindow || document.defaultView).innerHeight;
            }

            wrapper.css("min-height", viewportHeight - noWrapper);
        },
    };
    window.Application.addComponent("Main", Main);
});



