<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call([
            SkillSeeder::class,
            CareerDomainSeeder::class,
            CareerSkillRuleSeeder::class,
        ]);

        User::updateOrCreate(
            ['email' => 'ashleedasilva.internship@gmail.com'],
            [
                'name' => 'Ashlee',
                'password' => bcrypt('password'),
                'is_admin' => true,  
          ]
        );
    }
}