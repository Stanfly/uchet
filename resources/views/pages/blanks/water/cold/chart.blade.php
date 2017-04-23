@extends('layouts.app')

@section('content')
    <div class="card panel">
        <div class="card-title orange white-text">
        </div>
        <div class="card-content white">
            <div class="card-top">
                <a class="btn white blue-text" href="{{ url()->previous() }}"><i class="material-icons">arrow_back</i></a>
            </div>

            <br>
            @if(isset($cwbs[0]))
                @else
                    <div class="center">
                        <h5 class="header light">Упс... Кажется у вас нет квитанций за холодную воду. Добавьте одну прямо сейчас!</h5>
                        <a class="waves-effect waves-light btn-large orange" href="#createColdWaterBlankModal"><i class="material-icons left">playlist_add</i>Добавить</a>
                    </div>
                @endif
        </div>
    </div>
@endsection


@section('scripts')
    <script>
    @if(isset($cwbs[0]))
    var data= [];
    var dates= [];
    var a = {{ $ab[0] }}
    var b = {{ $ab[0] }}
    var trend = []
        @php
            $i =0;
        @endphp
        @foreach($cwbs as $cwb)
            dates.push("{{ $cwb->date }}");
            data.push(+"{{ $cwb->tariff_with_NDS }}");
            trend.push(a+b*{{$i}});
            @php
                $i++;
            @endphp

        @endforeach

    trend.push(a+b*{{$i}});
    console.log(dates)
                $(function () {
                    $('#container').highcharts({
                        chart: {
                            type: 'line'
                        },
                        title: {
                            text: 'График изменения тарифа'
                        },
                        xAxis: {
                            title: {
                                text: "Дата"
                            },
                            categories: dates
                        },
                        yAxis: {
                            title: {
                                text: "цена, руб."
                            }
                        },
                        series: [
                            {
                                name: "тариф",
                                data: data
                            },
                            {
                                name: "тренд",
                                data: trend
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
    @endif
    </script>
@endsection
