@extends('layouts.app')

@section('content')
    <div class="row">
        <div class="col s12 m10 offset-m1 l8 offset-l2">
            <div class="card ">
                <div class="card-content">
                    <h3>Вход</h3>
                    <form class="form-horizontal" role="form" method="POST" action="{{ url('/login') }}">
                        {{ csrf_field() }}

                        <div class="row{{ $errors->has('email') ? ' has-error' : '' }}">
                            <div class="input-field col s12">
                                <input id="email" type="email" name="email" value="{{ old('email') }}" required autofocus>
                                <label for="email">E-Mail адрес</label>
                            </div>

                            @if ($errors->has('email'))
                                <span class="help-block">
                                <strong>{{ $errors->first('email') }}</strong>
                            </span>
                            @endif
                        </div>

                        <div class="row{{ $errors->has('password') ? ' has-error' : '' }}">
                            <div class="input-field col s12">
                                <input id="password" type="password" name="password" required autofocus>
                                <label for="password">Пароль</label>
                            </div>

                            @if ($errors->has('password'))
                                <span class="help-block">
                                <strong>{{ $errors->first('password') }}</strong>
                            </span>
                            @endif
                        </div>
                        <div>
                            <input type="checkbox" class="filled-in" id="remember" name="remember"/>
                            <label for="remember">Запомнить меня</label>
                        </div>
                        <div class="row">
                            <div class="input-field col s12">
                                <button type="submit" class="btn btn-primary">
                                    Login
                                </button>

                            </div>
                        </div>
                    </form>

                    <a href="{{ url('/password/reset') }}">Забыли пароль?</a>
                </div>
            </div>
        </div>
    </div>
@endsection
