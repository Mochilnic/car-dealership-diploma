<header>
    <div class="auth-menu">
        @auth
            <div class="dropdown">
                <button
                    class="dropdown inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md text-gray-500 dark:text-gray-400 bg-white dark:bg-gray-800 hover:text-gray-700 dark:hover:text-gray-300 focus:outline-none transition ease-in-out duration-150"
                    type="button" id="userDropdown" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <div style="display: inline-block"> {{ Auth::user()->name }}</div>
                    <div style="display: inline-block;width:15px;"><svg class="fill-current h-4 w-4"
                            xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                            <path fill-rule="evenodd"
                                d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"
                                clip-rule="evenodd"></path>
                        </svg>
                    </div>

                </button>
                <div class="dropdown-menu" aria-labelledby="userDropdown">
                    <a class="dropdown-item" href="{{ route('profile.edit') }}">Профіль</a>
                    <a class="dropdown-item" href="{{ route('dashboard') }}">Панель користувача</a>
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit" class="dropdown-item">Вийти</button>
                    </form>
                </div>
            </div>
        @else
            <div class="login-register btn-group" role="group" aria-label="Basic example">
                <form action="{{ route('login') }}" method="GET">
                    <button type="submit" class="btn btn-secondary">Увійти</button>
                </form>
                <form action="{{ route('register') }}" method="GET">
                    <button type="submit" class="btn btn-secondary">Зареєструватися</button>
                </form>
            </div>
        @endauth
    </div>

    <div class="logo">
        <a href="{{ route('home') }}"><img src="{{ asset('images/header.jpg') }}"
                alt="Логотип автосалону Lev Motors"></a>
    </div>
    <nav class="navbar navbar-expand-md bg-dark navbar-dark">
        <div class="container">
            {{-- <a class="navbar-brand" href="{{ route('home') }}">
                <img src="{{ asset('images/logo.png') }}" alt="Логотип автосалону Lev Motors" height="30">
            </a> --}}
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarContent">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarContent">
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('home') }}">Головна</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('car_store') }}">Каталог автомобілів</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('contacts') }}">Контакти</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('chat.show') }}">Центр підтримки</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
</header>
