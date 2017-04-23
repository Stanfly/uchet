@extends('layouts.app')

@section('content')
    <div class="card panel">
        <div class="card-title orange white-text">
            "{{ $house->name }}"
        </div>
        <div class="card-content white">
            <div class="card-top">
                <a class="btn white blue-text" href="{{ url()->previous() }}"><i class="material-icons">arrow_back</i></a>
                <div class="right">
                    <a class="btn white blue-text" href="{{ url()->previous() }}"><i class="material-icons">settings</i></a>
                    <form id="delete-form-{{ $house->id }}" action="{{ route('houses.delete', $house->id) }}" method="POST" style="display: none;">
                        {{ method_field('DELETE') }}
                        {{ csrf_field() }}
                    </form>
                    <a class="btn white blue-text"
                       href="{{ route('houses.delete', $house->id) }}"
                       onclick="
                               event.preventDefault();
                               document.getElementById('delete-form-{{ $house->id }}').submit();
                               ">
                        <i class="material-icons">delete</i>
                    </a>
                </div>
            </div>
            <div class="row">
                <div class="col s12 m6">
                    <ul class="collapsible blanks_collection" data-collapsible="accordion">
                        <li>
                            <div class="collapsible-header">
                                <i class="material-icons circle blue">opacity</i>
                                <span class="title">Холодная вода
                                    {{--<span class="right">Прогноз: {{ $cwbs_prognosis["total_charged"] }}руб.</span>--}}
                                </span>
                            </div>
                            <a class='dropdown-button collapsible-more grey-text'
                               href='#'
                               data-constrainWidth="false"
                               data-activates='coldWater_more'
                               data-alignment="right"
                            ><i class="material-icons ">more_vert</i></a>

                            <!-- Dropdown Structure -->
                            <ul id='coldWater_more' class='dropdown-content'>
                                <li><a href="#createColdWaterBlankModal" class="secondary-content tooltipped right" data-tooltip="Добавить показания">
                                        <i class="material-icons">add</i>Добавить показания
                                </a></li>
                                <li><a href="{{ route('houses.blanks.cwb.index', $house->id)}}" class="right">подробнее</a></li>
                            </ul>
                            <div class="collapsible-body no-padding">
                                <ul class="collapsible" data-collapsible="expandable">
                                    <li class="prognosis_row">
                                        <div class="collapsible-header">
                                                <span class="title">
                                                    <span class="col m4">
                                                        Прогноз
                                                    </span>
                                                    <span class="col m4">
                                                        {{ $cwbs_prognosis['volume_of_services'] or 'Неизвестно' }} м<sup>3</sup>
                                                    </span>
                                                    <span class="col m4 right-align">
                                                        {{ $cwbs_prognosis['total_charged'] or 'Неизвестно' }} руб.
                                                    </span>
                                                </span>
                                        </div>
                                        <div class="collapsible-body">
                                            <p>
                                                <label>Норматив потребления:</label> {{ $cwbs_prognosis['norm'] }} м<sup>3</sup>/чел<br>
                                                <label>Суммарный объём по МКД:</label> {{ $cwbs_prognosis['total_volume_of_MKD'] }} м<sup>3</sup><br>
                                                <label>Тариф с НДС:</label> {{ $cwbs_prognosis['tariff_with_NDS'] }} руб./ед.изм.<br>
                                                <label>Объём услуг в жилом помещении:</label> {{ $cwbs_prognosis['volume_of_services'] }} м<sup>3</sup><br>
                                                <label>Начислено за оказанную услугу:</label> {{ $cwbs_prognosis['charged'] }} руб.<br>
                                                <label>Перерасчёт:</label> {{ $cwbs_prognosis['recalculation'] }} руб.<br>
                                                <label>Итого начислено :</label> {{ $cwbs_prognosis['total_charged'] }} руб.<br>
                                            </p>
                                        </div>
                                    </li>
                                    @forelse($cwbs as $cwb)
                                        <li>
                                            <div class="collapsible-header">
                                                <span class="title">
                                                    <span class="col m4">
                                                        {{ $cwb->date }}
                                                    </span>
                                                    <span class="col m4">
                                                        {{ $cwb->volume_of_services }} м<sup>3</sup>
                                                    </span>
                                                    <span class="col m4 right-align">
                                                        {{ $cwb->total_charged }} руб.
                                                    </span>
                                                </span>
                                            </div>
                                            <div class="collapsible-body">
                                                <p>
                                                    <label>Норматив потребления:</label> {{ $cwb->norm }} м<sup>3</sup>/чел<br>
                                                    <label>Суммарный объём по МКД за {{ $cwb->date }}:</label> {{ $cwb->total_volume_of_MKD }} м<sup>3</sup><br>
                                                    <label>Тариф с НДС:</label> {{ $cwb->tariff_with_NDS }} руб./ед.изм.<br>
                                                    <label>Объём услуг в жилом помещении:</label> {{ $cwb->volume_of_services }} м<sup>3</sup><br>
                                                    <label>Начислено за оказанную услугу за {{ $cwb->date }}:</label> {{ $cwb->charged }} руб.<br>
                                                    <label>Перерасчёт в {{ $cwb->date }}:</label> {{ $cwb->recalculation }} руб.<br>
                                                    <label>Итого начислено за {{ $cwb->date }}:</label> {{ $cwb->total_charged }} руб.<br>
                                                </p>
                                                <a href="{{ route('houses.blanks.cwb.show', [$house->id, $cwb->id]) }}">Подробнее</a>
                                            </div>
                                        </li>
                                    @empty
                                    @endforelse
                                </ul>
                            </div>
                        </li>
                        <li>
                            <div class="collapsible-header">
                                <i class="material-icons circle pink accent-3">opacity</i>
                                <span class="title">Горячая вода</span>
                            </div>

                            <a class='dropdown-button collapsible-more grey-text'
                               href='#'
                               data-constrainWidth="false"
                               data-activates='hotWater_more'
                               data-alignment="right"
                            ><i class="material-icons ">more_vert</i></a>

                            <!-- Dropdown Structure -->
                            <ul id='hotWater_more' class='dropdown-content'>
                                <li><a href="#createHotWaterBlankModal"
                                       class="secondary-content tooltipped right"
                                       data-tooltip="Добавить показания"
                                    >
                                    <i class="material-icons">add</i>Добавить показания
                                </a></li>
                                <li><a href="{{ route('houses.blanks.hwb.index', $house->id)}}" class="right">подробнее</a></li>
                            </ul>
                            <div class="collapsible-body no-padding">
                                <ul class="collapsible" data-collapsible="expandable">
                                    @forelse($hwbs as $hwb)
                                        <li>
                                            <div class="collapsible-header">
                                                <span class="title">{{ $hwb->date }}</span>
                                            </div>
                                            <div class="collapsible-body">
                                                <p>
                                                    <label>Норматив потребления:</label> {{ $hwb->norm }} м<sup>3</sup>/чел<br>
                                                    <label>Суммарный объём по МКД за {{ $hwb->date }}:</label> {{ $hwb->total_volume_of_MKD }} м<sup>3</sup><br>
                                                    <label>Тариф с НДС:</label> {{ $hwb->tariff_with_NDS }} руб./ед.изм.<br>
                                                    <label>Объём услуг в жилом помещении:</label> {{ $hwb->volume_of_services }} м<sup>3</sup><br>
                                                    <label>Начислено за оказанную услугу за {{ $hwb->date }}:</label> {{ $hwb->charged }} руб.<br>
                                                    <label>Перерасчёт в {{ $hwb->date }}:</label> {{ $hwb->recalculation }} руб.<br>
                                                    <label>Итого начислено за {{ $hwb->date }}:</label> {{ $hwb->total_charged }} руб.<br>
                                                </p>
                                            </div>
                                        </li>
                                    @empty
                                    @endforelse
                                </ul>
                            </div>
                        </li>
                        <li>
                            <div class="collapsible-header">
                                <i class="material-icons circle  yellow">lightbulb_outline</i>
                                <span class="title">Электроэнергия</span>
                            </div>
                            <a class='dropdown-button collapsible-more grey-text'
                               href='#'
                               data-constrainWidth="false"
                               data-activates='electricity_more'
                               data-alignment="right"
                            ><i class="material-icons ">more_vert</i></a>

                            <!-- Dropdown Structure -->
                            <ul id='electricity_more' class='dropdown-content'>
                                <li><a href="#createElectricityBlankModal"
                                       class="secondary-content tooltipped right"
                                       data-tooltip="Добавить показания"
                                    >
                                        <i class="material-icons">add</i>Добавить показания
                                    </a></li>
                                <li><a href="{{ route('houses.blanks.hwb.index', $house->id)}}" class="right">подробнее</a></li>
                            </ul>
                            <div class="collapsible-body no-padding">
                                <ul class="collapsible" data-collapsible="expandable">
                                    @forelse($elbs as $elb)
                                        <li>
                                            <div class="collapsible-header">
                                                <span class="title">{{ $elb->date }}</span>
                                            </div>
                                            <div class="collapsible-body">
                                                <p>
                                                    <label>Тариф одноставочный:</label> {{ $elb->tariff_single }} руб./ед.изм.<br>
                                                    <label>Тариф дневная зона:</label> {{ $elb->tariff_day }} руб./ед.изм.<br>
                                                    <label>Тариф ночная зона:</label> {{ $elb->tariff_night }} руб./ед.изм.<br>
                                                    <label>Расход:</label> {{ $elb->consumption }} руб./ед.изм.<br>
                                                    <label>Сумма день:</label> {{ $elb->sum_day }} руб./ед.изм.<br>
                                                    <label>Сумма ночь:</label> {{ $elb->sum_night }} руб./ед.изм.<br>
                                                    <label>Начислено:</label> {{ $elb->charged }} руб.<br>
                                                    <label>Перерасчёт:</label> {{ $elb->recalculation }} руб.<br>
                                                    <label>Итого начислено:</label> {{ $elb->total_charged }} руб.<br>
                                                </p>
                                            </div>
                                        </li>
                                    @empty
                                    @endforelse
                                </ul>
                            </div>
                        </li>

                        {{--
                        <li class="collection-item avatar">
                            <i class="material-icons circle">bubble_chart</i>
                            <span class="title">Газ</span>
                            <p>
                                Последние показания: 12кВт <br>
                                Дата снятия показаний: 23.04.17
                            </p>
                            <a href="#!" class="secondary-content tooltipped" data-tooltip="Добавить показания"><i class="material-icons">add</i></a>
                        </li>
                        --}}
                    </ul>
                </div>

                <div class="col s12 m6">
                    <div class="house-info">
                        <lable>Название: </lable><span class="house_name">{{ $house->name }}</span>
                        <br><lable>Площадь в м<sup>2</sup>: </lable><span class="house_area">{{ $house->area }}</span>
                        <br><lable>Проживает: </lable><span class="house_residents">{{ $house->residents }}</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div id="createElectricityBlankModal" class="modal">
        <form class="form-horizontal" role="form" method="POST" action="{{ route('houses.blanks.elb.create', $house->id) }}">
            <div class="modal-content">
                <h4>Добавление записи по электроэнергии</h4>
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
                        <input id="tariff_single" type="text" name="tariff_single" value="" required autofocus>
                        <label for="tariff_single">Тариф одноставочный</label>
                    </div>
                </div>
                <div class="row">
                    <div class="input-field col s12">
                        <input id="tariff_day" type="text" name="tariff_day" value="" required autofocus>
                        <label for="tariff_day">Тариф дневная зона</label>
                    </div>
                </div>
                <div class="row">
                    <div class="input-field col s12">
                        <input id="tariff_night" type="text" name="tariff_night" value="" required autofocus>
                        <label for="tariff_night">Тариф ночная зона</label>
                    </div>
                </div>
                <div class="row">
                    <div class="input-field col s12">
                        <input id="consumption" type="text" name="consumption" value="" required autofocus>
                        <label for="consumption">Расход</label>
                    </div>
                </div>
                <div class="row">
                    <div class="input-field col s12">
                        <input id="sum_day" type="text" name="sum_day" value="" required autofocus>
                        <label for="sum_day">Сумма день</label>
                    </div>
                </div>
                <div class="row">
                    <div class="input-field col s12">
                        <input id="sum_night" type="text" name="sum_night" value="" required autofocus>
                        <label for="sum_night">Сумма ночь</label>
                    </div>
                </div>

                <div class="row">
                    <div class="input-field col s12">
                        <input id="charged" type="text" name="charged" value="" required autofocus>
                        <label for="charged">Начислено</label>
                    </div>
                </div>
                <div class="row">
                    <div class="input-field col s12">
                        <input id="recalculation" type="text" name="recalculation" value="" required autofocus>
                        <label for="recalculation">Перерасчёт</label>
                    </div>
                </div>
                <div class="row">
                    <div class="input-field col s12">
                        <input id="total_charged" type="text" name="total_charged" value="" required autofocus>
                        <label for="total_charged">Итого начислено</label>
                    </div>
                </div>

            </div>
            <div class="modal-footer">
                <button type="submit" class="waves-effect waves-green btn-flat">Добавить</button>
            </div>
        </form>
    </div>
    <div id="createHotWaterBlankModal" class="modal">
        <form class="form-horizontal" role="form" method="POST" action="{{ route('houses.blanks.hwb.create', $house->id) }}">
            <div class="modal-content">
                <h4>Добавление записи по горячей воде</h4>
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
                        <input id="norm" type="text" name="norm" value="" required autofocus>
                        <label for="norm">Норматив потребления:</label>
                    </div>
                </div>
                <div class="row">
                    <div class="input-field col s12">
                        <input id="total_volume_of_MKD" type="text" name="total_volume_of_MKD" value="" required autofocus>
                        <label for="total_volume_of_MKD">Суммарный объём по МКД за месяц</label>
                    </div>
                </div>
                <div class="row">
                    <div class="input-field col s12">
                        <input id="tariff_with_NDS" type="text" name="tariff_with_NDS" value="" required autofocus>
                        <label for="tariff_with_NDS">Тариф с НДС:</label>
                    </div>
                </div>
                <div class="row">
                    <div class="input-field col s12">
                        <input id="volume_of_services" type="text" name="volume_of_services" value="" required autofocus>
                        <label for="volume_of_services">Объём услуг в жилом помещении:</label>
                    </div>
                </div>
                <div class="row">
                    <div class="input-field col s12">
                        <input id="charged" type="text" name="charged" value="" required autofocus>
                        <label for="charged">Начислено за оказанную услугу за месяц:</label>
                    </div>
                </div>
                <div class="row">
                    <div class="input-field col s12">
                        <input id="recalculation" type="text" name="recalculation" value="" required autofocus>
                        <label for="recalculation">Перерасчёт в месяце</label>
                    </div>
                </div>
                <div class="row">
                    <div class="input-field col s12">
                        <input id="total_charged" type="text" name="total_charged" value="" required autofocus>
                        <label for="total_charged">Итого начислено за месяц</label>
                    </div>
                </div>

            </div>
            <div class="modal-footer">
                <button type="submit" class="waves-effect waves-green btn-flat">Добавить</button>
            </div>
        </form>
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
                        <input id="norm" type="text" name="norm" value="" required autofocus>
                        <label for="norm">Норматив потребления:</label>
                    </div>
                </div>
                <div class="row">
                    <div class="input-field col s12">
                        <input id="total_volume_of_MKD" type="text" name="total_volume_of_MKD" value="" required autofocus>
                        <label for="total_volume_of_MKD">Суммарный объём по МКД за месяц</label>
                    </div>
                </div>
                <div class="row">
                    <div class="input-field col s12">
                        <input id="tariff_with_NDS" type="text" name="tariff_with_NDS" value="" required autofocus>
                        <label for="tariff_with_NDS">Тариф с НДС:</label>
                    </div>
                </div>
                <div class="row">
                    <div class="input-field col s12">
                        <input id="volume_of_services" type="text" name="volume_of_services" value="" required autofocus>
                        <label for="volume_of_services">Объём услуг в жилом помещении:</label>
                    </div>
                </div>
                <div class="row">
                    <div class="input-field col s12">
                        <input id="charged" type="text" name="charged" value="" required autofocus>
                        <label for="charged">Начислено за оказанную услугу за месяц:</label>
                    </div>
                </div>
                <div class="row">
                    <div class="input-field col s12">
                        <input id="recalculation" type="text" name="recalculation" value="" required autofocus>
                        <label for="recalculation">Перерасчёт в месяце</label>
                    </div>
                </div>
                <div class="row">
                    <div class="input-field col s12">
                        <input id="total_charged" type="text" name="total_charged" value="" required autofocus>
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

