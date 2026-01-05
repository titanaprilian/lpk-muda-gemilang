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
                "route" => "admin.registrants.index",
                "active_route" => "admin.registrants.*",
            ],
            [
                "title" => "Export Laporan",
                "icon" => "fas fa-file-pdf",
                "route" => "admin.export-reports.index",
                "active_route" => "admin.export-reports.*",
            ],
        ],
    ],

    [
        "title" => "Konten Website",
        "menus" => [
            [
                "title" => "Galeri Kegiatan",
                "icon" => "fas fa-images",
                "route" => "admin.galleries.index",
                "active_route" => "admin.galleries.*",
            ],
            [
                "title" => "Daftar Program",
                "icon" => "fas fa-chalkboard-teacher",
                "route" => "admin.programs.index",
                "active_route" => "admin.programs.*",
            ],
        ],
    ],

    [
        "title" => "Sistem",
        "menus" => [
            [
                "title" => "Pengaturan",
                "icon" => "fas fa-cog",
                "route" => "admin.settings.index",
                "active_route" => "admin.settings.*",
            ],
        ],
    ],
];
