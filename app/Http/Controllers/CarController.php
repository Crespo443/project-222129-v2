<?php

namespace App\Http\Controllers;

use App\Models\Car;
use App\Models\Review;
use App\Models\Reservation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class CarController extends Controller
{
    // ========== USER SIDE ==========

    /**
     * Tampilkan daftar mobil untuk user
     */
    public function index(Request $request)
    {
        $query = Car::query();

        // Filter berdasarkan pencarian
        if ($request->has('search') && $request->search != '') {
            $query->search($request->search);
        }

        // Filter berdasarkan kategori
        if ($request->has('category') && $request->category != '') {
            $query->where('category', $request->category);
        }

        // Filter berdasarkan transmisi
        if ($request->has('transmission') && $request->transmission != '') {
            $query->where('transmission', $request->transmission);
        }

        // Filter berdasarkan harga
        if ($request->has('max_price') && $request->max_price != '') {
            $query->where('price_per_day', '<=', $request->max_price);
        }

        // Urutkan
        $sortBy = $request->get('sort', 'brand');
        $sortOrder = $request->get('order', 'asc');
        $query->orderBy($sortBy, $sortOrder);

        $cars = $query->paginate(12);

        return view('cars', compact('cars'));
    }

    /**
     * Pencarian mobil dengan filter lengkap
     */
    public function search(Request $request)
    {
        $query = Car::query();

        // Filter berdasarkan merek (brand)
        if ($request->filled('brand')) {
            $query->where('brand', 'like', '%' . $request->brand . '%');
        }

        // Filter berdasarkan model
        if ($request->filled('model')) {
            $query->where('model', 'like', '%' . $request->model . '%');
        }

        // Filter berdasarkan kategori
        if ($request->filled('category')) {
            $query->where('category', $request->category);
        }

        // Filter berdasarkan transmisi
        if ($request->filled('transmission')) {
            $query->where('transmission', $request->transmission);
        }

        // Filter berdasarkan jenis bahan bakar
        if ($request->filled('fuel_type')) {
            $query->where('fuel_type', $request->fuel_type);
        }

        // Filter berdasarkan jumlah kursi minimum
        if ($request->filled('seats')) {
            $query->where('seats', '>=', $request->seats);
        }

        // Filter berdasarkan harga minimum
        if ($request->filled('min_price')) {
            $query->where('price_per_day', '>=', $request->min_price);
        }

        // Filter berdasarkan harga maksimum
        if ($request->filled('max_price')) {
            $query->where('price_per_day', '<=', $request->max_price);
        }

        // Urutkan berdasarkan brand secara default
        $query->orderBy('brand', 'asc')->orderBy('model', 'asc');

        $cars = $query->paginate(12)->appends($request->all());

        return view('cars', compact('cars'));
    }

    /**
     * Tampilkan detail mobil
     */
    public function show($id)
    {
        // $car = Car::with(['reviews' => function ($query) {
        //     $query->approved()->latest();
        // }])->findOrFail($id);

        $car = Car::findOrFail($id);

        // Get related cars (same category, different car)
        $relatedCars = Car::where('category', '=', $car->getAttribute('category'), 'and')
            ->where('id', '!=', $car->getAttribute('id'), 'and')
            ->where('status', '=', 'tersedia', 'and')
            ->orderBy('stars', 'desc')
            ->take(4)
            ->get();

        // If not enough related cars in same category, fill with other available cars
        if ($relatedCars->count() < 4) {
            $additionalCars = Car::where('id', '!=', $car->getAttribute('id'), 'and')
                ->where('status', '=', 'tersedia', 'and')
                ->whereNotIn('id', $relatedCars->pluck('id'))
                ->orderBy('stars', 'desc')
                ->take(4 - $relatedCars->count())
                ->get();

            $relatedCars = $relatedCars->merge($additionalCars);
        }

        return view('detailsCar', compact('car', 'relatedCars'));
    }

    /**
     * Tampilkan form reservasi
     */
    public function showReservationForm($id)
    {
        
    }

    /**
     * Proses reservasi mobil
     */
    public function processReservation(Request $request, $id)
    {
    }

    /**
     * Submit review untuk mobil
     */
    public function submitReview(Request $request)
    {
    }

    
}