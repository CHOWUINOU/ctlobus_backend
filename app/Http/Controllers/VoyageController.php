<?php

namespace App\Http\Controllers;

use App\Models\Voyage;

use Illuminate\Http\Request;

class VoyageController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $voyage = Voyage::with('bus.filiale', 'trajet', 'chauffeur')->get();
        return response()->json([
            'success' => true,
            'message' => 'Liste des Voyages',
            'data' => $voyage
        ]);
    }

     /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
         $voyage = Voyage::with('bus,filiale', 'trajet', 'chauffeur')->find($id);
        if (!$voyage) {
            return response()->json([
                'success' => false,
                'message' => 'Voyage non trouvée',
                'data' => null
            ], 404);
        }
        return response()->json([
            'success' =>true,
            'message' => 'Voyage trouvée ',
            'data' => $voyage
        ]);
    }
    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

        $validated = $request->validate([
            'date_voyage' => 'required|date',
            'heure_depart' => 'required|date_format:H:i',
            'heure_arrivee' => 'required|date_format:H:i|after:heure_depart',
            'statut' => 'required|string',
            'place_disponible' => 'required|integer|min:0',
            'bus_id' => 'required|exists:buses,id',
            'trajet_id' => 'required|exists:trajets,id',
            'chauffeur_id' => 'required|exists:users,id'
        ]);

        $voyage = Voyage::create($validated);

        return response()->json([
            'success' => true,
            'message'=> 'Voyage cree avec succes',
            'data' => $voyage,
        ],201);
    }



    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
         $voyage = Voyage::find($id);
        if (!$voyage) {
            return response()->json([
                'success' => false,
                'message' => 'Voyage non trouvée',
                'data' => null
            ], 404);
        }

        $validated = $request->validate([
            'date_voyage' => 'sometimes|required|date',
            'heure_depart' => 'sometimes|required|date_format:H:i',
            'heure_arrivee' => 'sometimes|required|date_format:H:i|after:heure_depart',
            'statut' => 'sometimes|required|string',
            'place_disponible' => 'sometimes|required|integer|min:0',
            'bus_id' => 'sometimes|required|exists:buses,id',
            'trajet_id' => 'sometimes|required|exists:trajets,id',
            'chauffeur_id' => 'sometimes|required|exists:users,id'
        ]);

        $voyage->update($validated);

        return response()->json([
            'success' => true,
            'message' => 'Voyage mise à jour avec succès',
            'data' => $voyage
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
         $voyage = Voyage::find($id);
        if (!$voyage) {
            return response()->json([
                'success' => false,
                'message' => 'Voyage non trouvée',
                'data' => null
            ], 404);
    }
      $voyage->delete();

        return response()->json([
            'success' => true,
            'message' => 'Voyage supprimée avec succès',
            'data' => null
        ]);
}

}
