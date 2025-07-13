<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use APP\Models\Reservation;
class ReservationController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
         $reservation = Reservation::with('user', 'voyage.trajet', 'paiement', 'guichet')->get();

        return response()->json([
            'success' => true,
            'message' => 'Liste des réservations récupérée avec succès',
            'data' => $reservation
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $reservation = Reservation::with('user', 'voyage.trajet', 'paiement', 'guichet')->find($id);

        if (!$reservation) {
            return response()->json([
                'success' => false,
                'message' => 'Réservation non trouvée',
                'data' => null
            ], 404);
        }

        return response()->json([
            'success' => true,
            'message' => 'Réservation trouvée',
            'data' => $reservation
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
         $validated = $request->validate([
            'numero_place' => 'required|string|max:50',
            'prix_payer' => 'required|numeric|min:0',
            'statut' => 'required|in:valide,en_attente,annulée',
            'type_reservation' => 'required|string|in:en ligne,sur place',
            'date_reservation' => 'required|date',
            'date_expiration' => 'required|date|after_or_equal:date_reservation',
            'client_id' => 'required|exists:users,id',
            'voyage_id' => 'required|exists:voyages,id',
            'guichet_id' => 'required_if:type_reservation,sur place|nullable|exists:guichets,id'
        ]);

        $reservation = Reservation::create($validated);

        return response()->json([
            'success' => true,
            'message' => 'Réservation créée avec succès',
            'data' => $reservation
        ], 201);
    }



    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $reservation = Reservation::find($id);

        if (!$reservation) {
            return response()->json([
                'success' => false,
                'message' => 'Réservation non trouvée',
                'data' => null
            ], 404);
        }

        $validated = $request->validate([
            'numero_place' => 'sometimes|required|string|max:50',
            'prix_payer' => 'sometimes|required|numeric|min:0',
            'statut' => 'sometimes|required|string',
            'type_reservation' => 'sometimes|required|string|in:en ligne,sur place',
            'date_reservation' => 'sometimes|required|date',
            'date_expiration' => 'sometimes|required|date|after_or_equal:date_reservation',
            'client_id' => 'sometimes|required|exists:users,id',
            'voyage_id' => 'sometimes|required|exists:voyages,id',
            'guichet_id' => 'required_if:type_reservation,sur place|nullable|exists:guichets,id'
        ]);

        $reservation->update($validated);

        return response()->json([
            'success' => true,
            'message' => 'Réservation mise à jour avec succès',
            'data' => $reservation
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $reservation = Reservation::find($id);

        if (!$reservation) {
            return response()->json([
                'success' => false,
                'message' => 'Réservation non trouvée',
                'data' => null
            ], 404);
        }

        $reservation->delete();

        return response()->json([
            'success' => true,
            'message' => 'Réservation supprimée avec succès',
            'data' => null
        ]);
    }

}
