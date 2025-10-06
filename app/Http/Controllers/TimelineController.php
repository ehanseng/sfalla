<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\TimelineEvent;
use Illuminate\Http\Request;

class TimelineController extends Controller
{
    public function index()
    {
        $events = TimelineEvent::with('category')->orderBy('event_date', 'desc')->get();
        $categories = Category::has('timelineEvents')->get();
        return view('biografia', compact('events', 'categories'));
    }
}
