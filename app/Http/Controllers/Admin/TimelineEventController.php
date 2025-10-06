<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\TimelineEvent;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class TimelineEventController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $events = TimelineEvent::with('category')->latest('event_date')->get();
        return view('admin.timeline_events.index', compact('events'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories = Category::where('type', 'timeline')->get();
        return view('admin.timeline_events.create', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'event_date' => 'required|date',
            'category_id' => 'required|exists:categories,id',
            'cover_image' => 'required|image|mimes:jpeg,png,jpg,JPG,gif,svg|max:20480', // Increased to 20MB
        ]);

        $path = $request->file('cover_image')->store('timeline', 'public');
        $validated['cover_image_url'] = $path;

        TimelineEvent::create($validated);

        return redirect()->route('admin.timeline-events.index')->with('success', 'Timeline event created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(TimelineEvent $timelineEvent)
    {
        $categories = Category::where('type', 'timeline')->get();
        return view('admin.timeline_events.edit', compact('timelineEvent', 'categories'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, TimelineEvent $timelineEvent)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'event_date' => 'required|date',
            'category_id' => 'required|exists:categories,id',
            'cover_image' => 'nullable|image|mimes:jpeg,png,jpg,JPG,gif,svg|max:20480', // Increased to 20MB
        ]);

        if ($request->hasFile('cover_image')) {
            if ($timelineEvent->cover_image_url) {
                Storage::disk('public')->delete($timelineEvent->cover_image_url);
            }
            $path = $request->file('cover_image')->store('timeline', 'public');
            $validated['cover_image_url'] = $path;
        }

        $timelineEvent->update($validated);

        return redirect()->route('admin.timeline-events.index')->with('success', 'Timeline event updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(TimelineEvent $timelineEvent)
    {
        if ($timelineEvent->cover_image_url) {
            Storage::disk('public')->delete($timelineEvent->cover_image_url);
        }

        $timelineEvent->delete();

        return redirect()->route('admin.timeline-events.index')->with('success', 'Timeline event deleted successfully.');
    }
}
