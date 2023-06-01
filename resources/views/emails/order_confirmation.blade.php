<!DOCTYPE html>
<html>

<head>
    <title>Підтвердження замовлення</title>
    <style>
        body {
            font-family: Arial, sans-serif;
        }

        .container {
            width: 80%;
            margin: auto;
            padding: 20px;
            border: 1px solid #ddd;
            border-radius: 5px;
            background-color: #f8f8f8;
        }

        table {
            width: 100%;
            margin-top: 20px;
        }

        th,
        td {
            text-align: left;
            padding: 10px;
        }

        th {
            background-color: #4CAF50;
            color: white;
        }
    </style>
</head>

<body>
    <h2>Дякуємо за Ваше замовлення, {{ $order->user->name }}!</h2>

    <p>Ви замовили наступний автомобіль:</p>

    <table>
        <tr>
            <td>Модель:</td>
            <td>{{ $order->car->model }}</td>
        </tr>
        <tr>
            <td>Бренд:</td>
            <td>{{ $order->car->make }}</td>
        </tr>
        @if ($order->options->count() > 0)
        <tr>
            <td>Обрані опції:</td>
            <td>
            <ul>
                @foreach ($order->options as $option)
                    <li>{{ $option->displayName() }}: {{ $option->name }} ({{ $option->price }}$)</li>
                @endforeach
            </ul>
        </td>
        </tr>
        @endif

    
        <tr>
            <td>Ціна:</td>
            <td>{{ $order->total_price }} $</td>
        </tr>
        <tr><td>Статус замовлення:</td> <td>В обробці</td></tr>
    </table>

    

    <p>Ми зв'яжемося з Вами найближчим часом для підтвердження замовлення.</p>
</body>

</html>
