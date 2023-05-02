@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Список автомобілей</h1>
    <div class="row">
        @foreach ($cars as $car)
            <div class="col-md-4">
                <div class="card mb-4">
                    <img src="{{ asset('storage/cars/' . $car->main_image) }}" class="card-img-top" alt="{{ $car->brand }} {{ $car->model }}">
                    <div class="card-body">
                        <h5 class="card-title">{{ $car->make }} {{ $car->model }} {{ $car->year }}</h5>
                        <a href="{{ route('cars.edit', $car->id) }}" class="btn btn-primary">Редагувати</a>
                        <form action="{{ route('admin.delete_car', $car->id) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger">Видалити</button>
                        </form>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
</div>
@endsection
