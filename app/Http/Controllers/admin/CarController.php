<?php

namespace App\Http\Controllers\admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\cars\StoreCarRequest;
use App\Http\Requests\cars\UpdateCarRequest;

use App\Models\car;
use App\Models\car_category;
use App\Models\location;
use Illuminate\Support\Facades\Storage;
use PhpParser\Node\Expr\FuncCall;

class CarController extends Controller
{
    public function index()
    {
        $this->authorize('viewAny', car::class);
        $cars = car::paginate(10);

        return view('dashboard.car.index', compact('cars'));
    }
    public function show(car $car)
    {
        $this->authorize('viewAny', $car);
        return view('dashboard.car.show', compact('car'));
    }
    public function create()
    {
        $this->authorize('create', car::class);
        $locations = location::all();
        $car_categories = car_category::all();
        return view('dashboard.car.create', compact('car_categories', 'locations'));
    }
    public function store(StoreCarRequest $request)
    {
        $car = car::create($request->validated());
        if ($request->hasFile('image_url')) {
            $image = $request->file('image_url');
            $fileName = $car->id . "." . $image->extension();
            $image->storeAs('car_image/', $fileName, 'public');
            $car->update([
                'image_url' => $fileName,
            ]);
        }
        return redirect()->route('car.index')->with('success', __('cars created successfully'));
    }
    public function edit(car $car)
    {
        $this->authorize('update', $car);
        $locations = location::all();
        $car_categories = car_category::all();
        return view('dashboard.car.edit', compact('car', 'car_categories', 'locations'));
    }
    public function update(UpdateCarRequest $request, car $car)
    {
        $data = $request->validated();
        if ($request->hasFile('image_url')) {
            
            if ($car->image_url) {
                Storage::disk('public')->delete('car_image/' . $car->image_url);
            }
            $image = $request->file('image_url');
            $fileName = $car->id . "." . $image->extension();
            $image->storeAs('car_image/', $fileName, 'public');
            $data['image_url'] = $fileName;
        }

        $car->update($data);
        return redirect()->route('car.index')->with('success', __('car updated successfully'));
    }
    public function delete(car $car)
    {
        $this->authorize('delete', $car);
        if ($car->image_url) {
            Storage::disk('public')->delete('car_image/' . $car->image_url);
        }
        $car->delete();
        return redirect()->route('car.index')->with('success', __('car deleted successfully'));
    }
}
