<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Reservation extends Model
{
    use HasFactory;
    use SoftDeletes;



    protected $fillable = [
        'numero_place',
        'prix_payer',
        'statut',
        'type_reservation',
        'date_reservation',
        'date_expiration',
        'user_id',
        'voyage_id'
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function voyage()
    {
        return $this->belongsTo(Voyage::class, 'voyage_id');
    }

    public function paiement()
    {
        return $this->hasOne(Paiement::class, 'reservation_id');
    }

    public function guichet()
    {
        return $this->belongsTo(Guichet::class);
    }


}
