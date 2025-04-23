<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Reservation extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'email',
        'phone',
        'date',
        'time',
        'guests',
        'special_requests',
        'preorder_check',
        'restaurant_id',
        'user_id'
    ];


    public function table()
    {
        return $this->belongsTo(Table::class, 'idTable');
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
