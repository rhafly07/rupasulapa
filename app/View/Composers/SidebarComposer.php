<?php
// app/View/Composers/SidebarComposer.php

namespace App\View\Composers;

use Illuminate\View\View;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Config;

class SidebarComposer
{
    public function compose(View $view)
    {
        $menu = Config::get('menu', []);
        $user = Auth::user();

        // Filter menu berdasarkan role
        $filteredMenu = collect($menu)->filter(function ($item) use ($user) {
            // Jika tidak ada roles, tampilkan ke semua user
            if (!isset($item['roles'])) return true;

            // Cek role user
            return $user && $user->hasAnyRole($item['roles']);
        })->map(function ($item) use ($user) {
            // Filter children jika ada
            if (!empty($item['children'])) {
                $item['children'] = collect($item['children'])->filter(function ($child) use ($user) {
                    return !isset($child['roles']) || $user->hasAnyRole($child['roles']);
                })->values()->all();
            }
            return $item;
        })->values()->all();

        $view->with('menu', $filteredMenu);
    }
}
