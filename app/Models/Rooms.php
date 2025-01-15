<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Rooms extends Model
{
    use HasFactory;

    protected $fillable = [
        'hotel_id',
        'room_code',
        'room_type',
        'price_per_night',
        'capacity',
        'facilities',
        'status',
        'image',
    ];

    protected static function boot() {
    parent::boot();
    static::creating(function ($room) {
        $room->room_code = 'ROOM' . strtoupper(uniqid());
    });
    }
}
