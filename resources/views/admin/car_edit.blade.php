@extends('layouts.app')

@section('content')
    <div class="container">
        <a href="{{ url()->previous() }}" class="btn btn-secondary mb-3">Назад</a>
        <form action="{{ route('cars.update', $car->id) }}" method="POST" enctype="multipart/form-data">
            <script>
                document.addEventListener('DOMContentLoaded', function() {
                    let removeButtons = document.querySelectorAll('.additional-image button');

                    removeButtons.forEach(function(button) {
                        button.addEventListener('click', function() {
                            let imageDiv = button.parentElement;
                            imageDiv.style.display = 'none';

                            const deletedText = document.createElement('span');
                            deletedText.textContent = 'Зображення видалено';
                            deletedText.style.color = 'red';
                            imageDiv.appendChild(deletedText);

                            button.remove();

                        
                            let deletedImagesInput = document.getElementById("deleted_additional_images");
                            let imageName = imageDiv.querySelector("img").src.split("/").pop();
                            if (deletedImagesInput.value === "") {
                                deletedImagesInput.value = imageName;
                            } else {
                                deletedImagesInput.value += "," + imageName;
                            }

                        });
                    });
                });
            </script>
            @csrf
            {{ method_field('PUT') }}

            <div class="mb-3">
                <label for="make" class="form-label">Марка</label>
                <input type="text" class="form-control" id="make" name="make" value="{{ $car->make }}"
                    required>
            </div>
            <div class="mb-3">
                <label for="model" class="form-label">Модель</label>
                <input type="text" class="form-control" id="model" name="model" value="{{ $car->model }}"
                    required>
            </div>
            <div class="mb-3">
                <label for="year" class="form-label">Рік випуску</label>
                <input type="number" class="form-control" id="year" name="year" value="{{ $car->year }}"
                    required>
            </div>
            <div class="mb-3">
                <label for="price" class="form-label">Ціна</label>
                <input type="number" class="form-control" id="price" name="price" value="{{ $car->price }}"
                    required>
            </div>
            <div class="mb-3">
                <label for="body_type" class="form-label">Тип кузова</label>
                <input type="text" class="form-control" id="body_type" name="body_type" value="{{ $car->body_type }}"
                    required>
            </div>
            <div class="mb-3">
                <label for="transmission" class="form-label">Трансмісія</label>
                <select class="form-select" id="transmission" name="transmission" required>
                    <option selected disabled value="">Оберіть трансмісію</option>
                    @if ($car->transmission == 'AWD')
                        <option value="AWD" selected>AWD</option>
                    @else
                        <option value="AWD">AWD</option>
                    @endif
                    @if ($car->transmission == 'RWD')
                        <option value="RWD" selected>RWD</option>
                    @else
                        <option value="RWD">RWD</option>
                    @endif
                    @if ($car->transmission == 'FWD')
                        <option value="FWD" selected>FWD</option>
                    @else
                        <option value="FWD">FWD</option>
                    @endif
                </select>
            </div>
            <div class="mb-3">
                <label for="doors" class="form-label">Кількість дверей</label>
                <input type="number" class="form-control" id="doors" name="doors" value="{{ $car->doors }}"
                    required>
            </div>

            <div class="mb-3">
                <label for="engine_type" class="form-label">Тип двигуна</label>
                <input type="text" class="form-control" id="engine_type" name="engine_type"
                    value="{{ $car->engine_type }}" required>
            </div>
            <div class="mb-3">
                <label for="engine_power" class="form-label">Потужність двигуна (к.с.)</label>
                <input type="number" class="form-control" id="engine_power" name="engine_power"
                    value="{{ $car->engine_power }}" required>
            </div>
            <div class="mb-3">
                <label for="torque" class="form-label">Крутний момент (Нм)</label>
                <input type="number" class="form-control" id="torque" name="torque" value="{{ $car->torque }}"
                    required>
            </div>
            <div class="mb-3">
                <label for="acceleration" class="form-label">Розгін до 100 км/год (с)</label>
                <input type="text" class="form-control" id="acceleration" name="acceleration"
                    value="{{ $car->acceleration }}" required>
            </div>
            <div class="mb-3">
                <label for="top_speed" class="form-label">Максимальна швидкість (км/год)</label>
                <input type="number" class="form-control" id="top_speed" name="top_speed"
                    value="{{ $car->top_speed }}" required>
            </div>


            <div class="form-group">
                <label for="main_image">Основне зображення:</label>
                <img src="{{ asset('storage/cars/' . $car->main_image) }}"
                    alt="{{ $car->brand }} {{ $car->model }}" width="200">
                <input type="file" class="form-control-file" id="main_image" name="main_image">
            </div>

            <div class="form-group">
                <label>Додаткові зображення:</label>
                @foreach (json_decode($car->additional_images) as $additionalImage)
                    <div class="additional-image">
                        <img src="{{ asset('storage/cars/' . $additionalImage) }}" alt="Дополнительное изображение"
                            width="200">
                        <button type="button" class="btn btn-danger btn-sm">Видалити</button>
                    </div>
                @endforeach
                <input type="file" class="form-control-file" name="additional_images[]" multiple>
            </div>
            <div class="form-group">
                <label for="description">Опис автомобіля</label>
                <textarea name="description" id="description" class="form-control" rows="5">{{ old('description', $car->description) }}</textarea>
            </div>

            <input type="hidden" name="deleted_additional_images" id="deleted_additional_images">

            <button type="submit" class="btn btn-primary">Зберегти зміни</button>
        </form>
    </div>
@endsection
