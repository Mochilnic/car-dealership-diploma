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
        <tr>
            <td>Ціна:</td>
            <td>{{ $order->car->price }} $</td>
        </tr>
    </table>

    <p>Статус замовлення: {{ $order->status }}</p>

    <p>Ми зв'яжемося з Вами найближчим часом для підтвердження замовлення.</p>
</body>

</html>
