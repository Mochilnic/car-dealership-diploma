<header>
    <div class="logo">
        <a href="{{ route('home') }}"><img src="{{ asset('images/header.jpg') }}" alt="Логотип автосалону Lev Motors"></a>
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
                        <a class="nav-link" href="{{ route('home') }}">{{ __('Головна') }}</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('catalog') }}">{{ __('Каталог автомобілів') }}</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('contacts') }}">{{ __('Контакти') }}</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
</header>