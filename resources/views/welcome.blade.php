@extends('layouts.app')

@section('content')
    <h1 class="header center orange-text">Учётка<i class="material-icons medium">today</i></h1>
    <div class="row center">
        <h5 class="header col s12 light">Современное решение для учёта расходов по комунальным платежам</h5>
    </div>
    <div class="row center">
        @if (Auth::guest())
            <a href="{{ url('/register') }}" class="btn-large waves-effect waves-light orange">Регистрация</a>
            <a href="{{ url('/login') }}" class="btn-large waves-effect waves-light">Вход</a>
        @endif
    </div>
@endsection

