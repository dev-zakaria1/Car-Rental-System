<?php

namespace App\Http\Controllers\admin;

use App\Http\Requests\locations\StoreLocationRequest;
use App\Http\Requests\locations\UpdateLocationRequest;
use App\Models\location;
use Illuminate\Http\RedirectResponse;
use App\Http\Controllers\Controller;

class LocationController extends Controller
{
    public function index()
    {
        $this->authorize('viewAny', location::class);

        $locations = location::paginate(10);

        return view('dashboard.location.index', ['locations' => $locations]);
    }

    public function create()
    {
        $this->authorize('create', location::class);

        return view('dashboard.location.create');
    }

    public function store(StoreLocationRequest $request): RedirectResponse
    {
        location::create($request->validated());
        return redirect()->route('location.index')
            ->with('success', __('location created successfully.'));
    }

    public function edit(location $location)
    {
        $this->authorize('update', $location);
        return view('dashboard.location.edit', compact('location'));
    }

    public function update(UpdateLocationRequest $request, Location $location): RedirectResponse
    {
        $location->update($request->validated());
        return redirect()->route('location.index')
            ->with('success', __('location updated successfully.'));
    }

    public function delete(location $location): RedirectResponse
    {
        $this->authorize('delete', $location);

        if ($location->car()->exists()) {
            return redirect()->route('location.index')
                ->with('error', __('Cannot delete this location because it has cars assigned. Remove or reassign the cars first.'));
        }
        if ($location->booking_pickup()->exists() || $location->booking_dropoff()->exists()) {
            return redirect()->route('location.index')
                ->with('error', __('Cannot delete this location because it has bookings assigned'));
        }
        
        $location->delete();

        return redirect()->route('location.index')
            ->with('success', __('location deleted successfully.'));
    }
}
