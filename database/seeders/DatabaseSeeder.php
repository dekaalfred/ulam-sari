<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        $this->call(MenuSeeder::class);
        // 1. Admin User
        User::updateOrCreate(
            ['email' => 'admin@ulamsari.com'],
            [
                'name' => 'Ulam Sari Admin',
                'password' => Hash::make('admin123'),
            ]
        );

        // 3. Initial Reservations
        $reservations = [
            ['customer' => 'Bpk. Budi Santoso', 'date' => '24 Okt 2023', 'time' => '10:00 - 14:00', 'guests' => 25, 'phone' => '0812-3456-7890', 'status' => 'menunggu'],
            ['customer' => 'PT. Sejahtera Abadi', 'date' => '25 Okt 2023', 'time' => '18:30', 'guests' => 15, 'phone' => '0899-8765-4321', 'status' => 'dikonfirmasi'],
        ];

        foreach ($reservations as $r) {
            DB::table('reservations')->insert(array_merge($r, [
                'created_at' => now(),
                'updated_at' => now()
            ]));
        }

        // 4. Initial Activities
        $activities = [
            ['dot' => 'dot-orange', 'text' => 'New Reservation for 4 pax by Budi Santoso', 'sub' => 'Today, 19:00 PM — Meja VIP 2', 'time_label' => '10m ago'],
            ['dot' => 'dot-muted', 'text' => 'Menu Updated: Gurame Bakar Madu price adjusted.', 'sub' => 'Updated by Admin', 'time_label' => '1h ago'],
        ];

        foreach ($activities as $a) {
            DB::table('activities')->insert(array_merge($a, [
                'created_at' => now(),
                'updated_at' => now()
            ]));
        }
    }
}
