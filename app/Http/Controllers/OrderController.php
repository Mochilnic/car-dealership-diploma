<?php

/** @phpcs:disable */

namespace App\Http\Controllers;

use App\Mail\OrderConfirmationMail;
use App\Mail\OrderStatusUpdated;
use App\Models\Car;
use App\Models\Option;
use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use App\Notifications\SendNotification;
use Illuminate\Notifications\AnonymousNotifiable;

class OrderController extends Controller
{
    public function index()
    {
        $orders = auth()->user()->orders()->with(['car' => function ($query) {
            $query->withTrashed();
        }])->get();

        return view('order.index', ['orders' => $orders]);
    }

    public function list()
    {
        $orders = Order::with(['car' => function ($query) {
            $query->withTrashed();
        }])->get();
        $statuses = ['В обробці', 'Прийнятий до роботи', 'Затриманий', 'Відмінений', 'Автомобіль очікує клієнта', 'Виконаний'];

        return view('admin.manage_orders', ['orders' => $orders, 'statuses' => $statuses]);
    }

    public function confirm(Car $car)
    {
        $car = session('car');
        $totalPrice = session('total_price');
        $options = Option::whereIn('id', session('option_ids'))->get();

        return view('order.confirm', compact('car', 'totalPrice', 'options'));
    }

    public function configure(Request $request, Car $car)
    {
        $request->validate([
            'options' => 'nullable|array',
            'options.*' => 'exists:options,id',
        ]);

        $optionIds = Arr::flatten($request->options);
        $totalPrice = Car::find($request->car_id)->price + Option::whereIn('id', $optionIds)->sum('price');

        session([
            'car' => $car,
            'total_price' => $totalPrice,
            'option_ids' => $optionIds,
        ]);

        return redirect()->route('order.confirm', $car);
    }

    public function store()
    {
        $car = session('car');
        $totalPrice = session('total_price');
        $optionIds = session('option_ids');

        $order = new Order([
            'user_id' => Auth::id(),
            'car_id' => $car->id,
        ]);

        $order->total_price = $totalPrice;
        
        $order->save();
        $order->options()->attach($optionIds);

        Mail::to($order->user->email)->send(new OrderConfirmationMail($order));
        $notifiable = (new AnonymousNotifiable)->route('telegram', '-1001927227945');
        $notifiable->notify(new SendNotification($order));
        session()->forget(['car', 'total_price', 'option_ids']);
        return redirect()->route('order.thankyou')->with('success', 'Ваше замовлення було прийнято');
    }


    public function cancel(Order $order)
    {
        if (Auth::id() !== $order->user_id) {
            return redirect()->back()->with('error', 'Ви не можете скасувати це замовлення.');
        }

        $order->update(['status' => 'Відмінений']);
        session()->flash('status', 'Замовлення #' . $order->id . ' відмінене');
        return redirect()->back()->with('success', 'Замовлення успішно скасоване.');
    }
    public function updateStatus(Request $request)
    {
        $request->validate([
            'order_id' => 'required|exists:orders,id',
            'status' => 'required|string',
        ]);

        $order = Order::find($request->order_id);
        $oldStatus = $order->status;
        $order->status = $request->status;
        $order->save();

        $car = Car::withTrashed()->find($order->car_id);

        Mail::to($order->user->email)->send(new OrderStatusUpdated($order, $car, $oldStatus));

        return session()->flash('status', 'Статус замовлення #' . $order->id . ' оновлено на ' . $request->status);
    }
}
