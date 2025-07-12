<?php

namespace App\Http\Controllers;

use App\Models\Bus;

use Illuminate\Http\Request;

class BusController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $bus = Bus::all();
        return response()->json([
            'success' => true,
            'message' => 'Liste des bus',
            'data' => $bus
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {

        $bus = Bus::find($id);
        if (!$bus) {
            return response()->json([
                'success' => false,
                'message' => 'Bus non trouvée',
                'data' => null
            ], 404);
        }
        return response()->json([
            'success' =>true,
            'message' => 'Bus trouvée ',
            'data' => $bus
        ]);
    }


    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
         $validated = $request->validate([
            'immatriculation' => 'required|string|max:255|unique:buses,immatriculation',
            'marque' => 'required|string|max:255',
            'statut' => 'required|string',
            'nbre_places' => 'required|integer|min:1',
            'filiale_id' => 'required|exists:filiales,id'
        ]);

        $bus = Bus::create($validated);

        return response()->json([
            'success' => true,
            'message'=> 'Bus cree avec succes',
            'data' => $bus,
        ],201);
    }


    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
         $bus = Bus::find($id);
        if (!$bus) {
            return response()->json([
                'success' => false,
                'message' => 'Bus non trouvée',
                'data' => null
            ], 404);
        }

        $validated = $request->validate([
            'immatriculation' => 'sometimes|required|string|max:255|unique:buses,immatriculation',
            'marque' => 'sometimes|required|string|max:255',
            'statut' => 'sometimes|required|string',
            'nbre_places' => 'sometimes|required|integer|min:1',
            'filiale_id' => 'sometimes|required|exists:filiales,id'
        ]);

        $bus->update($validated);

        return response()->json([
            'success' => true,
            'message' => 'Bus mise à jour avec succès',
            'data' => $bus
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
          $bus = Bus::find($id);
        if (!$bus) {
            return response()->json([
                'success' => false,
                'message' => 'Bus non trouvée',
                'data' => null
            ], 404);
    }
      $bus->delete();

        return response()->json([
            'success' => true,
            'message' => 'Bus supprimée avec succès',
            'data' => null
        ]);
}

}
