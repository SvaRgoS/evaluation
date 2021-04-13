<?php

namespace Database\Seeders;

use App\Contracts\UsersPermissions;
use App\Models\Permission;
use App\Models\Role;
use Illuminate\Database\Seeder;

class RoleSeeder extends Seeder
{
    const ROLE_READER = 1;
    const ROLE_WRITER = 2;
    const ROLE_REDACTOR = 3;

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        if ($this->rolesExist()) {
            return;
        }

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

    /**
     * @return bool
     */
    protected function rolesExist(): bool
    {
        return Role::whereName('Redactor')->exists();
    }
}
