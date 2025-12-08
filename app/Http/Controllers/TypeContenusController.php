<?php

namespace App\Http\Controllers;

use App\Models\Contenu;
use App\Models\Type_contenu;
use App\Models\TypeContenu;
use Illuminate\Http\Request;

class TypeContenusController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
{
    $search = $request->input('search');

    $typeContenus = Type_contenu::when($search, function($query, $search) {
        return $query->where('nom', 'LIKE', "%{$search}%");
                     
    })->get();

    return view('typeContenus.index', compact('typeContenus'));
    }
    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
         return view('typeContenus.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        Type_contenu::create($request->all());
        return redirect()->route('typeContenus.index');
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
