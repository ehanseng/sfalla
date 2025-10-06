<?php

namespace App\Http\View\Composers;

use App\Models\MenuItem;
use Illuminate\View\View;

class NavigationComposer
{
    public function compose(View $view)
    {
        $menuItems = MenuItem::orderBy('order')->get();
        $view->with('menuItems', $menuItems);
    }
}
