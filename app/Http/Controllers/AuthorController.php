<?php

namespace App\Http\Controllers;

use App\Http\Resources\AuthorResource;
use App\Http\Resources\BookResource;
use App\Models\Author;
use Illuminate\Http\Request;

class AuthorController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return AuthorResource::collection(Author::all());
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $author = Author::create($request->only('name', 'country_id', 'email'));

        if ($request->has('books')) {
            $author->books()->attach($request->books);
        }

        return AuthorResource::make($author);
    }

    /**
     * Display the specified resource.
     */
    public function show(Author $author)
    {
        return AuthorResource::make($author);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Author $author)
    {
        $author->update($request->all());
        return AuthorResource::make($author);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Author $author)
    {
      $author->delete();
      return response()->noContent();
    }

    public function showBooks(Author $author) {

        return BookResource::collection($author->books);
    }
}
