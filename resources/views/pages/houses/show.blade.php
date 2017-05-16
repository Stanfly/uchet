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
                        @php
                        $index = 0;
                        @endphp
                        @forelse($services as $service)
                        <li>
                            <div class="collapsible-header">
                                <i class="material-icons circle {{ $service->icon_class }}">{{ $service->icon_name }}</i>
                                <span class="title">{{ $service->name }}
                                    {{--<span class="right">Прогноз: {{ $cwbs_prognosis["total_charged"] }}руб.</span>--}}
                                </span>
                            </div>
                            <a class='dropdown-button collapsible-more grey-text'
                               href='#'
                               data-constrainWidth="false"
                               data-activates='service{{ $service->id }}_more'
                               data-alignment="right"
                            ><i class="material-icons ">more_vert</i></a>

                            <!-- Dropdown Structure -->
                            <ul id='service{{ $service->id }}_more' class='dropdown-content'>
                                <li><a href="#service{{ $service->id }}Modal" class="secondary-content tooltipped right" data-tooltip="Добавить показания">
                                        <i class="material-icons">add</i>Добавить показания
                                </a></li>
                                <li><a href="{{ route('houses.blanks.index', $house->id)}}" class="right">подробнее</a></li>
                            </ul>
                            <div class="collapsible-body no-padding">
                                <ul class="collapsible" data-collapsible="expandable">
                                    <li class="prognosis_row">
                                        <div class="collapsible-header">
                                                <span class="title">
                                                    Прогноз <span class="pull-right">{{ $service->prognosis['volume']*$service->prognosis['tariff'] }} руб.</span>
                                                </span>
                                        </div>
                                        <div class="collapsible-body">
                                            <p>
                                                <label>Объём услуг за следующий месяц:</label> {{ $service->prognosis['volume'] }} м<sup>3</sup><br>
                                                <label>Тариф:</label> {{ $service->prognosis['tariff'] }} руб./ед.изм.<br>
                                                <label>Будет начислено :</label> {{ $service->prognosis['volume']*$service->prognosis['tariff'] }} руб.<br>
                                            </p>
                                        </div>
                                    </li>
                                    @forelse($service['blanks'] as $blank)
                                    <li>
                                        <div class="collapsible-header">
                                            <span class="title">
                                                   {{ $blank->date }} <span class="pull-right">{{ $blank->volume*$blank->tariff }} руб.</span>
                                            </span>
                                        </div>
                                        <div class="collapsible-body">
                                            <p>
                                                <label>Объём услуг за {{ $blank->date }}:</label> {{ $blank->volume }} м<sup>3</sup><br>
                                                <label>Тариф:</label> {{ $blank->tariff }} руб./ед.изм.<br>
                                                <label>Начислено за {{ $blank->date }}:</label> {{ $blank->volume*$blank->tariff }} руб.<br>
                                            </p>
                                            <a href="{{ route('houses.blanks.show', [$house->id, $blank->id]) }}">Подробнее</a>
                                        </div>
                                    </li>
                                    @empty
                                    @endforelse
                                </ul>
                            </div>
                        </li>
                            @php
                                $index++;
                            @endphp
                        @empty
                        @endforelse
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
        <form class="form-horizontal" role="form" method="POST" action="{{ route('houses.blanks.create', $house->id) }}">
            <div class="modal-content">
                <h4>Добавление записи</h4>
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
                        <input id="value" type="text" name="value" value="" required autofocus>
                        <label for="value">Объём услуг</label>
                    </div>
                </div>
                <div class="row">
                    <div class="input-field col s12">
                        <input id="tariff" type="text" name="tariff" value="" required autofocus>
                        <label for="tariff">Тариф</label>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="submit" class="waves-effect waves-green btn-flat">Добавить</button>
            </div>
        </form>
    </div>
@endsection

