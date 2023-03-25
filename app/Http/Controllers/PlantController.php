<?php

namespace App\Http\Controllers;

use App\Models\Plant;
use App\Http\Controllers\Controller;
use App\Http\Requests\StorePlantRequest;
use App\Http\Requests\UpdatePlantRequest;

class PlantController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $plants = Plant::with('category')->get();
        return response()->json($plants);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StorePlantRequest $request)
    {
        //
        $this->authorize('create', Plant::class);
        $validated = $request->validated();
        $plant = Plant::create($validated);
        return response()->json([
            'message' => 'Plant created successfully',
            'plant' => $plant
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show(Plant $plant)
    {
        //

        $plant = Plant::with('category')->find($plant->id);
        return response()->json($plant);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Plant $plant)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdatePlantRequest $request, Plant $plant)
    {
        //
        $this->authorize('update', $plant);
        $validated = $request->validated();
        $plant->update($validated);
        return response()->json([
            'message' => 'Plant updated successfully',
            'plant' => $plant
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Plant $plant)
    {
        //
        $this->authorize('delete', $plant);
        $plant->delete();
        return response()->json([
            'message' => 'Plant deleted successfully',
            'plant' => $plant
        ]);
    }
}
