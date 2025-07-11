<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Filiale extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $primaryKey = 'filiale_id';

    protected $fillable = [
        'nom', 
        'ville', 
        'adresse', 
        'telephone',
        'email', 
        'logo', 
        'agence_id'
    ];

    public function agence()
    {
        return $this->belongsTo(Agence::class, 'agence_id');
    }

    public function guichets()
    {
        return $this->hasMany(Guichet::class, 'filiale_id');
    }
    
     public function buses(){
        return $this->hasMany(buses::class, 'filiale_id');
    }

     public function voyages()
    {
        return $this->hasMany(Voyage::class);
    }
}
