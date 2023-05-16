@extends('layouts.app')

@section('content')
<div class="container">
    <a href="{{ url()->previous() }}" class="btn btn-secondary mb-3">Назад</a>

    <h1>Додати автомобіль</h1>
    
    <form action="{{ route('car_store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="mb-3">
            <label for="make" class="form-label">Марка</label>
            <input type="text" class="form-control" id="make" name="make" required>
        </div>
        <div class="mb-3">
            <label for="model" class="form-label">Модель</label>
            <input type="text" class="form-control" id="model" name="model" required>
        </div>
        <div class="mb-3">
            <label for="year" class="form-label">Рік випуску</label>
            <input type="number" class="form-control" id="year" name="year" required>
        </div>
        <div class="mb-3">
            <label for="price" class="form-label">Ціна</label>
            <input type="number" class="form-control" id="price" name="price" required>
        </div>
        <div class="mb-3">
            <label for="body_type" class="form-label">Тип кузова</label>
            <input type="text" class="form-control" id="body_type" name="body_type" required>
        </div>
        <div class="mb-3">
            <label for="transmission" class="form-label">Трансмісія</label>
            <select class="form-select" id="transmission" name="transmission" required>
                <option selected disabled value="">Оберіть трансмісію</option>
                <option value="AWD">AWD</option>
                <option value="RWD">RWD</option>
                <option value="FWD">FWD</option>
            </select>
        </div>
        <div class="mb-3">
            <label for="doors" class="form-label">Кількість дверей</label>
            <input type="number" class="form-control" id="doors" name="doors" required>
        </div>
        
        <div class="mb-3">
            <label for="engine_type" class="form-label">Тип двигуна</label>
            <input type="text" class="form-control" id="engine_type" name="engine_type" required>
        </div>
        <div class="mb-3">
            <label for="engine_power" class="form-label">Потужність двигуна (к.с.)</label>
            <input type="number" class="form-control" id="engine_power" name="engine_power" required>
        </div>
        <div class="mb-3">
            <label for="torque" class="form-label">Крутний момент (Нм)</label>
            <input type="number" class="form-control" id="torque" name="torque" required>
        </div>
        <div class="mb-3">
            <label for="acceleration" class="form-label">Розгін до 100 км/год (с)</label>
            <input type="text" class="form-control" id="acceleration" name="acceleration" required>
        </div>
        <div class="mb-3">
            <label for="top_speed" class="form-label">Максимальна швидкість (км/год)</label>
            <input type="number" class="form-control" id="top_speed" name="top_speed" required>
        </div>
        <div class="form-group">
            <label for="main_image">Основне зображення</label>
            <input type="file" class="form-control-file" name="main_image" id="main_image">
        </div>
        
        <div class="form-group">
            <label for="additional_images">Додаткові зображення</label>
            <input type="file" class="form-control-file" name="additional_images[]" id="additional_images" multiple>
        </div>
        <div class="mb-3">
            <label for="description" class="form-label">Опис автомобіля</label>
            <textarea class="form-control" id="description" name="description" rows="3" required></textarea>
        </div>
        <button type="submit" class="btn btn-primary">Додати автомобіль</button>
        @if ($errors->any())
        <div>
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
    </form>
</div>
@endsection
