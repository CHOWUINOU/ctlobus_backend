<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Paiement extends Model
{
    use HasFactory;
    use SoftDeletes;

     protected $primaryKey = 'paiement_id';

    protected $fillable = [
        'methode',
        'statut',
        'reference_paie',
        'date_paiement',
        'reservation_id'
    ];

    public function reservation()
    {
        return $this->belongsTo(Reservation::class, 'reservation_id');
    }
}
