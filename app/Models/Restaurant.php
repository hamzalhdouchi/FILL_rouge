<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Restaurant extends Model
{
    use HasFactory;

    protected $fillable = [
        'nom_Restaurant', 'adresse', 'telephone', 'notation', 'statut', 'zone_Livraison', 'user_create_id'
    ];

    public function User()
    {
        return $this->belongsTo(User::class, 'user_create_id');
    }

    public function Menu()
    {
        return $this->hasMany(Menu::class, 'restaurant_id');
    }

    public function Table()
    {
        return $this->hasMany(Table::class);
    }
}
