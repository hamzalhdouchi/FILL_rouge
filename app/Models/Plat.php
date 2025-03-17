<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Plat extends Model
{
    use HasFactory;

    protected $fillable=[
        'image',
        'temps_Preparation',
        'prix',
        'desciption',
        'nom_plat',

    ];


    public function categorie()
    {
        return $this->belongsTo(Categorie::class);
    }

    public function commande()
    {
        return $this->belongsTo(Commande::class);
    }

}
