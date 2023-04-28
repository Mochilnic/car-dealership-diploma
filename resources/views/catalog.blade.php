<!DOCTYPE html>
<html lang="uk">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Каталог автомобілів - Lev Motors</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
</head>

<body>
    @include('partials.header')
    <main>
        <div class="container">
            <h1>Каталог автомобілів</h1>
            <!-- Вміст каталогу автомобілів -->
            <div class="row">
                @foreach ($cars as $car)
                    <div class="col-md-4">
                        <div class="card mb-4">
                            <img src="{{ asset('storage/cars/' . $car->main_image) }}" alt="Car Image">

                            <div class="card-body">
                                <h5 class="card-title">{{ $car->make }} {{ $car->model }} {{ $car->year }}</h5>
                                <p class="card-text">{{ $car->price }} грн</p>
                                <p class="card-text">{{ $car->engine_power }} к.с.</p>
                                <p class="card-text">{{ $car->transmission }}</p>
                                <a href="{{ route('cars.show', $car->id) }}" class="btn btn-primary">Детальніше</a>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </main>
    @include('partials.footer')
</body>

</html>
