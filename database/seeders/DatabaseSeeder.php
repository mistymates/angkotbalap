<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Category;
use App\Models\Unit;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    // seed database.
    public function run(): void
    {
        //  admin
        $admin = User::factory()->create([
            'name' => 'Admin User',
            'email' => 'admin@example.com',
            'role' => 'admin',
        ]);
        $admin->profile()->create([
            'phone' => '081234567890',
            'address' => 'Admin Address',
            'birth_date' => '1990-01-01',
        ]);

        // users
        $users = User::factory(1)->create(['role' => 'user']);
        foreach ($users as $user) {
            $user->profile()->create([
                'phone' => fake()->phoneNumber(),
                'address' => fake()->address(),
                'birth_date' => fake()->date(),
            ]);
        }

        // categories
        $categories = [
            ['name' => 'Drag Race', 'description' => 'Drag Race Vehicles'],
            ['name' => 'Mobil', 'description' => 'Cars'],
            ['name' => 'Drifting', 'description' => 'Drifting Vehicles'],
            
        ];
        foreach ($categories as $cat) {
            Category::create($cat);
        }

        // units
        $units = [
            ['code' => 'M001', 'name' => 'Angkot Turbo Mad Max', 'description' => 'Drag Race'],
            ['code' => 'M002', 'name' => 'Becak Superlight 2', 'description' => 'Drag Race'],
            ['code' => 'C001', 'name' => 'Angkot 17 Pro Max', 'description' => 'Drifting'],
            ['code' => 'C002', 'name' => 'Angkot Twin Turbo Quadra', 'description' => 'Drifting'],
            
        ];
        foreach ($units as $unit) {
            Unit::create($unit);
        }

        // assign categories
        Unit::find(1)->categories()->attach([1, 2]); // M001 -> Drag Race, Mobil
        Unit::find(2)->categories()->attach([1]); // M002 -> Drag Race
        Unit::find(3)->categories()->attach([3]); // C001 -> Drifting
        Unit::find(4)->categories()->attach([2, 3]); // C002 -> Mobil, Drifting
    }
}
