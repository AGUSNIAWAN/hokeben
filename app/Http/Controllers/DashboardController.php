<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $vouchersGiven = \App\Models\Voucher::where('status', 'diberikan')->count();
        $vouchersUsed = \App\Models\Voucher::where('status', 'digunakan')->count();
        $recentActivities = \App\Models\Activity::latest()->take(5)->get();

        return view('dashboard', compact('vouchersGiven', 'vouchersUsed', 'recentActivities'));
    }
}
