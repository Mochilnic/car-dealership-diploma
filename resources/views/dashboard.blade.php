<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            Dashboard
        </h2>
        
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    @if (Auth::user() && Auth::user()->is_admin)
                    <h1>You're logged in as Administrator!</h1>
                     <a href="{{ route('car_create') }}" class="btn btn-primary mt-3">Створити новий автомобіль</a>
                     <a href="{{ route('admin.cars_list') }}" class="btn btn-secondary mt-3">Перейти до списку автомобілів</a>
                     <a href="{{ route('admin.orders') }}" class="btn btn-success mt-3">Перейти до списку замовлень</a>
                    @else
                    <h1>You're logged in!</h1>
                    <a href="{{ route('orders.index') }}" class="btn btn-primary">Мої замовлення</a>
                    @endif
                    
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
