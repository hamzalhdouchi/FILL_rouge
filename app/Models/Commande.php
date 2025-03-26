<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Commande extends Model
{
    use HasFactory;
    
    protected $fillable=[
        'statut',
        'quantite',
        'instructions',
        'prixTotal',
        'cleint_id',
        'livreur_id',
        'restaurant_id'
    ];
    public function plat()
    {
        return $this->belongsToMany(Plat::class);
    }

    

    public function paiement()
    {
        return $this->hasOne(Paiement::class);
    }
}

