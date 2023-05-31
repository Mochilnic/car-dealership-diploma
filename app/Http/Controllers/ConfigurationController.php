<?php

namespace App\Http\Controllers;

use App\Models\Car;
use App\Models\Order;
use Illuminate\Http\Request;

class ConfigurationController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request)
    {
        $car = Car::find($request->input('car_id'));

        $categories = ['color', 'wheels_type', 'wheels_diameter', 'seats_type', 'additional'];
        $optionsArray = [];
        foreach ($categories as $category) {
            $options = $car->options()->where('category', $category)->get();

            $optionsArray[] = [
                'name' => $category,
                'options' => $options->map(function ($option) {
                    return [
                        'id' => $option->id,
                        'name' => $option->name,
                        'price' => $option->price,
                    ];
                })->toArray(),
            ];
        }
        // dd($optionsArray);
        return view('configurations', ['options' => $optionsArray, 'car' => $car]);
    }

    public function saveOptions(Request $request)
    {
        try {
            $selectedOptions = $request->input('selected');
            $totalPrice = $request->input('totalPrice');

            $order = new Order();
            $order->options = json_encode($selectedOptions);
            $order->total_price = $totalPrice;
            dd($order);
            $order->save();
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }

        return response()->json([
            'status' => 'success',
            'message' => 'Options saved successfully'
        ]);
    }



    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
