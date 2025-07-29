<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use App\Models\Submission;
use App\Models\User;
use App\Models\Activity;
use App\Models\Admin;

class DashboardController extends Controller
{
    public function index()
    {
        $userCount = User::count();
        $activities = Activity::with('admin')->latest()->take(5)->get();

        // Ambil 5 hari terakhir (termasuk hari ini)
        $dates = collect(range(0, 4))->map(function ($i) {
            return \Carbon\Carbon::now()->subDays($i)->format('d M');
        })->reverse()->values();

        // Hitung jumlah submission untuk setiap tanggal
        $counts = $dates->map(function ($date) {
            return Submission::whereDate('created_at', \Carbon\Carbon::createFromFormat('d M', $date))->count();
        });

        return view('admin.dashboard', compact('userCount', 'activities', 'dates', 'counts'));
    }


}
