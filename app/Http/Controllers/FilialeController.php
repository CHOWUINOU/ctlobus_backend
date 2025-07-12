<?php

namespace App\Http\Controllers;

use App\Models\Filiale;
use Illuminate\Http\Request;

class FilialeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $filiales = Filiale::all();
        return response()->json([
            'success' => true,
            'message' => 'Liste des filiales',
            'data' => $filiales
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
         $filiale = Filiale::find($id);
        if (!$filiale) {
            return response()->json([
                'success' => false,
                'message' => 'filiale non trouvée',
                'data' => null
            ], 404);
        }
        return response()->json([
            'success' =>true,
            'message' => 'filiale trouvée ',
            'data' => $filiale
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
            'telephone' => 'required|string',
            'email' => 'required|email',
            'logo' => 'required|string',
            'agence_id' => 'required|exists:agences,id'
        ]);

        $filiale = Filiale::create($validated);

        return response()->json([
            'success' => true,
            'message'=> 'Filiale cree avec succes',
            'data' => $filiale,
        ],201);
    }


    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
         $filiale = Filiale::find($id);
        if (!$filiale) {
            return response()->json([
                'success' => false,
                'message' => 'filiale non trouvée',
                'data' => null
            ], 404);
        }

        $validated = $request->validate([
           'nom' => 'sometimes|required|string|max:255',
            'ville' => 'sometimes|required|string|max:255',
            'adresse' => 'sometimes|required|string',
            'telephone' => 'sometimes|required|string',
            'email' => 'sometimes|required|email',
            'logo' => 'sometimes|required|string',
            'agence_id' => 'sometimes|required|exists:agences,id'
        ]);

        $filiale->update($validated);

        return response()->json([
            'success' => true,
            'message' => 'Filiale mise à jour avec succès',
            'data' => $filiale
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
         $filiale = Filiale::find($id);
        if (!$filiale) {
            return response()->json([
                'success' => false,
                'message' => 'Filiale non trouvée',
                'data' => null
            ], 404);
    }
      $filiale->delete();

        return response()->json([
            'success' => true,
            'message' => 'Filiale supprimée avec succès',
            'data' => null
        ]);
}

}
