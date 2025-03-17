<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Table extends Model
{
    use HasFactory;

    protected $fillable = [
        'numeroDeTable',
        'qrCode',
        'capacite',
        'statut',
    ];

    public function reservations()
    {
        return $this->hasMany(Reservation::class, 'idTable');
    }
}
