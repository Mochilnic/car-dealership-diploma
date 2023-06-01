@extends('layouts.user_app')

@section('title', 'Ваші замовлення')

@section('content')
<style>
    table {
        table-layout: fixed
    }

    th {
        width: 20%;
    }

    th#options {
        width: 30%;
    }

    li {
        list-style-type: none;
    }
</style>
    <main>
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-12">
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
                                            <th scope="col" id="options">Опції</th>
                                            <th scope="col">Вартість замовлення</th>
                                            <th scope="col">Статус</th>
                                            <th></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($orders as $order)
                                            <tr>
                                                <th scope="row">{{ $order->id }}</th>
                                                <td>{{ $order->created_at }}</td>
                                                <td>{{ $order->car->make }} {{ $order->car->model }},
                                                    {{ $order->car->year }}р.</td>
                                                    <td>
                                                        @if ($order->options()->get()!="[]")
                                                            @foreach ($order->options()->get() as $option)
                                                                <li><strong>{{ $option->displayName() }}</strong>:
                                                                    {{ $option->name }} </li>
                                                            @endforeach
                                                        @else
                                                            -
                                                        @endif
                                                    </td>
                                                    <td>{{ $order->total_price }} $</td>
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
