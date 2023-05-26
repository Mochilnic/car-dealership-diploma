@extends('layouts.user_app')

@section('title', 'Каталог автомобілів')

@section('content')
    <main>
        <div class="container">
            <h1>Каталог автомобілів</h1>
            <form action="{{ route('cars.index') }}" method="GET">
                <input type="text" name="search" placeholder="Введіть марку або модель для пошуку..."
                    value="{{ request('search') }}">
                <button type="submit">Шукати</button>
                <br>
                <select name="sort" class="form-select">
                    <option selected disabled value="">Сортувати за...</option>
                    <option value="price" {{ request('sort') == 'price' ? 'selected' : '' }}>Ціною</option>
                    <option value="engine_power" {{ request('sort') == 'engine_power' ? 'selected' : '' }}>Потужністю</option>
                </select>

                <select name="order" class="form-select">
                    <option selected disabled value="">Порядок...</option>
                    <option value="asc" {{ request('order') == 'asc' ? 'selected' : '' }}>Зростаючий</option>
                    <option value="desc" {{ request('order') == 'desc' ? 'selected' : '' }}>Спадаючий</option>
                </select>


            </form>

            @if ($cars->isEmpty())
                <br><br>
                <h3>Автомобілей не знайдено.</h3>
                <br>
            @else
                <div class="row">
                    @foreach ($cars as $car)
                        <div class="col-md-4">
                            <div class="card mb-4">
                                <img src="{{ asset('storage/cars/' . $car->main_image) }}" alt="Car Image">

                                <div class="card-body">
                                    <h5 class="card-title">{{ $car->make }} {{ $car->model }} {{ $car->year }}
                                    </h5>
                                    <p class="card-text"><strong>Ціна:</strong> {{ $car->price }} $</p>
                                    <p class="card-text"><strong>Потужність:</strong> {{ $car->engine_power }} к.с.</p>
                                    <p class="card-text"><strong>Трансміссія:</strong> {{ $car->transmission }}</p>
                                    <a href="{{ route('cars.show', $car->id) }}" class="btn btn-primary">Детальніше</a>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            @endif
        </div>
    </main>
@endsection
