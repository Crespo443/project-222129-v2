<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class Car extends Model
{
    use HasFactory;

    protected $table = 'cars';

    protected $fillable = [
        'brand',
        'model',
        'police_number',
        'engine',
        'price_per_day',
        'image',
        'status',
        'reduce',
        'stars',
        'transmission',
        'fuel_type',
        'seats',
        'doors',
        'category',
        'features',
        'color',
        'year',
        'description',
        'images',
        'gallery_images',
        'mileage',
        'available_for_long_term',
        'minimum_rental_days'
    ];

    protected $casts = [
        'features' => 'array',
        'images' => 'array',
        'gallery_images' => 'array',
        'price_per_day' => 'decimal:2',
        'reduce' => 'decimal:2',
        'stars' => 'decimal:1',
        'available_for_long_term' => 'boolean',
        'seats' => 'integer',
        'doors' => 'integer',
        'year' => 'integer',
        'mileage' => 'integer',
        'minimum_rental_days' => 'integer'
    ];

    // Relationships
    public function reviews()
    {
        return $this->hasMany(Review::class);
    }

    public function reservations()
    {
        return $this->hasMany(Reservation::class);
    }

    // Scopes
    public function scopeAvailable($query)
    {
        return $query->where('status', 'tersedia');
    }

    public function scopeSearch($query, $search)
    {
        return $query->where(function ($q) use ($search) {
            $q->where('brand', 'like', "%{$search}%")
                ->orWhere('model', 'like', "%{$search}%")
                ->orWhere('category', 'like', "%{$search}%")
                ->orWhere('transmission', 'like', "%{$search}%")
                ->orWhere('fuel_type', 'like', "%{$search}%");
        });
    }

    // Accessors
    public function getFormattedPriceAttribute()
    {
        return 'Rp ' . number_format($this->price_per_day, 0, ',', '.');
    }

    public function getDiscountedPriceAttribute()
    {
        if ($this->reduce > 0) {
            return $this->price_per_day - ($this->price_per_day * ($this->reduce / 100));
        }
        return $this->price_per_day;
    }

    public function getFormattedDiscountedPriceAttribute()
    {
        return 'Rp ' . number_format($this->discounted_price, 0, ',', '.');
    }

    public function getImageUrlAttribute()
    {
        $image = $this->attributes['image'] ?? null;
        $fallback = asset('storage/images/cars/6aMEt9Ds8c5hX9HYGCiQyTTK0sbX9qRF3lnzvYan.jpg');

        if (empty($image)) {
            return $fallback;
        }

        if (Str::startsWith($image, ['http://', 'https://'])) {
            return $image;
        }

        $storageRelativePath = ltrim(preg_replace('#^/storage/#', '', $image), '/');

        if ($storageRelativePath !== '' && Storage::disk('public')->exists($storageRelativePath)) {
            return asset('storage/' . $storageRelativePath);
        }

        return $fallback;
    }

    // Get transmission in Indonesian
    public function getTransmissionIndonesianAttribute()
    {
        $translations = [
            'manual' => 'Manual',
            'automatic' => 'Otomatis',
            'semi-automatic' => 'Semi-Otomatis'
        ];

        return $translations[$this->transmission] ?? ucfirst($this->transmission);
    }

    // Get fuel type in Indonesian
    public function getFuelTypeIndonesianAttribute()
    {
        $translations = [
            'bensin' => 'Bensin',
            'diesel' => 'Solar',
            'elektrik' => 'Listrik',
            'hybrid' => 'Hybrid'
        ];

        return $translations[$this->fuel_type] ?? ucfirst($this->fuel_type);
    }
}
