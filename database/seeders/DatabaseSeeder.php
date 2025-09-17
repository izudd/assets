<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User testing dummy
        User::factory()->create([
            'name' => 'Test User',
            'email' => 'test@example.com',
            'role' => 'Guest', // kasih role Guest biar keliatan
            'password' => bcrypt('guest123'),
        ]);

        // Super Admin
        User::create([
            'name' => 'Super Admin',
            'email' => 'superadmin@gmail.com',
            'password' => bcrypt('superadmin123'),
            'role' => 'super admin',
        ]);

        // Validator (dulu Admin)
        User::create([
            'name' => 'Validator',
            'email' => 'validator@gmail.com',
            'password' => bcrypt('validator123'),
            'role' => 'validator',
        ]);

        // Verifikator (dulu Staf)
        User::create([
            'name' => 'Verifikator',
            'email' => 'verifikator@gmail.com',
            'password' => bcrypt('verifikator123'),
            'role' => 'verifikator',
        ]);

        // Guest (baru)
        User::create([
            'name' => 'Guest User',
            'email' => 'guest@gmail.com',
            'password' => bcrypt('guest123'),
            'role' => 'guest',
        ]);

        $this->call([
            KategoriSeeder::class,
        ]);
    }
}
