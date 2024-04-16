<?php

namespace App\Http\Controllers;

use App\Http\Resources\BookResource;
use App\Http\Resources\CategoryResource;
use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //return Category::all();
        return CategoryResource::collection(Category::all());
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $category= new Category();
        if (!$request->has('name'))
        {
            return response()->json(['error' => 'Name is required'], 422);
        }

        $result = Category::where('name', $request->name)->first();
        if ($result)
        {
            return response()->json(['error' => 'Name has already been taken.'], 422);
        }

        $category->name = $request->name;
        $category->save();

        return new CategoryResource($category);
    }

    /**
     * Display the specified resource.
     */
    public function show(Category $category)
    {
        //return $category;
        return new CategoryResource($category);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Category $category)
    {
        if (!$request->has('name'))
        {
            return response()->json(['error' => 'Name is required'], 422);
        }
        $category->name = $request->name;
        $category->save();
        return new CategoryResource($category);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Category $category)
    {
        $category->delete();
        return response()->noContent();
    }

    public function showBooks(Category $category)
    {
        //return $category->books;
        return BookResource::collection($category->books);
    }

}
