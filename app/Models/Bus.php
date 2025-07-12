<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Bus extends Model
{
    use HasFactory;
    use SoftDeletes;


    protected $fillable = [
        'immatriculation',
        'marque',
        'statut',
        'nbre_places',
        'agence_id'];

    public function filiale()
    {
        return $this->belongsTo(Filiale::class,'filiale_id');
    }

    public function voyages()
    {
        return $this->hasMany(Voyage::class, 'bus_id');
    }
}
