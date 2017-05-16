<div id="chart-wrapper">
    <script>
        var chart_data = JSON.parse(`{!! $request->data !!}`);
        {{--console.log(JSON.parse(`{!! $trend_ab !!}`));--}}
    </script>
    <div id="chart" class="modal ">
        <div class="modal-content">
            <h4>Графики по данным квитанций по холодной воде</h4>
            <div id="chart_container" style="height: 400px; min-width: 310px"></div>
        </div>
        <div class="modal-footer">

        </div>
    </div>
</div>
<script>
    var CHART = $('#chart');
    var TREND_POINTS = 3;

    CHART.modal({
        complete: function() { $("#chart-wrapper").detach() }
    });
    CHART.modal('open');

    var trend_ab = get_trend_ab(chart_data['data']["y"], TREND_POINTS);
    console.log(trend_ab);
    var trend = [];
    for (let i = 0; i < TREND_POINTS; i++) {
        trend[i] = Math.round10((trend_ab[0]+trend_ab[1]*i),-2);
    }
    trend[trend.length] = Math.round10(trend_ab[0]+trend_ab[1]*trend.length,-2);
    console.dir(prognosis(chart_data['data']["y"],TREND_POINTS));

    trend = new Array(chart_data['data']["y"].length - TREND_POINTS).fill(null).concat(trend);
    $(function () {
        $('#chart_container').highcharts({
            chart: {
                type: 'line'
            },
            title: {
                text: chart_data['y_title'],
                useHTML: true
            },
            xAxis: {
                title: {
                    text: chart_data['x_title'],
                    useHTML: true
                },
                categories: chart_data['data']["x"]
            },
            yAxis: {
                title: {
                    text: chart_data['y_label'],
                    useHTML: true
                }
            },
            series: [
                {
                    name: chart_data['y_title'],
                    data: chart_data['data']["y"],
                },
                {
                    name: "линия тренда",
                    data: trend,
                    visible: false
                }
            ],
            plotOptions: {
                line: {
                    dataLabels: {
                        enabled: true
                    }
                }
            },
        });
    });
</script>
