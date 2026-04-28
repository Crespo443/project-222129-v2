<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Review extends Model
{
    use HasFactory;

    protected $table = 'reviews';

    protected $fillable = [
        'car_id',
        'user_id',
        'rating',
        'comment',
        'status'
    ];

    protected $casts = [
        'rating' => 'integer'
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

    // Scopes
    public function scopeApproved($query)
    {
        return $query->where('status', 'disetujui');
    }

    public function scopePending($query)
    {
        return $query->where('status', 'menunggu');
    }
}
