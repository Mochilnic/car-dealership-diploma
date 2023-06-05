@extends('layouts.user_app')

@section('title', 'Контакти')

@section('content')
    <main>
        <div class="container">
            <h1>Контакти</h1>
            <div class="container mt-5">
                <div class="card">
                    <div class="card-body">
                        <h2 class="text-center">Контактна інформація</h2>
                        <p class="text-center">Адреса: м. Київ, проспект Перемоги, 37К18</p>
                        <p class="text-center">Телефон: +380 11111111</p>
                        <p class="text-center">Електронна пошта: info@levmotors.ua</p>
                    </div>
                </div>
            </div>


            <div class="container mt-5">
                <div class="card">
                    <div class="card-body">
                        <h2 class="text-center">Години роботи</h2>
                        <p class="text-center">Понеділок - П'ятниця: 9:00 - 18:00</p>
                        <p class="text-center">Субота: 10:00 - 16:00</p>
                        <p class="text-center">Неділя: вихідний</p>
                    </div>
                </div>
            </div>

            <div class="container mt-5">
                <h2 class="text-center">Ми тут</h2>
                <div id="map" class="justify-content-center">
                    <iframe src="https://www.google.com/maps/embed?pb=!1m14!1m8!1m3!1d755.3483230064538!2d30.456329177081574!3d50.44708346040245!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x40d4ce9d80e00ecf%3A0x50f155ac0933232e!2z0L_RgNC-0YHQv9C10LrRgiDQn9C10YDQtdC80L7Qs9C4LCAzN9CaMTgsINCa0LjRl9CyLCAwMjAwMA!5e0!3m2!1sru!2sua!4v1685977841496!5m2!1sru!2sua" width="600" height="450" style="border:0; display: block; margin-left: auto; margin-right: auto;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
                </div>
            </div>
        </div>
    </main>
@endsection
