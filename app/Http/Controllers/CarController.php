<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Car;
use Illuminate\Support\Facades\Storage;

class CarController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $cars = Car::all();
        return view('catalog', ['cars' => $cars]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('car_create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'make' => 'required',
            'model' => 'required',
            'year' => 'required|integer',
            'price' => 'required|integer',
            'body_type' => 'required',
            'transmission' => 'required',
            'doors' => 'required|integer',
            'engine_type' => 'required',
            'engine_power' => 'required|integer',
            'torque' => 'required|integer',
            'acceleration' => 'required',
            'top_speed' => 'required|integer',
            'main_image' => 'image|mimes:jpg,jpeg,png|max:2048',
            'additional_images.*' => 'image|mimes:jpg,jpeg,png|max:2048'
        ]);

        // Обработка главного изображения
        if ($request->hasFile('main_image')) {
            $mainImage = $request->file('main_image');
            $mainImageName = time() . '_' . $mainImage->getClientOriginalName();
            $mainImage->storeAs('cars', $mainImageName, 'public');
        } else {
            $mainImageName = null;
        }

        // Обработка дополнительных изображений
        if ($request->hasFile('additional_images')) {
            $additionalImages = $request->file('additional_images');
            $additionalImageNames = [];
            foreach ($additionalImages as $additionalImage) {
                $additionalImageName = time() . '_' . $additionalImage->getClientOriginalName();
                $additionalImage->storeAs('cars', $additionalImageName, 'public');
                $additionalImageNames[] = $additionalImageName;
            }
        } else {
            $additionalImageNames = null;
        }

        $car = new Car([
            'make' => $request->input('make'),
            'model' => $request->input('model'),
            'year' => $request->input('year'),
            'price' => $request->input('price'),
            'body_type' => $request->input('body_type'),
            'transmission' => $request->input('transmission'),
            'doors' => $request->input('doors'),
            'engine_type' => $request->input('engine_type'),
            'engine_power' => $request->input('engine_power'),
            'torque' => $request->input('torque'),
            'acceleration' => $request->input('acceleration'),
            'top_speed' => $request->input('top_speed'),
            'description' => $request->input('description'),
            'main_image' => $mainImageName,
            'additional_images' => json_encode($additionalImageNames),
        ]);

        // dd($car);
        $car->save();

        return redirect()->route('car_store')->with('success', 'Автомобіль доданий успішно!');
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $car = Car::findOrFail($id);
        return view('car_show', ['car' => $car]);
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

    public function __construct()
    {
        $this->middleware(['auth', 'is_admin'])->except(['index', 'show']);
    }
}
