<?php

namespace App\Http\Controllers;
use App\Models\Trajet;

use Illuminate\Http\Request;

class TrajetController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $trajet = Trajet::all();
        return response()->json([
            'success' => true,
            'message' => 'Liste des Trajets',
            'data' => $trajet
        ]);
    }


     /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $trajet = Trajet::find($id);
        if (!$trajet) {
            return response()->json([
                'success' => false,
                'message' => 'Trajet non trouvée',
                'data' => null
            ], 404);
        }
        return response()->json([
            'success' =>true,
            'message' => 'Trajet trouvée ',
            'data' => $trajet
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
         $validated = $request->validate([
            'ville_depart' => 'required|string|max:255',
            'ville_arrivee' => 'required|string|max:255',
            'heure_depart' => 'required|date_format:H:i',
            'heure_arrivee' => 'required|date_format:H:i|after:heure_depart',
            'date_depart' => 'required|date',
            'prix' => 'required|numeric|min:0',
            'statut' => 'required|string',
            'jour_semaine' => 'required|string'
        ]);

        $trajet = Trajet::create($validated);

        return response()->json([
            'success' => true,
            'message'=> 'Trajet cree avec succes',
            'data' => $trajet,
        ],201);
    }


    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
           $trajet = Trajet::find($id);
        if (!$trajet) {
            return response()->json([
                'success' => false,
                'message' => 'Trajet non trouvée',
                'data' => null
            ], 404);
        }

        $validated = $request->validate([
            'ville_depart' => 'sometimes|required|string|max:255',
            'ville_arrivee' => 'sometimes|required|string|max:255',
            'heure_depart' => 'sometimes|required|date_format:H:i',
            'heure_arrivee' => 'sometimes|required|date_format:H:i|after:heure_depart',
            'date_depart' => 'sometimes|required|date',
            'prix' => 'sometimes|required|numeric|min:0',
            'statut' => 'sometimes|required|string',
            'jour_semaine' => 'sometimes|required|string'
        ]);

        $trajet->update($validated);

        return response()->json([
            'success' => true,
            'message' => 'Trajet mise à jour avec succès',
            'data' => $trajet
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $trajet = Trajet::find($id);
        if (!$trajet) {
            return response()->json([
                'success' => false,
                'message' => 'Trajet non trouvée',
                'data' => null
            ], 404);
    }
      $trajet->delete();

        return response()->json([
            'success' => true,
            'message' => 'Trajet supprimée avec succès',
            'data' => null
        ]);
}

}
