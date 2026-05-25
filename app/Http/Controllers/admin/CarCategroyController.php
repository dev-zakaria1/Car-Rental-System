<?php

namespace App\Http\Controllers\admin;

use App\Http\Requests\categories\StoreCategoryRequest;
use App\Http\Requests\categories\UpdateCategoryRequest;
use App\Models\car_category;
use App\Http\Controllers\Controller;

class CarCategroyController extends Controller
{
    public function index()
    {
        $this->authorize('viewAny', car_category::class);
        $categroies = car_category::paginate(10);
        return view('dashboard.category.index', compact('categroies'));
    }
    public function create()
    {
        $this->authorize('create', car_category::class);
        return view('dashboard.category.create');
    }
    public function store(StoreCategoryRequest $request)
    {

        car_category::create($request->validated());
        return redirect()->route('category.index')->with('success', __('category created successfully.'));
    }
    public function update(UpdateCategoryRequest $request, car_category $carCategory)
    {
        $carCategory->update($request->validated());
        return redirect()->route('category.index')->with('success', __('location updated successfully.'));
    }
    public function edit(car_category $carCategory)
    {
        $this->authorize('update', $carCategory);
        return view('dashboard.category.edit', compact('carCategory'));
    }
    public function delete(car_category $car_category)
    {
        $this->authorize('delete', $car_category);
        if ($car_category->car()->exists()) {
            return redirect()
                ->route('category.index')
                ->with('error', __('Cannot delete this category because it has cars assigned. Remove or reassign the cars first.'));
        }
        $car_category->delete();
        return redirect()->route('category.index')->with('success', __('category deleted successfully'));
    }
}
