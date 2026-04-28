<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Reservation extends Model
{
    use HasFactory;

    protected $table = 'reservations';

    protected $fillable = [
        'car_id',
        'user_id',
        'start_date',
        'end_date',
        'total_days',
        'total_price',
        'status',
        'payment_status',
        'notes'
    ];

    protected $casts = [
        'start_date' => 'date',
        'end_date' => 'date',
        'total_days' => 'integer',
        'total_price' => 'decimal:2'
    ];

    // Relationships
    public function car()
    {
        return $this->belongsTo(Car::class);
    }

    public function user()
    {
        return $this->belongsTo(data_user_model::class, 'user_id');
    }

    // Accessors
    public function getFormattedTotalPriceAttribute()
    {
        return 'Rp ' . number_format($this->total_price, 0, ',', '.');
    }
}
