<?php

namespace Config;

use Config\AppPermissions;

class RolePermissions
{
    protected $role_permissions = [
        [
            'idRole' => 'admin-010',
            'namaRole' => 'Admin',
            'aliasRole' => 'admin',
            'permission' => ['*']
        ],
        [
            'idRole' => 'mitra-010',
            'namaRole' => 'Mitra',
            'aliasRole' => 'mitra',
            'permission' => ['dashboard', '']
        ]
    ];

    public function __construct() {

    }
}
