<?php

namespace App\Http\Controllers;

class MenuController extends Controller
{
    public function showHomePage()
    {
        return view('home');
    }

    public function showAdminDashboard(){
        return view('admin/dashboard');
    }
}