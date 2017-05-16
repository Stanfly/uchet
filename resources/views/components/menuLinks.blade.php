@if (Auth::guest())
    <li><a href="{{ url('/login') }}">Вход</a></li>
    <li><a href="{{ url('/register') }}">Регистрация</a></li>
@else
    <li>
        <a class="dropdown-button" href="#!" data-activates="menu_nav_dropdown-{{ $for }}">{{ Auth::user()->name }}<i class="material-icons right">arrow_drop_down</i></a>
        <ul id="menu_nav_dropdown-{{ $for }}" class="dropdown-content">
            <li>
                <a href="#!"><i class="material-icons left">settings</i>Настройки</a>
            </li>
            <li class="divider"></li>
            <li>
                <a href="{{ url('/logout') }}"
                   onclick="event.preventDefault();
                                                 document.getElementById('logout-form').submit();">
                    <i class="material-icons left">launch</i>Выход
                </a>

                <form id="logout-form" action="{{ url('/logout') }}" method="POST" style="display: none;">
                    {{ csrf_field() }}
                </form>
            </li>
        </ul>
    </li>
@endif