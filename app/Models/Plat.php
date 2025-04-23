<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Plat extends Model
{
    use HasFactory;

    protected $fillable=[
        'image',
        'desciption',
        'temps_Preparation',
        'prix',
        'nom_plat',
        'categorie_id',
        'menu_id',
    ];


    public function categorie()
    {
        return $this->belongsTo(Categorie::class);
    }

    public function commande()
    {
        return $this->belongsToMany(Commande::class);
    }

    public function ingrediant()
    {
        return $this->belongsToMany(Ingredient::class,'ingredient_plate');
    }

    public function Menu()
    {
        return $this->belongsTo(Menu::class);
    }

}
