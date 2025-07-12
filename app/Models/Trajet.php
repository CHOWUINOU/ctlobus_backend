<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Trajet extends Model
{
    use HasFactory;
    use SoftDeletes;




    protected $fillable = [
        'ville_depart',
        'ville_arrivee',
        'heure_depart',
        'heure_arrivee',
        'date_depart',
        'prix',
        'statut',
        'jour_semaine'
    ];

    public function voyages()
    {
        return $this->hasMany(Voyage::class, 'trajet_id');
    }

    public function arrets()
    {
        return $this->belongsToMany(Arret::class, 'arret_trajet')
        ->withPivot('ordre')
        ->withTimestamps();
    }
}
