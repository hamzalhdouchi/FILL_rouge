<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ingredient extends Model
{
    use HasFactory;

    protected $fillable = [
        'nom_ingredient',  
        'stock',
        'unite_mesure',
        'plate_id'
    ];

    public function plate()
    {
        return $this->belongsToMany(Plat::class, 'ingredient_plate');
    }
}
