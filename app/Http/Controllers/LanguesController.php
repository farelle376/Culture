<?php

namespace App\Http\Controllers;

use App\Models\Langue;
use Illuminate\Http\Request;

class LanguesController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $langues=Langue::all();
        return view('langues.index', compact('langues'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('langues.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        Langue::create($request->all());
        return redirect()->route('langues.index');
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
{
    $langues = Langue::with('contenus', 'region')->findOrFail($id);
    return view('langues.show', compact('langues'));
}

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $langues= Langue::findOrFail($id); // récupère les données

    return view('langues.edit', compact('langues'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $langues = Langue::findOrFail($id);

    $langues->update([
        'code_langue' => $request->code_langue,
        'nom_langue' => $request->nom_langue,
        'description'=>$request->description,
    ]);

    return redirect()->route('langues.index')->with('success', 'Commentaire modifié avec succès');

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $langues = Langue::findOrFail($id);

    $langues->delete();

    return redirect()->route('langues.index')->with('success', 'Commentaire supprimé avec succès.');

    }
}
