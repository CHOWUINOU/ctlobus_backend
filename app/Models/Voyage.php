<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Voyage extends Model
{
    use HasFactory;
    use SoftDeletes;



     protected $fillable = [
        'date_voyage',
        'heure_depart',
        'heure_arrivee',
        'statut',
        'place_disponible',
        'bus_id',
        'trajet_id'
    ];

    public function bus()
    {
        return $this->belongsTo(Bus::class, 'bus_id');
    }

    public function filiale()
    {
        return $this->belongsTo(Filiale::class,'filiale_id');
    }

    public function trajet()
    {
        return $this->belongsTo(Trajet::class, 'trajet_id');
    }

    public function reservations()
    {
        return $this->hasMany(Reservation::class, 'voyage_id');
    }
}
