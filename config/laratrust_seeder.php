<?php

return [
    /**
     * Control if the seeder should create a user per role while seeding the data.
     */
    'create_users'    => true,

    /**
     * Control if all the laratrust tables should be truncated before running the seeder.
     */
    'truncate_tables' => false,

    'roles_structure' => [
        'admin' => [
            'admin dashboard' => '',
            'access'          => '',
            'user'            => 'c,r,u,d',
            'role'            => 'c,r,u,d',
            'permission'      => 'c,r,u,d',
        ],
        'user'  => [
            'user profile' => '',
        ],
    ],

    'permissions_map' => [
        'c' => 'create',
        'r' => 'read',
        'u' => 'update',
        'd' => 'delete',
    ],
];
