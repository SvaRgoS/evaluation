<?php

namespace Database\Seeders;

use App\Models\Contact;
use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call(
            [
                PermissionSeeder::class,
                RoleSeeder::class,
            ]
        );

        User::factory(13)->create();

        if (Contact::all()->count() === 0) {
            Contact::factory(13)->create();
        }

    }
}
