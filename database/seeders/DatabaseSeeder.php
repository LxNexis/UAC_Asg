<?php

namespace Database\Seeders;

use App\Models\Avatar;
use App\Models\Interest;
use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use DB;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        User::factory(10)->create();
        Interest::factory(5)->create();
        Avatar::factory(10)->create();

        $userIds = DB::table('users')->pluck('id')->take(10); // Get the first 10 users
        $interestIds = DB::table('interests')->pluck('id')->toArray(); // Get all interest ids

        foreach ($userIds as $userId) {
            $selectedInterests = (array)array_rand(array_flip($interestIds), 3); // Randomly pick 3 distinct interests

            foreach ($selectedInterests as $interestId) {
                DB::table('user_interests')->insert([
                    'user_id' => $userId,
                    'interest_id' => $interestId,
                    'created_at' => now(),
                    'updated_at' => now(),
                ]);
            }
        }
    }
}
