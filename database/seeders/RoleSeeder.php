<?php

namespace Database\Seeders;

use App\Contracts\UsersPermissions;
use App\Models\Permission;
use App\Models\Role;
use Illuminate\Database\Seeder;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $roles = [
            'Reader' => [
                PermissionSeeder::PERMISSION_READ_ID,
            ],
            'Writer' => [
                PermissionSeeder::PERMISSION_READ_ID,
                PermissionSeeder::PERMISSION_WRITE_ID,
            ],
            'Redactor' => [
                PermissionSeeder::PERMISSION_READ_ID,
                PermissionSeeder::PERMISSION_WRITE_ID,
                PermissionSeeder::PERMISSION_REMOVE_ID,
            ],
        ];

        foreach ($roles as $role => $permission) {
            $model = Role::create([
                'name' => $role
            ]);
            $model->permissions()->sync($permission);
        }
    }
}
