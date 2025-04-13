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
        'restaurant_id'
    ];

    public function reservations()
    {
        return $this->hasMany(Reservation::class, 'idTable');
    }

    public function restaurant()
    {
        return $this->belongsTo(Restaurant::class, 'restaurant_id');
    }
}
