<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Testing\Fluent\AssertableJson;
use Tests\TestCase;

class UserRegistrationTest extends TestCase
{
    use DatabaseTransactions;

    public function testItCanRegisterAUser()
    {
        $newUser = User::factory()->make()->toArray();

        $password = ['password' => 'password'];

        $data = array_merge($newUser, $password);

        $response = $this->post('/api/user/create', $data);

        $response->assertStatus(201)->assertJson(
            fn (AssertableJson $json) => $json->where('data.first_name', $data['first_name'])
                ->where('data.email', $data['email'])
        );
    }

    public function testItCannotRegisterUserWithExistingEmail()
    {
        User::factory()->create(['email' => 'test@email.com']);

        $newUser = User::factory()->make(['email' => 'test@email.com'])->toArray();

        $password = ['password' => 'password'];

        $data = array_merge($newUser, $password);

        $response = $this->post('/api/user/create', $data);

        $response->assertStatus(422)->assertJson(
            fn (AssertableJson $json) => $json->where('message', "The email has already been taken.")
        );
    }
}
