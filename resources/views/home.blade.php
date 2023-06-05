@extends('layouts.user_app')

@section('title', 'Головна')

@section('content')
    <main>
        <div class="jumbotron text-center">
            <h1 class="display-4">Ласкаво просимо до автосалону Lev Motors!</h1>
            <p class="lead">Ми пропонуємо вам широкий вибір автомобілів від провідних світових виробників.</p>
        </div>

        <!-- Особливості автосалону -->
        <div class="container">
            <div class="row">
                <div class="col-md-4">
                    <h2>Широкий вибір автомобілів</h2>
                    <p>У нас ви знайдете автомобілі на будь-який смак: від компактних міських автомобілів до розкішних
                        спортивних машин.</p>
                </div>
                <div class="col-md-4">
                    <h2>Гнучка система оплати</h2>
                    <p>Ми пропонуємо різні варіанти оплати, включаючи кредит і лізинг. Наша мета - зробити процес покупки
                        автомобіля якомога зручнішим для вас.</p>
                </div>
                <div class="col-md-4">
                    <h2>Якісний сервіс</h2>
                    <p>Наша команда професіоналів завжди готова допомогти вам з вибором автомобіля і відповісти на всі ваші
                        питання.</p>
                </div>
            </div>
        </div>

        <!-- Секція "Про нас" -->
        <div class="container mt-5">
            <h2 class="text-center">Про нас</h2>
            <p>Автосалон LevMotors був заснований у 2023 році з метою надати клієнтам найкращий вибір автомобілів та забезпечити
                найвищий рівень обслуговування. Ми постійно вдосконалюємо свої навички і розширюємо
                асортимент, щоб кожен клієнт міг знайти ідеальний автомобіль. Разом з цим ми прагнемо до постійного
                поліпшення якості нашого сервісу, тому ваші відгуки та пропозиції завжди важливі для нас.</p>
        </div>
        {{-- <div class="slider">
            <div><img src="{{ asset('images/car1.jpg') }}" alt="Car 1"></div>
            <div><img src="{{ asset('images/car2.jpg') }}" alt="Car 2"></div>
            <div><img src="{{ asset('images/car3.jpeg') }}" alt="Car 3"></div>
            <div><img src="{{ asset('images/car4.jpg') }}" alt="Car 4"></div>
        </div> --}}
    </main>
@endsection
