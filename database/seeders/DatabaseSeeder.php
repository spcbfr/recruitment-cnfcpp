<?php

namespace Database\Seeders;

use App\Models\Position;
use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();
        Position::create([
            'code' => 1,
            'name' => 'هندسة البرمجيات أو هندسة البرماجيات ونظم المعلومات',
        ]);
        Position::create([
            'code' => 2,
            'name' => 'الهندسة الصناعية',
        ]);
        Position::create([
            'code' => 3,
            'name' => 'المالية',
        ]);
        Position::create([
            'code' => 4,
            'name' => 'إدارة الأعمال',
        ]);
        Position::create([
            'code' => 5,
            'name' => 'إدارة الأعمال',
        ]);

        User::firstOrCreate(
            ['email' => 'samira.elmejdi@cnfcpp.tn'],
            [
                'name' => 'Admin',
                'password' => 'Ghorassen75868@',
                'is_admin' => true,
                'email_verified_at' => now(),
            ]
        );
    }
}
