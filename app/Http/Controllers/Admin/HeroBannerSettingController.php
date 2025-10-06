<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\HeroBanner;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Laravel\Facades\Image;

class HeroBannerSettingController extends Controller
{
    public function edit()
    {
        $banner = HeroBanner::firstOrCreate([]); // Get the first record, or create it if it doesn't exist
        return view('admin.hero_banner.edit', compact('banner'));
    }

    public function update(Request $request)
    {
        $banner = HeroBanner::firstOrCreate([]);

        $validated = $request->validate([
            'title' => 'nullable|string|max:255',
            'subtitle' => 'nullable|string|max:255',
            'hero_image' => 'nullable|image|max:4096',
            'height' => 'required|integer|min:10|max:100',
        ]);

        $banner->title = $validated['title'] ?? null;
        $banner->subtitle = $validated['subtitle'] ?? null;
        $banner->height = $validated['height'];

        if ($request->hasFile('hero_image')) {
            if ($banner->image_url) {
                Storage::disk('public')->delete($banner->image_url);
            }
            
            // Optimize and store the image
            $image = Image::read($request->file('hero_image'));
            $image->scaleDown(width: 1920); // Resize to a max width of 1920px
            $encoded = $image->toJpeg(80); // Encode to JPEG with 80% quality

            $filename = uniqid() . '.jpg';
            $path = 'site/' . $filename;
            Storage::disk('public')->put($path, (string) $encoded);

            $banner->image_url = $path;
        }

        $banner->save();

        return redirect()->back()->with('success', 'Hero banner updated successfully.');
    }
}
