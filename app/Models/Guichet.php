<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Guichet extends Model
{
    use HasFactory;
    use SoftDeletes;

    

    protected $fillable = [

        'numero',
        'nom',
        'statut',
        'filiale_id'];

    public function filiale()
    {
        return $this->belongsTo(Filiale::class, 'filiale_id');
    }
}
