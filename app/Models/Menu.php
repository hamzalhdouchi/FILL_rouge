<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Menu extends Model
{
    use HasFactory;

    protected $fillable = [
        'name_Menu',
        'isActif',
    ];

    public function Restaurant()
    {
        return $this->belongsTo(Restaurant::class, 'restaurant_id');
    }

    public function categorie()
    {
        return $this->belongsToMany(Categorie::class,'catehoriemenu','id_categorie','id_menu');
    }

    public function Plate()
    {
        return $this->hasMany(Plat::class);
    }
}
