<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Arret;
use App\Models\Trajet;

class ArretTrajetController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    /*// Associer un ou plusieurs arrêts à un trajet*/
        public function store(Request $request)
    {

        $validated = $request->validate([
            'trajet_id' => 'required|exists:trajets,id',
            'arrets' => 'required|array|min:1',
            'arrets.*.id' => 'required|exists:arrets,id',
            'arrets.*.ordre' => 'required|integer|min:1'
        ]);

        $trajet = Trajet::findOrFail($validated['trajet_id']);

        $syncData = [];
        foreach ($validated['arrets'] as $arret) {
            $syncData[$arret['id']] = ['ordre' => $arret['ordre']];
        }

        $trajet->arrets()->sync($syncData); // remplace les anciennes associations

        return response()->json([
            'success' => true,
            'message' => 'Les arrêts ont été associés au trajet avec succès',
            'data' => $trajet->arrets()->withPivot('ordre')->get()
        ]);

    }

    /**
     * Display the specified resource.
     *     // Afficher les arrêts d’un trajet donné avec leur ordre
     */
     public function show($trajet_id)
    {
        $trajet = Trajet::with(['arrets' => function ($query) {
            $query->orderBy('pivot.ordre');
        }])->find($trajet_id);

        if (!$trajet) {
            return response()->json([
                'success' => false,
                'message' => 'Trajet non trouvé',
                'data' => null
            ], 404);
        }

        return response()->json([
            'success' => true,
            'message' => 'Liste des arrêts du trajet récupérée avec succès',
            'data' => $trajet->arrets
        ]);
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
     public function detach(Request $request)
    {
        $validated = $request->validate([
            'trajet_id' => 'required|exists:trajets,id',
            'arret_id' => 'required|exists:arrets,id'
        ]);

        $trajet = Trajet::findOrFail($validated['trajet_id']);
        $trajet->arrets()->detach($validated['arret_id']);

        return response()->json([
            'success' => true,
            'message' => 'Arrêt détaché du trajet avec succès',
            'data' => null
        ]);
    }
}
