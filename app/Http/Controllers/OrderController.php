<?php

namespace App\Http\Controllers;

use App\Mail\OrderConfirmationMail;
use App\Models\Car;
use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;

class OrderController extends Controller
{
    public function index()
    {
        $orders = auth()->user()->orders;

        return view('order.index', ['orders' => $orders]);
    }

    public function list()
    {
        $orders = Order::all();
        $statuses = ['В обробці', 'Прийнятий до роботи', 'Затриманий', 'Відмінений', 'Автомобіль очікує клієнта', 'Виконаний'];

        return view('admin.manage_orders', ['orders' => $orders, 'statuses' => $statuses]);
    }

    public function confirm(Car $car)
    {
        return view('order.confirm', compact('car'));
    }

    public function store(Request $request, Car $car)
    {
        // Создание нового заказа
        $order = new Order();
        $order->user_id = auth()->user()->id;
        $order->car_id = $car->id;
        $order->status = 'В обробці'; // default status

        $order->save();

        Mail::to($order->user->email)->send(new OrderConfirmationMail($order));

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
        $order->status = $request->status;
        $order->save();

        return session()->flash('status', 'Статус замовлення #' . $order->id . ' оновлено на ' . $request->status);
    }
}
