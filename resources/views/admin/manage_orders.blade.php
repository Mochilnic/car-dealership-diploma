@extends('layouts.app')

@section('title', 'Список замовлень')

@section('content')
    <style>
        li {
            list-style-type: none;
        }
    </style>
    <main>
        <div class="container">
            <a href="{{ route('dashboard') }}" class="btn btn-secondary mb-3">Назад</a><br>
            <h1>Список замовлень</h1>

            @if (session('status'))
                <div class="alert alert-success">
                    {{ session('status') }}
                </div>
            @endif

            <table class="table table-striped mt-3 col-12">
                <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Ім'я замовника</th>
                        <th scope="col">Електронна пошта замовника</th>
                        <th scope="col">Марка та модель автомобіля</th>
                        <th scope="col" id="options">Обрані опції</th>
                        <th scope="col">Статус замовлення</th>
                        <th scope="col"></th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($orders as $order)
                        <tr>
                            <th scope="row">{{ $order->id }}</th>
                            <td>{{ $order->user->name }}</td>
                            <td>{{ $order->user->email }}</td>
                            <td>{{ $order->car->make }} {{ $order->car->model }}, {{ $order->car->year }}р.</td>
                            <td>
                                @if ($order->options()->get()!="[]")
                                    @foreach ($order->options()->get() as $option)
                                        <li><strong>{{ $option->displayName() }}</strong>:
                                            {{ $option->name }}</li>
                                    @endforeach
                                @else
                                    -
                                @endif
                            </td>
                            <td>
                                <select class="form-select status-select" data-order-id="{{ $order->id }}">
                                    @foreach ($statuses as $status)
                                        <option value="{{ $status }}"
                                            {{ $order->status == $status ? 'selected' : '' }}>{{ $status }}</option>
                                    @endforeach
                                </select>
                            </td>
                            <td><button class="btn btn-primary save-status-btn" data-order-id="{{ $order->id }}"
                                    style="display: none;">Зберегти</button></td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </main>
@endsection
@section('scripts')
    <script>
        $(document).ready(function() {
            $('.status-select').on('change', function() {
                var orderId = $(this).data('order-id');
                $('.save-status-btn[data-order-id="' + orderId + '"]').show();
            });

            $('.save-status-btn').on('click', function() {
                var orderId = $(this).data('order-id');
                var status = $('.status-select[data-order-id="' + orderId + '"]').val();

                $.post({
                    url: '{{ route('admin.orders.updateStatus') }}',
                    data: {
                        order_id: orderId,
                        status: status,
                        _token: '{{ csrf_token() }}'
                    },
                    success: function() {
                        location.reload();
                    }
                });
            });
        });
    </script>
@endsection
