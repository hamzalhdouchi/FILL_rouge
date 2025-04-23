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
        'restaurant_id',
        'table_number'
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

