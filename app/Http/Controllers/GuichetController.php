<?php

namespace App\Http\Controllers;
use App\Models\Guichet;

use Illuminate\Http\Request;

class GuichetController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
         $guichet = Guichet::all();
        return response()->json([
            'success' => true,
            'message' => 'Liste des Guichets',
            'data' => $guichet
        ]);
    }

    public function show(string $id)
    {
        $guichet = Guichet::find($id);
        if (!$guichet) {
            return response()->json([
                'success' => false,
                'message' => 'Guichet non trouvée',
                'data' => null
            ], 404);
        }
        return response()->json([
            'success' =>true,
            'message' => 'Guichet trouvée ',
            'data' => $guichet
        ]);
    }


    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'numero' => 'required|string|max:50',
            'nom' => 'required|string|max:255',
            'statut' => 'required|string',
            'filiale_id' => 'required|exists:filiales,id'
        ]);

        $guichet = Guichet::create($validated);

        return response()->json([
            'success' => true,
            'message'=> 'Guichet cree avec succes',
            'data' => $guichet,
        ],201);
    }


    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
         $guichet = Guichet::find($id);
        if (!$guichet) {
            return response()->json([
                'success' => false,
                'message' => 'Guichet non trouvée',
                'data' => null
            ], 404);
        }

        $validated = $request->validate([
            'numero' => 'sometimes|required|string|max:50',
            'nom' => 'sometimes|required|string|max:255',
            'statut' => 'sometimes|required|string',
            'filiale_id' => 'sometimes|required|exists:filiales,id'
        ]);

        $guichet->update($validated);

        return response()->json([
            'success' => true,
            'message' => 'Guichet mise à jour avec succès',
            'data' => $guichet
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $guichet = Guichet::find($id);
        if (!$guichet) {
            return response()->json([
                'success' => false,
                'message' => 'Guichet non trouvée',
                'data' => null
            ], 404);
    }
      $guichet->delete();

        return response()->json([
            'success' => true,
            'message' => 'Guichet supprimée avec succès',
            'data' => null
        ]);
}

}
