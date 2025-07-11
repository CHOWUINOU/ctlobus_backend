<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Agence extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $primarykey = 'agence_id';
    protected $fillable = [
            'nom',
            'ville',
            'adresse',
            'telephone',
            'statut',
            'abonnement_debut',
            'abonnement_fin',
            'horaire_ouverture',


    ];
    /*plusieurs filiales */

    public function filiales(){
        return $this->hasMany(filiales::class, 'agence_id');
    }
    /*plusieurs bus */

    public function Users(){
        return $this->hasMany(Users::class,'agence_id');
    }
}
