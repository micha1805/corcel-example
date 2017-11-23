<?php

namespace Tests\Feature;

use App\User;
use Tests\TestCase;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Foundation\Testing\Concerns\InteractsWithDatabase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class UserTest extends TestCase
{
    use DatabaseTransactions;
    use InteractsWithDatabase;

    public function testCanFollow()
    {
        // Arrange
        $user = factory(User::class)->create();
        $other = factory(User::class)->create();

        // Act
        $response = $this->actingAs($user)->post('/user/' . $other->username . '/follow', [
            'email' => $user->email,
            'password' => 'secret',
        ]);

        // Assert
        $this->assertDatabaseHas('followers', [
            'user_id' => $user->id,
            'followed_id' => $other->id,
        ]);
    }

    public function testCanLogin()
    {
        // Arrange
        $user = factory(User::class)->create();

        // Act
        $response = $this->post('/login', [
            'email' => $user->email,
            'password' => 'secret',
        ]);

        // Assert
        $this->assertAuthenticatedAs($user);
    }

    public function testCanSeeUserPage()
    {
        // Arrange
        $user = factory(User::class)->create();

        // Act
        $response = $this->get('/user/' . $user->username);

        // Assert
        $response->assertSee($user->name);
    }
}
