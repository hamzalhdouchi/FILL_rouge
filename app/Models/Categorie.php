<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Categorie extends Model
{
    use HasFactory;

    protected $fillable = [
        'nom_categorie',
        'description',
        'order'
    ];

    public function menu()
    {
        return $this->belongsToMany(Menu::class,'categoriemenu','id_menu','id_categorie');
    }
}
