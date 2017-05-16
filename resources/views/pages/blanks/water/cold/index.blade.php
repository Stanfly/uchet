@extends('layouts.app')

@section("scripts")
    <script>
        function make_chart(el) {
            let num = $("#charts_links>td>a").index(el);
            let data = {
                "x_label": "мес",
                "x_title": "Даты",
                "y_label": $("#review_table thead th:nth-child("+(num+2)+") label").html(),
                "y_title": $("#review_table thead th:nth-child("+(num+2)+") span").html(),
                "data": {
                    "x": [],
                    "y": []
                },
            };
            $($("#review_table tbody tr:not(.prognosis_row)").get().reverse()).each(function(i, row){
                data['data']["x"][i] = $(row).find("td:first-child").text();
                data['data']["y"][i] = +$(row).find("td:nth-child("+(num+2)+")").text();
            });
            view_chart(data);
        }

    </script>
@endsection

@section('content')
    <div class="card panel">
        <div class="card-title orange white-text">
            Квитанции по холодной воде
        </div>
        <div class="card-content white">
            <div class="card-top">
                <a class="btn white blue-text" href="{{ url()->previous() }}"><i class="material-icons">arrow_back</i></a>
                <a class="waves-effect waves-light btn right" href="#modal1"><i class="material-icons left">playlist_add</i>Добавить</a>
            </div>

            @if(isset($cwbs[0]))
                <br>
                <table id="review_table" class="striped review_table">
                    <thead>
                    <tr>
                        <th><span>Месяц</span></th>
                        <th><span>Норматив потребления</span> <label>м<sup>3</sup>/чел</label></th>
                        <th><span>Суммарный объём по МКД</span> <label>м<sup>3</sup></label></th>
                        <th><span>Тариф с НДС</span> <label>руб./ед.изм.</label></th>
                        <th><span>Объём услуг в жилом помещении</span> <label>м<sup>3</sup></label></th>
                        <th><span>Начислено</span> <label>руб.</label></th>
                        <th><span>Перерасчёт</span> <label>руб.</label></th>
                        <th><span>Итого начислено</span> <label>руб.</label></th>
                        <th>Действие</th>
                    </tr>
                    <tr id="charts_links">
                        <td></td>
                        <td><a href="#!" onclick="make_chart(this)" class="center tooltipped" data-tooltip="Построить график"><i class="material-icons left">show_chart</i></a></td>
                        <td><a href="#!" onclick="make_chart(this)" class="center tooltipped" data-tooltip="Построить график"><i class="material-icons left">show_chart</i></a></td>
                        <td><a href="#!" onclick="make_chart(this)" class="center tooltipped" data-tooltip="Построить график"><i class="material-icons left">show_chart</i></a></td>
                        <td><a href="#!" onclick="make_chart(this)" class="center tooltipped" data-tooltip="Построить график"><i class="material-icons left">show_chart</i></a></td>
                        <td><a href="#!" onclick="make_chart(this)" class="center tooltipped" data-tooltip="Построить график"><i class="material-icons left">show_chart</i></a></td>
                        <td><a href="#!" onclick="make_chart(this)" class="center tooltipped" data-tooltip="Построить график"><i class="material-icons left">show_chart</i></a></td>
                        <td><a href="#!" onclick="make_chart(this)" class="center tooltipped" data-tooltip="Построить график"><i class="material-icons left">show_chart</i></a></td>
                        <td></td>
                    </tr>
                    </thead>
                    <tbody>
                    <tr class="prognosis_row">
                        <td>Прогноз</td>
                        <td>{{ $prognosis['norm'] }}</td>
                        <td>{{ $prognosis['total_volume_of_MKD'] }}</td>
                        <td>{{ $prognosis['tariff_with_NDS'] }}</td>
                        <td>{{ $prognosis['volume_of_services'] }}</td>
                        <td>{{ $prognosis['charged'] }}</td>
                        <td>{{ $prognosis['recalculation'] }}</td>
                        <td>{{ $prognosis['total_charged'] }}</td>
                        <td>
                        </td>
                    </tr>
                    @forelse($cwbs as $cwb)
                        <tr>
                            <td>{{ $cwb->date }}</td>
                            <td>{{ $cwb->norm }}</td>
                            <td>{{ $cwb->total_volume_of_MKD }}</td>
                            <td>{{ $cwb->tariff_with_NDS }}</td>
                            <td>{{ $cwb->volume_of_services }}</td>
                            <td>{{ $cwb->charged }}</td>
                            <td>{{ $cwb->recalculation }}</td>
                            <td>{{ $cwb->total_charged }}</td>
                            <td>
                                <a class='dropdown-button grey-text'
                                   href='#'
                                   data-constrainWidth="false"
                                   data-activates='more{{ $cwb->id }}'
                                   data-alignment="right"
                                ><i class="material-icons ">more_vert</i></a>

                                <!-- Dropdown Structure -->
                                <ul id='more{{ $cwb->id }}' class='dropdown-content'>
                                    <li>
                                    </li>
                                    <li><a href="{{ route('houses.blanks.cwb.show', [$house->id, $cwb->id]) }}" class="right">подробнее</a></li>
                                </ul>
                            </td>
                        </tr>
                    @empty
                    @endforelse
                    </tbody>
                </table>
        </div>
        @else
            <div class="center">
                <h5 class="header light">Упс... Кажется у вас нет квитанций за холодную воду. Добавьте одну прямо сейчас!</h5>
                <a class="waves-effect waves-light btn-large orange" href="#createColdWaterBlankModal"><i class="material-icons left">playlist_add</i>Добавить</a>
            </div>
        @endif
    </div>
    </div>


    <div id="createColdWaterBlankModal" class="modal">
        <form class="form-horizontal" role="form" method="POST" action="{{ route('houses.blanks.cwb.create', $house->id) }}">
            <div class="modal-content">
                <h4>Добавление записи по холодной воде</h4>
                {{ method_field('PUT') }}
                {{ csrf_field() }}

                <div class="row">
                    <div class="input-field col s12">
                        <input id="date" type="text" name="date" value="" required autofocus>
                        <label for="date">Дата</label>
                    </div>
                </div>
                <div class="row">
                    <div class="input-field col s12">
                        <input id="norm" type="number" name="norm" value="" required autofocus>
                        <label for="norm">Норматив потребления:</label>
                    </div>
                </div>
                <div class="row">
                    <div class="input-field col s12">
                        <input id="total_volume_of_MKD" type="number" name="total_volume_of_MKD" value="" required autofocus>
                        <label for="total_volume_of_MKD">Суммарный объём по МКД за месяц</label>
                    </div>
                </div>
                <div class="row">
                    <div class="input-field col s12">
                        <input id="tariff_with_NDS" type="number" name="tariff_with_NDS" value="" required autofocus>
                        <label for="tariff_with_NDS">Тариф с НДС:</label>
                    </div>
                </div>
                <div class="row">
                    <div class="input-field col s12">
                        <input id="volume_of_services" type="number" name="volume_of_services" value="" required autofocus>
                        <label for="volume_of_services">Объём услуг в жилом помещении:</label>
                    </div>
                </div>
                <div class="row">
                    <div class="input-field col s12">
                        <input id="charged" type="number" name="charged" value="" required autofocus>
                        <label for="charged">Начислено за оказанную услугу за месяц:</label>
                    </div>
                </div>
                <div class="row">
                    <div class="input-field col s12">
                        <input id="recalculation" type="number" name="recalculation" value="" required autofocus>
                        <label for="recalculation">Перерасчёт в месяце</label>
                    </div>
                </div>
                <div class="row">
                    <div class="input-field col s12">
                        <input id="total_charged" type="number" name="total_charged" value="" required autofocus>
                        <label for="total_charged">Итого начислено за месяц</label>
                    </div>
                </div>

            </div>
            <div class="modal-footer">
                <button type="submit" class="waves-effect waves-green btn-flat">Добавить</button>
            </div>
        </form>
    </div>
@endsection
