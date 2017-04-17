@extends('layouts.app')

@section('head')
    <div class="banner">
        <div class="banner-img">
            <div class="parallax-container">
                <div class="parallax"><img src="images/welcome/mainbg.jpg"></div>
            </div>
        </div>
        <div class="banner-content">
            <div class="section no-pad-bot" id="index-banner">
                <div class="container">
                    <br><br>
                    <h1 class="header center white-text">Учётка<i class="material-icons medium yellow-text">today</i></h1>
                    <div class="row center">
                        <h5 class="header col s12 light white-text">Современное решение для учета расходов по комунальным платежам</h5>
                    </div>
                    <div class="row center">
                        @if (Auth::guest())
                            <a href="{{ url('/register') }}" class="btn-large waves-effect waves-light orange">Регистрация</a>
                            <a href="{{ url('/login') }}" class="btn-large waves-effect waves-light">Вход</a>
                        @else
                            <a href="{{ route('houses.index') }}" class="btn-large waves-effect waves-light orange">Личный кабинет</a>
                        @endif
                    </div>
                    <br><br>
                </div>
            </div>
        </div>
    </div>

@endsection

@section('content')
    <div class="row">
        <div class="col s12 m4">
            <div class="icon-block">
                <h2 class="center light-blue-text"><i class="material-icons">flash_on</i></h2>
                <h5 class="center">Контроль</h5>

                <p class="light">
                    Держите все свои квитанции за жилье в одном месте. Наш сервис поможет вам контролировать расходы по коммунальным платежам. Теперь можно легко следить за своим домом и кошельком.
                </p>
            </div>
        </div>

        <div class="col s12 m4">
            <div class="icon-block">
                <h2 class="center light-blue-text"><i class="material-icons">group</i></h2>
                <h5 class="center">Развитие</h5>

                <p class="light">
                    Наш сервис не стоит на месте. Мы постоянно развиваемся, добавляя новые возможности. Основная задача этого сайта – предоставить удобный сервис для расчета и хранения коммунальных платежей.  Вся наша работа строится исходя из потребностей пользователей, поэтому каждый отзыв важен для нас.
                </p>
            </div>
        </div>

        <div class="col s12 m4">
            <div class="icon-block">
                <h2 class="center light-blue-text"><i class="material-icons">settings</i></h2>
                <h5 class="center">Простота</h5>

                <p class="light">
                    Наш сервис предлагает удобный инструмент хранения квитанций, в котором разберётся даже ребёнок. А это значит, что больше никаких бумажных складов в шкафу! Теперь все квитанции за жилье в одном месте.
                </p>
            </div>
        </div>
    </div>
@endsection
