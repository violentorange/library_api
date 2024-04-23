<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreReaderRequest;
use App\Http\Requests\UpdateBookRequest;
use App\Http\Requests\UpdateReaderRequest;
use App\Http\Resources\BookResource;
use App\Http\Resources\ReaderResource;
use App\Models\Reader;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Date;

class ReaderController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return ReaderResource::collection(Reader::all());
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreReaderRequest $request)
    {
        $reader = Reader::create($request->all());
        return ReaderResource::make($reader);
    }

    /**
     * Display the specified resource.
     */
    public function show(Reader $reader)
    {
        return ReaderResource::make($reader);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateReaderRequest $request, Reader $reader)
    {
        $reader->update($request->all());
        return ReaderResource::make($reader);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Reader $reader)
    {
        $reader->delete();
        return response()->noContent();
    }

    public function showBooks(Reader $reader)
    {
        $books = $reader->books;
        return BookResource::collection($books);
    }

    public function checkoutBooks(Request $request, Reader $reader)
    {
        $reader->books()->attach($request->books,[
            'start_date' => Date::now(),
            'end_date' => Date::now()->addDays(21),
        ]);
        return $reader->books;
    }

}
