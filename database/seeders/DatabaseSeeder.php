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

        Service::create(['name' => 'Fast Hair Cut', 'description' => 'Potongan rambut cepat dan rapi.', 'duration_minutes' => 30, 'price' => 25000]);
        Service::create(['name' => 'Rileks Ganteng', 'description' => 'Perawatan rambut dan styling santai.', 'duration_minutes' => 45, 'price' => 35000]);
        Service::create(['name' => 'Full Grooming', 'description' => 'Paket grooming lengkap untuk tampilan terbaik.', 'duration_minutes' => 60, 'price' => 50000]);
        Service::create(['name' => 'Make Up Only', 'description' => 'Makeup dasar untuk tampilan natural.', 'duration_minutes' => 60, 'price' => 250000]);
        Service::create(['name' => 'Make Up + Soft Lens', 'description' => 'Makeup dengan tambahan soft lens.', 'duration_minutes' => 75, 'price' => 300000]);
        Service::create(['name' => 'Make Up + Hair Do', 'description' => 'Makeup dan penataan rambut.', 'duration_minutes' => 90, 'price' => 320000]);

        User::create(['name' => 'Admin TrimHaus', 'email' => 'admin@trimhaus.test', 'password' => Hash::make('password'), 'role' => 'admin']);
        User::create(['name' => 'Kasir TrimHaus', 'email' => 'kasir@trimhaus.test', 'password' => Hash::make('password'), 'role' => 'cashier']);
        User::create(['name' => 'Pelanggan Demo', 'email' => 'pelanggan@trimhaus.test', 'password' => Hash::make('password'), 'role' => 'customer']);
    }
}
