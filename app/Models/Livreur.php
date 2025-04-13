<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Livreur extends Model
{
    use HasFactory;

    protected $table = 'livreur'; 

    protected $fillable = [
        'nom_utilisateur',
        'prenom',
        'email',
        'password',
        'role_id',
        'vehicule',
        'zone',
    ];

    
}
