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
    public function index(Request $request)
    {
        $query = Car::query();

        if ($request->has('search')) {
            $search = $request->get('search');
            $query->where('model', 'like', "%{$search}%")
                ->orWhere('make', 'like', "%{$search}%");
        }

        if ($request->has('sort') && $request->has('order')) {
            $sort = $request->get('sort');
            $order = $request->get('order');

            if (in_array($sort, ['price', 'engine_power']) && in_array($order, ['asc', 'desc'])) {
                $query->orderBy($sort, $order);
            }
        }

        $cars = $query->paginate(15);

        return view('catalog', compact('cars'));
    }


    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.car_create');
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


        if ($request->hasFile('main_image')) {
            $mainImage = $request->file('main_image');
            $mainImageName = time() . '_' . $mainImage->getClientOriginalName();
            $mainImage->storeAs('cars', $mainImageName, 'public');
        } else {
            $mainImageName = null;
        }


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
    public function edit(Car $car)
    {
        return view('admin.car_edit', compact('car'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Car $car)
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


        if ($request->hasFile('main_image')) {

            Storage::delete('public/cars/' . $car->main_image);

            $mainImage = $request->file('main_image');
            $mainImageName = time() . '_' . $mainImage->getClientOriginalName();
            $mainImage->storeAs('public/cars', $mainImageName);

            $car->main_image = $mainImageName;
        }

        $currentAdditionalImages = explode(',', substr($car->additional_images, 1, -1));
        for ($i = 0; $i < count($currentAdditionalImages); $i++) {
            $currentAdditionalImages[$i] = substr($currentAdditionalImages[$i], 1, -1);
        }


        if ($request->deleted_additional_images) {
            $deletedImages = explode(',', $request->input('deleted_additional_images'));
            $currentAdditionalImages = array_diff($currentAdditionalImages, $deletedImages);
            foreach ($deletedImages as $deletedImage) {
                Storage::disk('public')->delete('cars/' . $deletedImage);
            }
        }
        $imagesToAdd = [];
        foreach ($currentAdditionalImages as $oneImage) {
            $oneImage = '"' . $oneImage . '"';
            array_push($imagesToAdd, $oneImage);
        }

        $imagesToAdd[0] = "[" . $imagesToAdd[0];
        $imagesToAdd[count($imagesToAdd) - 1] = $imagesToAdd[count($imagesToAdd) - 1] . "]";

        $car->update([
            'additional_images' => implode(',', $imagesToAdd),
        ]);


        $existingImages = json_decode($car->additional_images, true);
        $additionalImages = $request->file('additional_images');

        if ($additionalImages) {
            foreach ($additionalImages as $additionalImage) {
                $additionalImageName = time() . '_' . $additionalImage->getClientOriginalName();
                $additionalImage->storeAs('public/cars', $additionalImageName);
                $existingImages[] = $additionalImageName;
            }
        }

        $car->additional_images = json_encode($existingImages);

        $car->make = $request->input('make');
        $car->model = $request->input('model');
        $car->year = $request->input('year');
        $car->price = $request->input('price');
        $car->body_type = $request->input('body_type');
        $car->transmission = $request->input('transmission');
        $car->doors = $request->input('doors');
        $car->engine_type = $request->input('engine_type');
        $car->engine_power = $request->input('engine_power');
        $car->torque = $request->input('torque');
        $car->acceleration = $request->input('acceleration');
        $car->top_speed = $request->input('top_speed');
        $car->description = $request->input('description');


        $car->save();

        return redirect()->route('admin.cars_list')->with('success', 'Автомобіль успішно оновлений');
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Car $car)
    {

        Storage::delete('public/cars/' . $car->main_image);

        if ($car->additional_images != "null") {
            foreach (json_decode($car->additional_images) as $additionalImage) {
                Storage::delete('public/cars/' . $additionalImage);
            }
        }

        $car->comments()->delete();

        $car->delete();

        return redirect()->route('admin.cars_list')->with('success', 'Автомобіль видалений успішно');
    }

    public function list()
    {
        $cars = Car::all();
        return view('admin.cars_list', ['cars' => $cars]);
    }

    public function options(Car $car)
    {
        return view('admin.options', ['car' => $car]);
    }

    public function storeOption(Request $request, Car $car)
    {
        $request->validate([
            'category' => 'required',
            'name' => 'required',
            'price' => 'required|numeric',
        ]);

        $car->options()->create($request->only('category', 'name', 'price'));

        session()->flash('status', 'До категорії ' . $request->input('category') . ' додана опція ' . $request->input('name') . ' за ' . $request->input('price') . ' $');

        return redirect()->route('admin.cars.options', $car);
    }

    public function configure(Car $car)
    {
        session()->forget(['car', 'total_price', 'option_ids']);
        
        if ($car->options->isEmpty()) {
            session([
                'car' => $car,
                'total_price' => $car->price,
                'option_ids' => [],
            ]);

            return redirect()->route('order.confirm', $car);
        } else {
            $options = $car->options()->get()->groupBy('category');

            return view('configurations', ['car' => $car, 'options' => $options]);
        }
    }



    public function __construct()
    {
        $this->middleware(['auth', 'is_admin'])->except(['index', 'show']);
    }
}
