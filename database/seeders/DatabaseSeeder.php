<?php

namespace Database\Seeders;

use App\Models\Service;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        Service::query()->delete();
        User::query()->delete();

        Service::create(['name' => 'Classic Cut', 'description' => 'Potongan klasik yang bersih dan timeless.', 'duration_minutes' => 30, 'price' => 45000]);
        Service::create(['name' => 'Skin Fade', 'description' => 'Fade presisi dengan transisi halus.', 'duration_minutes' => 45, 'price' => 65000]);
        Service::create(['name' => 'Beard Sculpt', 'description' => 'Rapikan dan bentuk janggut sesuai wajah.', 'duration_minutes' => 30, 'price' => 35000]);

        User::create(['name' => 'Admin TrimHaus', 'email' => 'admin@trimhaus.test', 'password' => Hash::make('password'), 'role' => 'admin']);
        User::create(['name' => 'Kasir TrimHaus', 'email' => 'kasir@trimhaus.test', 'password' => Hash::make('password'), 'role' => 'cashier']);
        User::create(['name' => 'Pelanggan Demo', 'email' => 'pelanggan@trimhaus.test', 'password' => Hash::make('password'), 'role' => 'customer']);
    }
}
