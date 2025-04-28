<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Categorie extends Model
{
    use HasFactory;

    protected $fillable = [
        'mon_categorie',
        'description',
        'menu_id'
    ];

    public function menu()
    {
        return $this->belongsTo(Menu::class,'categoriemenu','id_menu','id_categorie');
    }

    public function plat()
    {
        return $this->hasMany(Plat::class);
    }
}
