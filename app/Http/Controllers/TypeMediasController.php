<?php

namespace App\Http\Controllers;

use App\Models\Type_media;
use Illuminate\Http\Request;

class TypeMediasController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
{
    $search = $request->input('search');

    $typeMedias = Type_media::when($search, function($query, $search) {
        return $query->where('nom', 'LIKE', "%{$search}%");
                     
    })->get();

    return view('typeMedias.index', compact('typeMedias'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
         return view('typeMedias.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
         Type_media::create($request->all());
        return redirect()->route('typeMedias.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
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
}
