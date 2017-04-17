window.Application = {
    Components: {},
    /**
     * Front controller application, init all plugin
     * and event handler
     */
    addComponent: function (name, object) {
        this.Components[name] = object;
        object.run();
        if (object.resizeFunctions != null && typeof(object.resizeFunctions) == "function") {
            $(window).on("resize", function () {
                object.resizeFunctions();
            });
        }
        if (object.scrollFunctions != null && typeof(object.scrollFunctions) == "function") {
            $(window).on("scroll", function () {
                object.scrollFunctions();
            });
        }
    }
};
$(document).ready(function(){
    $(".mainLoader").removeClass("mainLoader");
});