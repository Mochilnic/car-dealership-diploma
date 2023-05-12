<!DOCTYPE html>
<html lang="uk">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Автосалон Lev Motors</title>
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <link rel="stylesheet" href="{{ asset('slick/slick.css') }}">
    <link rel="stylesheet" href="{{ asset('slick/slick-theme.css') }}">
    <script src="{{ asset('slick/slick.min.js') }}" defer></script>
    {{-- <script src="{{ asset('js/app.js') }}" defer></script> --}}
    <script src="{{ asset('js/slider.js') }}" defer></script>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</head>

<body>

    @include('partials.header')
    <main>
        <h1>Ласкаво просимо в автосалон Lev Motors!</h1>
        <div class="slider">
            <div><img src="{{ asset('images/car1.jpg') }}" alt="Car 1"></div>
            <div><img src="{{ asset('images/car2.jpg') }}" alt="Car 2"></div>
            <div><img src="{{ asset('images/car3.jpeg') }}" alt="Car 3"></div>
            <div><img src="{{ asset('images/car4.jpg') }}" alt="Car 4"></div>
        </div>
    </main>
    
    @include('partials.footer')
</body>

</html>
