@extends('layouts.app')

@section('content')
    <div class="card panel">
        <div class="card-title orange white-text">
            {{ $cwb->date }} Квитанция по холодной воде.
        </div>
        <div class="card-content white">
            <div class="card-top">
                <a class="btn white blue-text" href="{{ url()->previous() }}"><i class="material-icons">arrow_back</i></a>
                <a class="waves-effect waves-light btn right" href="#modal1"><i class="material-icons left">playlist_add</i>Добавить</a>
            </div>
            <p>
                <label>Норматив потребления:</label> {{ $cwb->norm }} м<sup>3</sup>/чел<br>
                <label>Суммарный объём по МКД за {{ $cwb->date }}:</label> {{ $cwb->total_volume_of_MKD }} м<sup>3</sup><br>
                <label>Тариф с НДС:</label> {{ $cwb->tariff_with_NDS }} руб./ед.изм.<br>
                <label>Объём услуг в жилом помещении:</label> {{ $cwb->volume_of_services }} м<sup>3</sup><br>
                <label>Начислено за оказанную услугу за {{ $cwb->date }}:</label> {{ $cwb->charged }} руб.<br>
                <label>Перерасчёт в {{ $cwb->date }}:</label> {{ $cwb->recalculation }} руб.<br>
                <label>Итого начислено за {{ $cwb->date }}:</label> {{ $cwb->total_charged }} руб.<br>
            </p>
        </div>
    </div>
@endsection

