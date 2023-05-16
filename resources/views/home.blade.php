@extends('layouts.user_app')

@section('title','Головна')

@section('content')
    <main>
        <h1>Ласкаво просимо в автосалон Lev Motors!</h1>
        <div class="slider">
            <div><img src="{{ asset('images/car1.jpg') }}" alt="Car 1"></div>
            <div><img src="{{ asset('images/car2.jpg') }}" alt="Car 2"></div>
            <div><img src="{{ asset('images/car3.jpeg') }}" alt="Car 3"></div>
            <div><img src="{{ asset('images/car4.jpg') }}" alt="Car 4"></div>
        </div>
    </main>
@endsection
