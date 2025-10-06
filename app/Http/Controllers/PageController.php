<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\HeroBanner;
use App\Models\Setting;
use App\Models\TimelineEvent;
use Illuminate\Http\Request;

class PageController extends Controller
{
    /**
     * Display the home page.
     */
    public function home()
    {
        $events = TimelineEvent::with('category')->orderBy('event_date', 'desc')->get();
        $categories = Category::where('type', 'timeline')->get();
        $banner = HeroBanner::first();
        
        return view('home', compact('events', 'categories', 'banner'));
    }
}
