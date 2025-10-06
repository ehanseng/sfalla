<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\MenuItem;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class MenuItemController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $menuItems = MenuItem::orderBy('order')->get();
        return view('admin.menu_items.index', compact('menuItems'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.menu_items.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'url_slug' => 'required|string|max:255',
            'order' => 'nullable|integer',
        ]);

        $url = '/seccion/' . Str::slug($validated['url_slug']);

        MenuItem::create([
            'title' => $validated['title'],
            'url' => $url,
            'order' => $validated['order'] ?? 0,
        ]);

        $this->createCategoryFromMenuItem($validated['title'], $url);

        return redirect()->route('admin.menu-items.index')->with('success', 'Menu item created successfully.');
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
    public function edit(MenuItem $menuItem)
    {
        return view('admin.menu_items.edit', compact('menuItem'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, MenuItem $menuItem)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'url_slug' => 'required|string|max:255',
            'order' => 'nullable|integer',
        ]);

        $url = '/seccion/' . Str::slug($validated['url_slug']);

        $menuItem->update([
            'title' => $validated['title'],
            'url' => $url,
            'order' => $validated['order'] ?? 0,
        ]);

        $this->createCategoryFromMenuItem($validated['title'], $url);

        return redirect()->route('admin.menu-items.index')->with('success', 'Menu item updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(MenuItem $menuItem)
    {
        // Opcional: podrías querer eliminar también la categoría asociada aquí.
        // Por ahora, la dejaremos por si se reutiliza.
        $menuItem->delete();
        return redirect()->route('admin.menu-items.index')->with('success', 'Menu item deleted successfully.');
    }

    private function createCategoryFromMenuItem($title, $url)
    {
        // Comprueba si la URL sigue el patrón /seccion/{slug}
        if (Str::startsWith($url, '/seccion/')) {
            $slug = Str::after($url, '/seccion/');
            
            // Crea la categoría si no existe una con ese slug
            Category::firstOrCreate(
                ['slug' => $slug],
                [
                    'name' => $title,
                    'type' => 'post'
                ]
            );
        }
    }
}
