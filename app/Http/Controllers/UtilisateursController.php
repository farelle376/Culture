<?php

namespace App\Http\Controllers;

use App\Models\utilisateur;
use Illuminate\Http\Request;

class UtilisateursController extends Controller
{
    /**
     * Display a listing of the resource.
     */

 public function index()
    {
        $utilisateurs=Utilisateur::all();
        return view('utilisateurs.index', compact('utilisateurs'));
    }


    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
         return view('utilisateurs.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
        'nom' => 'required',
        'prenom' => 'required',
        'email' => 'required|email',
        'sexe'=>'required',
        'date_naissance'=>'required',
        'id_langue' => 'required|exists:langue,id',
    ]);

        Utilisateur::create($request->all());
        return view('users', compact('utilisateurs'));
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
         $utilisateurs= Utilisateur::findOrFail($id); // récupère les données

    return view('utilisateurs.show', compact('utilisateurs'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $utilisateurs= Utilisateur::findOrFail($id); // récupère les données

    return view('utilisateurs.edit', compact('utilisateurs'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $utilisateurs = Utilisateur::findOrFail($id);

    $utilisateurs->update([
        'nom' => $request->nom,
        'prenom' => $request->prenom,
        'password' => $request->password,
        'email' => $request->email,
        ''=>$request->description,
    ]);

    return redirect()->route('langues.index')->with('success', 'Commentaire modifié avec succès');

    
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
