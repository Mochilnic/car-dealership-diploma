@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <h1>{{ $car->brand }} {{ $car->model }} {{ $car->year }}</h1>
            <a href="{{ url()->previous() }}" class="btn btn-secondary mb-3">Назад</a>
        </div>
    </div>
    <div class="row">
        <div class="col-md-8">
            <div class="slider" id="car-page">
                <img src="{{ asset('storage/cars/' . $car->main_image) }}" alt="Главное изображение">
                @foreach (json_decode($car->additional_images) as $additionalImage)
                    <img src="{{ asset('storage/cars/' . $additionalImage) }}" alt="Дополнительное изображение">
                @endforeach
            </div>
        </div>
        <div class="col-md-4">
            <h2>Ціна: {{ $car->price }} $</h2>
        </div>
    </div>
    <div class="row mt-4">
        <div class="col-md-6">
            <table class="table table-bordered">
                <tr>
                    <th>Марка:</th>
                    <td>{{ $car->make }}</td>
                </tr>
                <tr>
                    <th>Модель:</th>
                    <td>{{ $car->model }}</td>
                </tr>
                <tr>
                    <th>Рік випуску:</th>
                    <td>{{ $car->year }} р.</td>
                </tr>
                <tr>
                    <th>Ціна:</th>
                    <td>{{ $car->price }} $</td>
                </tr>
                <tr>
                    <th>Тип кузова:</th>
                    <td>{{ $car->body_type }}</td>
                </tr>
                <tr>
                    <th>Трансмісія:</th>
                    <td>{{ $car->transmission }}</td>
                </tr>
                <tr>
                    <th>Кількість дверей:</th>
                    <td>{{ $car->doors }}</td>
                </tr>
                <tr>
                    <th>Тип двигуна:</th>
                    <td>{{ $car->engine_type }}</td>
                </tr>
                <tr>
                    <th>Потужність двигуна:</th>
                    <td>{{ $car->engine_power }} к.с.</td>
                </tr>
                <tr>
                    <th>Крутний момент:</th>
                    <td>{{ $car->torque }} Нм</td>
                </tr>
                <tr>
                    <th>Розгін до 100 км/год:</th>
                    <td>{{ $car->acceleration }} сек.</td>
                </tr>
                <tr>
                    <th>Максимальна швидкість:</th>
                    <td>{{ $car->top_speed }} км/год</td>
                </tr>
            </table>
        </div>
        <div class="col-md-6">
            <h3>Опис автомобіля:</h3>
            <p>{{ $car->description }}</p>
        </div>
    </div>
</div>

@push('scripts')
<script>
    $(document).ready(function() {
        $('.slider-for').slick({
            slidesToShow: 1,
            slidesToScroll: 1,
            arrows: true,
            autoplay: true,
            autoplaySpeed: 2000,
            adaptiveHeight: true
        });
    });
</script>
@endpush

@endsection
