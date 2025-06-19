<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CheckMenuAccess
{
    public function handle(Request $request, Closure $next): Response
    {
        $user = $request->user();

        // Skip jika belum login
        if (!$user) {
            return $next($request);
        }

        $routeName = $request->route()->getName();

        // Skip jika route tidak ada nama
        if (!$routeName) {
            return $next($request);
        }

        // Get semua menu dari config
        $menus = config('menu', []);

        // Cari menu berdasarkan route name (termasuk children)
        $menuFound = $this->findMenuByRoute($menus, $routeName);

        if ($menuFound && isset($menuFound['roles']) && !empty($menuFound['roles'])) {
            if (!$user->hasAnyRole($menuFound['roles'])) {
                abort(403, 'Anda tidak memiliki akses ke halaman ini.');
            }
        }

        return $next($request);
    }

    /**
     * Cari menu berdasarkan route name (recursive untuk children)
     */
    private function findMenuByRoute($menus, $routeName)
    {
        foreach ($menus as $menu) {
            // Cek menu utama
            if (isset($menu['route']) && $menu['route'] === $routeName) {
                return $menu;
            }

            // Cek children jika ada
            if (!empty($menu['children'])) {
                $childMenu = $this->findMenuByRoute($menu['children'], $routeName);
                if ($childMenu) {
                    return $childMenu;
                }
            }
        }

        return null;
    }
}
