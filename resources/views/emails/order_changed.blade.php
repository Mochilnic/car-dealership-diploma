<!DOCTYPE html>
<html>
<head>
    <title>Статус вашого замовлення змінений</title>
    <style>
        body {
            font-family: Arial, sans-serif;
        }
        .container {
            max-width: 600px;
            margin: auto;
            padding: 20px;
            border: 1px solid #ddd;
            border-radius: 5px;
            background-color: #f9f9f9;
        }
        .content {
            margin-top: 20px;
        }
        .title {
            text-align: center;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1 class="title">Статус вашого замовлення змінений</h1>
        <div class="content">
            <p>Вітаємо, {{ $order->user->name }},</p>
            <p>Статус вашого замовлення #{{ $order->id }} на {{ $car->make }} {{ $car->model }} був змінений.</p>
            <p>Попередній статус: {{ $oldStatus }}</p>
            <p>Поточний статус: {{ $order->status }}</p>
            <p>Ми продовжимо тримати вас в курсі про будь-які подальші оновлення вашого замовлення.</p>
            <p>Наша компанія завжди на зв'язку!</p>
        </div>
    </div>
</body>
</html>
