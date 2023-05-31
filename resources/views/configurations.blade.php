@extends('layouts.user_app')

@section('title','Конфігурація')

@section('content')
<div id="app">
    <car-options :options="{{ json_encode($options) }}" :base-price="{{ $car->price }}"></car-options>
</div>
@endsection
