<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Arret extends Model
{
    use HasFactory;
    use SoftDeletes;
    

    protected $primarykey = 'arret_id';
    
    protected $fillable = [
        'nom_ville',
        'adresse',
        'statut'];

    public function trajets()
    {
        return $this->belongsToMany(Trajet::class, 'arret_trajet')
        ->withPivot('ordre')
        ->withTimestamps();
    }


}
