@extends('layouts.user_app')

@section('title','Каталог автомобілів')

@section('content')
    <main>
        <div class="container">
            <h1>Каталог автомобілів</h1>
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
 @endsection
