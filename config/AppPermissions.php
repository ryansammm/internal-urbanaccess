<?php

namespace Config;

class AppPermissions
{
    protected $permissions = [
        [
            'menu' => 'Dashboard',
            'aliasPermission' => 'dashboard',
            'url' => '/dashboard'
        ],
        [
            'menu' => 'Fasilitas Teleconference',
            'aliasPermission' => 'fasilitas-teleconference',
            'url' => '/teleconference'
        ],
        [
            'menu' => 'Fasilitas Ruangan',
            'aliasPermission' => 'fasilitas-ruangan',
            'url' => '/fasilitasruangan'
        ],
        [
            'menu' => 'Fasilitas Teleconference dan Ruangan',
            'aliasPermission' => 'fasilitas-teleconference-dan-ruangan',
            'url' => '/teleconference-ruangan'
        ],
        [
            'menu' => 'Tindak Lanjuti Pengajuan',
            'aliasPermission' => 'tindak-lanjuti-pengajuan',
            'url' => '/tindaklanjut'
        ],
        [
            'menu' => 'Rekap',
            'aliasPermission' => 'rekap',
            'url' => '/rekap'
        ],
        [
            'menu' => 'Akun Zoom',
            'aliasPermission' => 'akun-zoom',
            'url' => '/akunzoom'
        ],
        [
            'menu' => 'Allotment Ruangan',
            'aliasPermission' => 'allotment-ruangan',
            'url' => '/ruangan'
        ],
        [
            'menu' => 'User Management',
            'aliasPermission' => 'user-management',
            'url' => '/usermanagement'
        ],
        [
            'menu' => 'User Roles',
            'aliasPermission' => 'user-roles',
            'url' => '/roles'
        ],
        [
            'menu' => 'User Permissions',
            'aliasPermission' => 'user-permissions',
            'url' => '/permissions'
        ],
    ];
}
