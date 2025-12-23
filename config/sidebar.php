<?php

return [
    /*
    |--------------------------------------------------------------------------
    | Admin Sidebar Configuration
    |--------------------------------------------------------------------------
    |
    | Here you can define the sidebar menu structure.
    |
    */

    [
        "title" => "Utama",
        "menus" => [
            [
                "title" => "Dashboard",
                "icon" => "fas fa-home",
                "route" => "admin.dashboard",
                "active_route" => "admin.dashboard", // Used to highlight the link
            ],
        ],
    ],

    [
        "title" => "Manajemen Pendaftaran",
        "menus" => [
            [
                "title" => "Data Pendaftar",
                "icon" => "fas fa-user-graduate",
                "route" => "admin.dashboard", // Change this to 'admin.applicants.index' later
                "active_route" => "admin.applicants.*",
                // 'badge' => 12, // Example of a static badge (Dynamic badges need ViewComposers)
            ],
            [
                "title" => "Export Laporan",
                "icon" => "fas fa-file-pdf",
                "route" => "admin.dashboard", // Change later
                "active_route" => "admin.export.*",
            ],
        ],
    ],

    [
        "title" => "Konten Website",
        "menus" => [
            [
                "title" => "Galeri Kegiatan",
                "icon" => "fas fa-images",
                "route" => "admin.dashboard", // Change later
                "active_route" => "admin.gallery.*",
            ],
        ],
    ],

    [
        "title" => "Sistem",
        "menus" => [
            [
                "title" => "Pengaturan",
                "icon" => "fas fa-cog",
                "route" => "admin.dashboard", // Change later
                "active_route" => "admin.settings.*",
            ],
        ],
    ],
];
