@extends('layouts.user_app')

@section('title', 'Ваші замовлення')

@section('content')

    <main>
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-9">
                    <div class="card">
                        <div class="card-header text-center">
                            <h3>Мої замовлення</h3>
                        </div>
                        @if (session('status'))
                            <div class="alert alert-success">
                                {{ session('status') }}
                            </div>
                        @endif
                        <div class="card-body">
                            @if ($orders->isEmpty())
                                <p>У вас поки що немає замовлень.</p>
                            @else
                                <table class="table">
                                    <thead>
                                        <tr>
                                            <th scope="col">Номер замовлення</th>
                                            <th scope="col">Дата замовлення</th>
                                            <th scope="col">Автомобіль</th>
                                            <th scope="col">Ціна</th>
                                            <th scope="col">Статус</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($orders as $order)
                                            <tr>
                                                <th scope="row">{{ $order->id }}</th>
                                                <td>{{ $order->created_at }}</td>
                                                <td>{{ $order->car->make }} {{ $order->car->model }},
                                                    {{ $order->car->year }}р.</td>
                                                <td>{{ $order->car->price }} $</td>
                                                <td>{{ $order->status }}</td>
                                                @if ($order->status !== 'Відмінений' && $order->status !== 'Виконаний')
                                                    <td>
                                                        <form method="POST"
                                                            action="{{ route('orders.cancel', $order->id) }}">
                                                            @csrf
                                                            <button type="submit" class="btn btn-danger">Скасувати
                                                                замовлення</button>
                                                        </form>
                                                    </td>
                                                @endif
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
@endsection
