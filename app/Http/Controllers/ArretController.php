<?php

namespace App\Http\Controllers;

use APP\Models\Arret;

use Illuminate\Http\Request;

class ArretController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
          $arret = Arret::all();
        return response()->json([
            'success' => true,
            'message' => 'Liste des Arrets',
            'data' => $arret
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
         $validated = $request->validate([
            'nom_ville' => 'required|string|max:255',
            'adresse' => 'required|string|max:255',
            'statut' => 'required|string|in:actif,inactif'
        ]);

        $arret = Arret::create($validated);

        return response()->json([
            'success' => true,
            'message' => 'Arrêt créé avec succès',
            'data' => $arret
        ], 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
         $arret = Arret::find($id);

        if (!$arret) {
            return response()->json([
                'success' => false,
                'message' => 'Arrêt non trouvé',
                'data' => null
            ], 404);
        }

        return response()->json([
            'success' => true,
            'message' => 'Arrêt trouvé',
            'data' => $arret
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
          $arret = Arret::find($id);

        if (!$arret) {
            return response()->json([
                'success' => false,
                'message' => 'Arrêt non trouvé',
                'data' => null
            ], 404);
        }

        $validated = $request->validate([
            'nom_ville' => 'sometimes|required|string|max:255',
            'adresse' => 'sometimes|required|string|max:255',
            'statut' => 'sometimes|required|string|in:actif,inactif'
        ]);

        $arret->update($validated);

        return response()->json([
            'success' => true,
            'message' => 'Arrêt mis à jour avec succès',
            'data' => $arret
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $arret = Arret::find($id);

        if (!$arret) {
            return response()->json([
                'success' => false,
                'message' => 'Arrêt non trouvé',
                'data' => null
            ], 404);
        }

        $arret->delete();

        return response()->json([
            'success' => true,
            'message' => 'Arrêt supprimé avec succès',
            'data' => null
        ]);
    
    }
}
