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
                    <ul class="collection collapsible" data-collapsible="expandable">
                        <li class="collection-item avatar">
                            <i class="material-icons circle blue">opacity</i>
                            <span class="title">Вода</span>
                            <p>
                                Горящая вода: 4.1 м<sup>3</sup><br>
                                Холодная вода: 5.02 м<sup>3</sup><br>
                                Водоотведение: 9.12 м<sup>3</sup><br>
                                Дата снятия показаний: 22.04.17
                            </p>
                            <a href="#!" class="secondary-content tooltipped" data-tooltip="Добавить показания"><i class="material-icons">add</i></a>
                        </li>
                        <li class="collection-item avatar">
                            <i class="material-icons circle yellow">lightbulb_outline</i>
                            <span class="title">Электричество</span>
                            <p>
                                Последние показания: 12кВт <br>
                                Дата снятия показаний: 23.04.17
                            </p>
                            <a href="#!" class="secondary-content tooltipped" data-tooltip="Добавить показания"><i class="material-icons">add</i></a>
                        </li>
                        <li class="collection-item avatar">
                            <i class="material-icons circle orange">whatshot</i>
                            <span class="title">Отопление</span>
                            <p>
                                Последние показания: 12кВт <br>
                                Дата снятия показаний: 23.04.17
                            </p>
                            <a href="#!" class="secondary-content tooltipped" data-tooltip="Добавить показания"><i class="material-icons">add</i></a>
                        </li>
                        <li class="collection-item avatar">
                            <i class="material-icons circle">bubble_chart</i>
                            <span class="title">Газ</span>
                            <p>
                                Последние показания: 12кВт <br>
                                Дата снятия показаний: 23.04.17
                            </p>
                            <a href="#!" class="secondary-content tooltipped" data-tooltip="Добавить показания"><i class="material-icons">add</i></a>
                        </li>
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
@endsection

