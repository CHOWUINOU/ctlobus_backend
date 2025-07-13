<?php

namespace App\Http\Controllers;

use App\Models\Paiement;
use Illuminate\Http\Request;

class PaiementController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $paiement = Paiement::with('reservation')->get();

        return response()->json([
            'success' => true,
            'message' => 'Liste des paiements récupérée avec succès',
            'data' => $paiement
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
         $validated = $request->validate([
            'methode' => 'required|string|max:255', // ex: "mobile money", "espèce"
            'statut' => 'required|string|in:effectue,annulé,en_attente',
            'reference_paie' => 'required|string|max:255|unique:paiements,reference_paie',
            'date_paiement' => 'required|date',
            'reservation_id' => 'required|exists:reservations,id'
        ]);

        $paiement = Paiement::create($validated);

        return response()->json([
            'success' => true,
            'message' => 'Paiement enregistré avec succès',
            'data' => $paiement
        ], 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
         $paiement = Paiement::with('reservation')->find($id);

        if (!$paiement) {
            return response()->json([
                'success' => false,
                'message' => 'Paiement non trouvé',
                'data' => null
            ], 404);
        }

        return response()->json([
            'success' => true,
            'message' => 'Paiement trouvé',
            'data' => $paiement
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
         $paiement = Paiement::find($id);

        if (!$paiement) {
            return response()->json([
                'success' => false,
                'message' => 'Paiement non trouvé',
                'data' => null
            ], 404);
        }

        $validated = $request->validate([
            'methode' => 'sometimes|required|string|max:255',
            'statut' => 'sometimes|required|string|in:effectue,annulé,en_attente',
            'reference_paie' => 'sometimes|required|string|max:255|unique:paiements,reference_paie,' . $id,
            'date_paiement' => 'sometimes|required|date',
            'reservation_id' => 'sometimes|required|exists:reservations,id'
        ]);

        $paiement->update($validated);

        return response()->json([
            'success' => true,
            'message' => 'Paiement mis à jour avec succès',
            'data' => $paiement
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
         $paiement = Paiement::find($id);

        if (!$paiement) {
            return response()->json([
                'success' => false,
                'message' => 'Paiement non trouvé',
                'data' => null
            ], 404);
        }

        $paiement->delete();

        return response()->json([
            'success' => true,
            'message' => 'Paiement supprimé avec succès',
            'data' => null
        ]);

    }
}
