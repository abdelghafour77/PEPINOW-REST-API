<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreCategoryRequest;
use App\Http\Requests\UpdateCategoryRequest;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function __construct()
    {
        $this->middleware('auth:api');
    }
    public function index()
    {
        // get all categories
        $this->authorize('viewAny', Category::class);
        $categories = Category::with('plants')->get();
        return response()->json($categories);

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
    public function store(StoreCategoryRequest $request)
    {
        // authorize the user
        $this->authorize('viewAny', Category::class);
        // validate the name using the StoreCategoryRequest
        $validated = $request->validated();
        // create a new category
        $category = Category::create($validated);
        // return the new category
        return response()->json([
            'message' => 'Category created successfully',
            'category' => $category
        ]);

    }

    /**
     * Display the specified resource.
     */
    public function show(Category $category)
    {
        //
        $this->authorize('viewAny', Category::class);
        $category = Category::with('plants')->findOrFail($category->id);
        if (!$category) {
            # code...
            return response()->json([
                'message' => 'Category not found'
            ]);
        }
        return response()->json($category);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Category $category)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateCategoryRequest $request, Category $category)
    {
        //
        $this->authorize('viewAny', Category::class);

        $validated = $request->validated();
        $category->update($validated);
        return response()->json([
            'message' => 'Category updated successfully',
            'category' => $category
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Category $category)
    {
        //
        $this->authorize('viewAny', Category::class);
        $category = Category::findOrFail($category->id);
        if (!$category) {
            # code...
            return response()->json([
                'message' => 'Category not found'
            ]);
        }
        $category->delete();
        return response()->json([
            'message' => 'Category deleted successfully'
        ]);
    }
}
