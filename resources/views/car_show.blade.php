@extends('layouts.user_app')

@section('title', $car->make . ' ' . $car->model)

@section('content')
    
    <main>
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <h1>{{ $car->make }} {{ $car->model }} {{ $car->year }}</h1>
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
                <a href="{{ route('order.confirm', $car->id) }}" class="btn btn-primary">Замовити автомобіль</a>

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

        
        @foreach ($car->comments as $comment)
            <div class="container">
                <div class="row">
                    <div class="col-9">
                        <strong>{{ $comment->user->name }}</strong>
                        @if ($comment->user->is_admin)
                        <span class="badge badge-secondary">адміністратор</span>
                        @endif
                        <p>{{ $comment->body }}</p>

                    </div>
                    <div class="col">
                        @if (auth()->check() && auth()->user()->is_admin)
                            <form
                                action="{{ route('comments.destroy', ['car' => $car->id, 'comment' => $comment->id]) }}"
                                method="POST">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-link">Видалити коментар</button>
                            </form>
                        @endif
                    </div>
                </div>
            </div>
        @endforeach


        @if (auth()->check())
            <form action="{{ route('comments.store', $car->id) }}" method="POST">
                @csrf
                <div class="form-group">
                    <textarea class="form-control" rows="3" name="body" placeholder="Опублікувати коментар"></textarea>
                </div>
                <button type="submit" class="btn btn-secondary">Опублікувати коментар</button>
            </form>
        @else
            <a href="{{ route('login') }}">Увійдіть</a> або <a href="{{ route('register') }}">зареєструйтесь</a>, щоб
            залишити коментар.
        @endif
    </main>
        @endsection
        @section('scripts')
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
   
@endsection
