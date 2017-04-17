@extends('layouts.app')

@section('content')
    <div class="card panel">
        <div class="card-title orange white-text">
            Ваши жилые помещения
        </div>
        <div class="card-content white">
            @if(isset($houses[0]))
                <div class="row">
                    <a class="waves-effect waves-light btn right" href="#modal1"><i class="material-icons left">playlist_add</i>Добавить</a>
                </div>
                <div class="row">
                    @forelse($houses as $house)
                        <div class="col s12 m6">
                            <div class="card">
                                <div class="card-content">
                                    <span class="card-title">{{ $house->name }}</span>
                                    <br><lable>Площадь в м<sup>2</sup>: </lable><span class="house_area">{{ $house->area }}</span>
                                    <br><lable>Проживает: </lable><span class="house_residents">{{ $house->residents }}</span>
                                </div>
                                <div class="card-action">
                                    <a href="{{ route('houses.show', $house->id) }}">Просмотр</a>
                                    <div class="right">
                                        <a href="{{ route('houses.delete', $house->id) }}">
                                            <i class="material-icons">settings</i>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @empty
                    @endforelse
                </div>
            @else
                <div class="center">
                    <h5 class="header light">Упс... Кажется у вас нет помещений. Добавьте одно прямо сейчас!</h5>
                    <a class="waves-effect waves-light btn-large orange" href="#modal1"><i class="material-icons left">playlist_add</i>Добавить</a>
                </div>
            @endif
        </div>
    </div>


    <div id="modal1" class="modal">
        <form class="form-horizontal" role="form" method="POST" action="{{ url('/houses') }}">
            <div class="modal-content">
                <h4>Добавление жилого помещения</h4>
                    {{ method_field('PUT') }}
                    {{ csrf_field() }}

                    <div class="row">
                        <div class="input-field col s12">
                            <input id="house_name" type="text" name="house_name" value="" required autofocus>
                            <label for="house_name">Название</label>
                        </div>
                    </div>
                    <div class="row">
                        <div class="input-field col s12">
                            <input id="house_area" type="text" name="house_area" value="" required autofocus>
                            <label for="house_area">Площать в м<sup>2</sup></label>
                        </div>
                    </div>
                    <div class="row">
                        <div class="input-field col s12">
                            <input id="house_residents" type="number" name="house_residents" value="" required autofocus>
                            <label for="house_residents">Количество проживающих человек</label>
                        </div>
                    </div>

            </div>
            <div class="modal-footer">
                <button class="modal-action modal-close waves-effect waves-green btn-flat">Создать</button>
            </div>
        </form>
    </div>
@endsection

