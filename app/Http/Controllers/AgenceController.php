<?php

namespace App\Http\Controllers;

use App\Models\Agence;
use Illuminate\Http\Request;

class AgenceController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $agences = Agence::all();
        return response()->json([
            'success' => true,
            'message' => 'Liste des agences',
            'data' => $agences
        ]);
    }


    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $agence = Agence::find($id);
        if (!$agence) {
            return response()->json([
                'success' => false,
                'message' => 'Agence non trouvée',
                'data' => null
            ], 404);
        }
        return response()->json([
            'success' => true,
            'message' => 'Agence trouvée ',
            'data' => $agence
        ]);
    }
    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'nom' => 'required|string|max:255',
            'ville' => 'required|string|max:255',
            'adresse' => 'required|string',
            'telephone' => 'nullable|string',
            'statut' => 'nullable|string',
            'abonnement_debut' => 'nullable|date',
            'abonnement_fin' => 'nullable|date|after_or_equal:abonnement_debut',
            'horaire_ouverture' => 'nullable|string',
        ]);

        $agence = Agence::create($validated);

        return response()->json([
            'success' => true,
            'message' => 'Agence cree avec succes',
            'data' => $agence,
        ], 201);
    }



    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $agence = Agence::find($id);
        if (!$agence) {
            return response()->json([
                'success' => false,
                'message' => 'Agence non trouvée',
                'data' => null
            ], 404);
        }

        $validated = $request->validate([
            'nom' => 'sometimes|required|string|max:255',
            'ville' => 'sometimes|required|string|max:255',
            'adresse' => 'sometimes|required|string',
            'telephone' => 'nullable|string',
            'statut' => 'nullable|string',
            'abonnement_debut' => 'nullable|date',
            'abonnement_fin' => 'nullable|date|after_or_equal:abonnement_debut',
            'horaire_ouverture' => 'nullable|string',
        ]);

        $agence->update($validated);

        return response()->json([
            'success' => true,
            'message' => 'Agence mise à jour avec succès',
            'data' => $agence
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $agence = Agence::find($id);
        if (!$agence) {
            return response()->json([
                'success' => false,
                'message' => 'Agence non trouvée',
                'data' => null
            ], 404);
        }
        $agence->delete();

        return response()->json([
            'success' => true,
            'message' => 'Agence supprimée avec succès',
            'data' => null
        ]);
    }
}
