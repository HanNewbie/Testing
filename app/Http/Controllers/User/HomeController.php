<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Content;
use App\Models\News;
use App\Models\Event;

class HomeController extends Controller
{
    public function index()
    {
        $news = News::all();
        $contents = Content::all();
        return view('welcome', compact('contents','news'));
    }

    public function event()
    {
        $contents = Content::all();
        return view('user.event', compact('contents'));
    }

    public function booking($slug)
    {
        $events = Event::with('content')
            ->orderBy('start_date')
            ->get()
            ->groupBy(function ($event) {
                // Kelompokkan berdasarkan bulan (format: Januari, Februari, dst.)
                return \Carbon\Carbon::parse($event->start_date)->translatedFormat('F');
            });

        return view('user.booking', compact('events', 'slug'));
    }

    public function bookingDetail($slug, $bulan)
    {
        $events = Event::with('content')
            ->whereMonth('start_date', \Carbon\Carbon::parse($bulan)->month)
            ->orderBy('start_date')
            ->get();

        return view('user.booking_detail', compact('slug', 'bulan', 'events'));
    }

    public function content(){

        $contents = Content::all();
        return view('user.wisata', compact('contents'));
    }

    public function contentDetail($slug){

        $contents = Content::where('slug', $slug)->firstOrFail();
        return view('user.wisata_detail', compact('contents','slug'));
    }

    public function history(){

        return view('user.history');
    }

    // public function __construct()
    // {
    //     $this->middleware('auth');
    // }

    public function profile(){
        $user = Auth::user();

        return view('user.account.profile', compact('user'));
    }
}
