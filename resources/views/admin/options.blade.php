@extends('layouts.app')

@section('content')
    <h1>Додати опцію для {{ $car->make }} {{ $car->model }}</h1>
    <form method="POST" action="{{ route('admin.cars.options', $car) }}">
        @csrf

        @if (session('status'))
                <div class="alert alert-success">
                    {{ session('status') }}
                </div>
            @endif
            
        <div class="mb-3">
        <label for="category">Категорія</label>
        <select id="category" name="category">
            <option value="color">Колір кузова</option>
            <option value="wheels_type">Тип дисків</option>
            <option value="wheels_diameter">Діаметр дисків</option>
            <option value="seats_type">Тип сидінь</option>
            <option value="additional">Додаткові опції</option>
        </select>
        </div>

        <div class="mb-3">
        <label for="name">Назва</label>
        <input id="name" name="name" type="text">
        </div>

        <div class="mb-3">
        <label for="price">Ціна</label>
        <input id="price" name="price" type="text">
        </div> 
        <button type="submit" class="btn btn-primary">Додати опцію</button>
    </form>
@endsection
