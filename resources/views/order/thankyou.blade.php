<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Thank you</title>
    @include('partials.scripts')
</head>

<body>
    @include('partials.header')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">{{ __('Дякуємо за Ваше замовлення') }}</div>

                    <div class="card-body">
                        <p>Ваше замовлення було прийнято і знаходиться в обробці.</p>
                        <p>Ми надіслали вам лист на електронну пошту з подробицями замовлення.</p>

                        <a href="{{ route('home') }}" class="btn btn-primary">Повернутися на головну</a>
                        <a href="{{ route('orders.index') }}" class="btn btn-secondary">Переглянути замовлення</a>

                    </div>
                </div>
            </div>
        </div>
    </div>
    @include('partials.footer')
</body>

</html>
