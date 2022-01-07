<?php

    return[

        'dashboard' => [
            'title' => 'Dashboard',
            'icon' => 'far fa-circle nav-icon',
            'route' => '/dashboard',
        ],

        'categories' => [
            'title' => 'Categories',
            'icon' => 'far fa-circle nav-icon',
            'route' => '/categories',
        ],

        'products' => [
            'title' => 'Products',
            'icon' => 'far fa-circle nav-icon',
            'route' => '/products',
        ],

        'orders' => [
            'title' => 'Orders',
            'icon' => 'far fa-circle nav-icon',
            'route' => '/orders',
            'badge' => [
                'label' => 'New',
                'class' => 'danger'
            ]
        ],

        'settings' => [
            'title' => 'Settings',
            'icon' => 'far fa-circle nav-icon',
            'route' => '/settings',
        ],
    ];
