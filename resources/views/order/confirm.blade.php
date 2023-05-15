<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Confirm order</title>
    @include('partials.scripts')
</head>
<body>
    @include('partials.header')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Підтвердження замовлення</div>
    
                    <div class="card-body">
                        <h5 class="card-title">{{ $car->make }} {{ $car->model }}</h5>
                        <p class="card-text">Трансмісія: {{ $car->transmission }}</p>
                        <p class="card-text">Рік випуску: {{ $car->year }}р.</p>
                        <strong>Ціна: {{ $car->price }} $</strong>
                        <!-- И другие характеристики автомобиля -->
    
                        <form method="POST" action="{{ route('order.store', $car) }}">
                            @csrf
                            <button type="submit" class="btn btn-primary">Підтвердити замовлення</button>
                        </form>
                        <a href="{{ route('cars.show', $car) }}" class="btn btn-secondary">Відмінити замовлення</a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    @include('partials.footer')
</body>
</html>