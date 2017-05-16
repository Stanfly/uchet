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


function view_chart(data) {
    $.ajax({
        url: "/ajax/chart",
        method: "GET",
        data: {
            data: JSON.stringify(data)
        },
        success: function(response) {
            $("body").append(response);
        }
    })
}

function get_trend_ab(data_y, trend_points){
    if (data_y.length > trend_points-1) {
        data_y = data_y.slice(-trend_points);
        console.log(data_y);
        let x_sum = 0, y_sum = 0, xy_sum = 0, xx_sum = 0;
        for (let x = 0; x < trend_points; x++) {
            x_sum += x;
            y_sum += +data_y[x];
            xy_sum += x*data_y[x];
            xx_sum += x*x;
        }
        let x_aver = x_sum/trend_points;
        let y_aver = y_sum/trend_points;
        let x_aver_2 = x_aver*x_aver;
        let b = (xy_sum - trend_points*x_aver*y_aver)/(xx_sum-trend_points*x_aver_2);
        let a = y_aver-b*x_aver;
        return [a,b];
    } else {
        return false;
    }
}

function prognosis(data_y, trend_points){
    let ab = get_trend_ab(data_y, trend_points);
    let prognosis = ab[0]+ab[1]*(trend_points);
    prognosis = prognosis>=0? prognosis : 0;
    return prognosis;
}


function define_if_undef(variable, value) {
    if (variable === undefined) {
        variable = value;
    }
    return variable;
}

// Замыкание
(function() {
    /**
     * Корректировка округления десятичных дробей.
     *
     * @param {String}  type  Тип корректировки.
     * @param {Number}  value Число.
     * @param {Integer} exp   Показатель степени (десятичный логарифм основания корректировки).
     * @returns {Number} Скорректированное значение.
     */
    function decimalAdjust(type, value, exp) {
        // Если степень не определена, либо равна нулю...
        if (typeof exp === 'undefined' || +exp === 0) {
            return Math[type](value);
        }
        value = +value;
        exp = +exp;
        // Если значение не является числом, либо степень не является целым числом...
        if (isNaN(value) || !(typeof exp === 'number' && exp % 1 === 0)) {
            return NaN;
        }
        // Сдвиг разрядов
        value = value.toString().split('e');
        value = Math[type](+(value[0] + 'e' + (value[1] ? (+value[1] - exp) : -exp)));
        // Обратный сдвиг
        value = value.toString().split('e');
        return +(value[0] + 'e' + (value[1] ? (+value[1] + exp) : exp));
    }

    // Десятичное округление к ближайшему
    if (!Math.round10) {
        Math.round10 = function(value, exp) {
            return decimalAdjust('round', value, exp);
        };
    }
    // Десятичное округление вниз
    if (!Math.floor10) {
        Math.floor10 = function(value, exp) {
            return decimalAdjust('floor', value, exp);
        };
    }
    // Десятичное округление вверх
    if (!Math.ceil10) {
        Math.ceil10 = function(value, exp) {
            return decimalAdjust('ceil', value, exp);
        };
    }
})();