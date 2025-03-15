<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Restaurant extends Model
{
    use HasFactory;

    protected $fillable = [
        'nomRestaurant', 'adresse', 'telephone', 'notation', 'statut', 'zoneLivraison'
    ];

    public function User()
    {
        return $this->belongsTo(User::class);
    }
}
