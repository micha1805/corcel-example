<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Create 30 users
        $users = factory(App\User::class)
            ->times(30)
            ->create();

        // For each user, create 20 messages, and follow 10 random users
        $users->each(function (App\User $user) use ($users) {
            factory(App\Message::class)
                ->times(20)
                ->create([
                    'user_id' => $user->id,
                ]);

            $user->follows()->sync(
                $users->random(10)
            );
        });
    }
}
