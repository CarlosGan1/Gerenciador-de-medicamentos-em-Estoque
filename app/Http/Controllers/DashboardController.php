<?php

namespace App\Http\Controllers;

use App\Models\Medication;
use App\Models\User;

class DashboardController extends Controller
{
    public function index()
{
    $data = [
        'total_medications' => Medication::count(),
        'total_users'        => User::count(),
        'total_medications_in' => Medication::sum('quantity'),
        'medications_out_of_stock' => Medication::where('quantity',0)->count(),
    ];

    
    return view('dashboard.dashboard', compact('data'));
    }
}
