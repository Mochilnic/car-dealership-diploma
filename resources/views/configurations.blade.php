@extends('layouts.user_app')

@section('title', 'Конфігурація')

@section('content')
<style>
    main{
        margin-left: 2%;
        margin-top: 1%;
    }
</style>
    <main>
        <form method="POST" action="{{ route('order.configure', $car) }}">
            @csrf

            <input type="hidden" name="car_id" value="{{ $car->id }}">

            @foreach ($options as $category => $categoryOptions)
            
                @if ($category == 'color')
                    <h4>Колір кузова</h4>
                @endif
                @if ($category == 'wheels_type')
                    <h4>Тип дисків</h4>
                @endif
                @if ($category == 'wheels_diameter')
                    <h4>Діаметр дисків</h4>
                @endif
                @if ($category == 'seats_type')
                    <h4>Тип сидінь</h4>
                @endif
                @if ($category == 'additional')
                    <h4>Додаткові опції</h4>
                    @foreach ($categoryOptions as $option)
                        <input type="checkbox" name="options[]" id="option{{ $option->id }}" value="{{ $option->id }}">
                        <label for="option{{ $option->id }}"><strong>{{ $option->name }}</strong> - {{ $option->price }}
                            $</label><br>
                    @endforeach
                @else
                    @foreach ($categoryOptions as $option)
                        <input type="radio" name="options[{{ $category }}]" id="option{{ $option->id }}"
                            value="{{ $option->id }}">
                        <label for="option{{ $option->id }}"><strong>{{ $option->name }}</strong> -
                            {{ $option->price }} $</label><br>
                    @endforeach
                @endif
            @endforeach

            <button type="submit">Оформити замовлення</button>
        </form>

        </form>
    </main>
@endsection
