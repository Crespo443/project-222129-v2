<?php

namespace App\Http\Controllers;

use App\Models\Car;
use App\Models\Reservation;
use App\Models\Review;
use Illuminate\Support\Facades\DB;

class MenuController extends Controller
{
    public function showHomePage()
    {
        // Get 3 featured cars with discount
        $featuredCars = Car::where('reduce', '>', 0, 'and')
            ->orderBy('reduce', 'desc')
            ->take(3)
            ->get();

        // If less than 3 cars with discount, fill with other available cars
        if ($featuredCars->count() < 3) {
            $remaining = Car::where('reduce', '=', 0, 'and')
                ->orderBy('stars', 'desc')
                ->take(3 - $featuredCars->count())
                ->get();
            $featuredCars = $featuredCars->merge($remaining);
        }

        return view('home', compact('featuredCars'));
    }

    public function showAdminDashboard()
    {
        return view('admin/dashboard');
    }
}
