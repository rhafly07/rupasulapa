<?php

return [
    [
        'icon' => 'house',
        'menu' => 'Dashboard',
        'children' => [],
        'route' => 'dashboard',
        // Tanpa roles = semua user bisa akses
    ],
    [
        'icon' => 'warehouse',
        'menu' => 'Inventaris',
        'route' => 'inventaris.index',
        'children' => [],
        'roles' => ['admin', 'superadmin', 'staff'],
    ],
    [
        'icon' => 'cart-shopping',
        'menu' => 'Pesanan',
        'route' => 'pesanan.index',
        'children' => [],
        'roles' => ['admin', 'superadmin', 'staff'],
    ],
    [
        'icon' => 'users',
        'menu' => 'Pelanggan',
        'route' => 'pelanggan.index',
        'children' => [],
        'roles' => ['admin', 'superadmin'],
    ],
    [
        'icon' => 'shield-halved',
        'menu' => 'User Management',
        'roles' => ['admin', 'superadmin'],
        'children' => [
            [
                'menu' => 'Users',
                // 'route' => 'users.index',
                'roles' => ['admin', 'superadmin'],
            ],
            [
                'menu' => 'Roles',
                // 'route' => 'roles.index',
                'roles' => ['superadmin'],
            ],
            [
                'menu' => 'Permissions',
                // 'route' => 'permissions.index',
                'roles' => ['superadmin'],
            ],
        ],
    ],
    [
        'icon' => 'gears',
        'menu' => 'Pengaturan',
        'roles' => ['admin', 'superadmin'],
        'children' => [
            [
                'menu' => 'Profil rental',
                // 'route' => 'settings.profile',
                'roles' => ['admin', 'superadmin'],
            ],
            [
                'menu' => 'Staf',
                // 'route' => 'settings.staff',
                'roles' => ['admin', 'superadmin'],
            ],
            [
                'menu' => 'Laporan',
                // 'route' => 'settings.reports',
                'roles' => ['admin', 'superadmin'],
            ],
        ],
    ],
];
