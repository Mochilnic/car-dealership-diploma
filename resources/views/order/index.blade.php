<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>List of orders</title>
    @include('partials.scripts')
</head>

<body>
    @include('partials.header')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-9">
                <div class="card">
                    <div class="card-header">{{ __('Мої замовлення') }}</div>

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
                                            @if ($order->status !== 'Відмінений')
                                                <td><form method="POST" action="{{ route('orders.cancel', $order->id) }}">
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
    @include('partials.footer')
</body>

</html>
