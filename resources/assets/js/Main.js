$(document).ready(function(){
    $.ajaxPrefilter(function (options, originalOptions, jqXHR) {
        jqXHR.setRequestHeader('X-CSRF-Token', window.Laravel.csrfToken);
    });
    $(".dropdown-button").dropdown();
    $(".button-collapse").sideNav();
});
