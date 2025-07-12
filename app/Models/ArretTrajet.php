<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ArretTrajet extends Model
{
    use HasFactory;
    use SoftDeletes;


    protected $fillable = ['trajet_id', 'arret_id', 'ordre'];
}
