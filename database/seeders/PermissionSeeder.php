<?php

namespace Database\Seeders;

use App\Contracts\UsersPermissions;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PermissionSeeder extends Seeder
{
    const PERMISSION_READ_ID=1;
    const PERMISSION_WRITE_ID=2;
    const PERMISSION_REMOVE_ID=3;
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $permissions = [
            [
                'id' => self::PERMISSION_READ_ID,
                'name' => UsersPermissions::READ
            ],
            [
                'id' => self::PERMISSION_WRITE_ID,
                'name' => UsersPermissions::WRITE
            ],
            [
                'id' => self::PERMISSION_REMOVE_ID,
                'name' => UsersPermissions::REMOVE
            ],
        ];
        DB::table('permissions')->insert($permissions);
    }
}
