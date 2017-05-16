@extends('layouts.app')

@section('content')
<div class="row">
    <div class="col s12 m10 offset-m1 l8 offset-l2">
        <div class="card ">
            <div class="card-content">
                <h3>Регистрация</h3>
                <form class="form-horizontal" role="form" method="POST" action="{{ url('/register') }}">
                    {{ csrf_field() }}
                    <div class="row{{ $errors->has('name') ? ' has-error' : '' }}">

                        <div class="input-field col s12">
                            <input id="name" type="text" name="name" value="{{ old('name') }}" required autofocus>
                            <label for="name">Имя</label>
                        </div>
                        @if ($errors->has('name'))
                            <span class="help-block">
                                        <strong>{{ $errors->first('name') }}</strong>
                                    </span>
                        @endif
                    </div>
                    <div class="row{{ $errors->has('email') ? ' has-error' : '' }}">
                        <div class="input-field col s12">
                            <input id="email" type="email" name="email" value="{{ old('email') }}" required>
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
                            <input id="password" type="password" class="form-control" name="password" required>
                            <label for="password" class="col-md-4 control-label">Пароль</label>
                            @if ($errors->has('password'))
                                <span class="help-block">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                            @endif
                        </div>
                    </div>

                    <div class="row{{ $errors->has('password_confirmation') ? ' has-error' : '' }}">

                        <div class="input-field col s12">
                            <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required>
                            <label for="password-confirm" class="col-md-4 control-label">Подтверждение пароля</label>
                            @if ($errors->has('password_confirmation'))
                                <span class="help-block">
                                        <strong>{{ $errors->first('password_confirmation') }}</strong>
                                    </span>
                            @endif
                        </div>
                    </div>

                    <div class="row">
                        <div class="input-field col s12">
                            <button type="submit" class="btn btn-primary">
                                Регистрация
                            </button>
                        </div>
                    </div>

                </form>

            </div>
        </div>
    </div>
</div>
@endsection
