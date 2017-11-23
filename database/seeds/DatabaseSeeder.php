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
            $messages = factory(App\Message::class)
                ->times(20)
                ->create([
                    'user_id' => $user->id,
                ]);

            $messages->each(function (App\Message $message) use ($users) {
                factory(App\Response::class)
                    ->times(random_int(1, 10))
                    ->create([
                        'message_id' => $message->id,
                        'user_id' => $users->random(1)->first()->id,
                    ]);
            });

            $user->follows()->sync(
                $users->random(10)
            );
        });
    }
}
