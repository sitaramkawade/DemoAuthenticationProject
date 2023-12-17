<?php

namespace Tests\Feature\FacultyAuth;

use App\Models\Faculty;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class PasswordConfirmationTest extends TestCase
{
    use RefreshDatabase;

    public function test_confirm_password_screen_can_be_rendered(): void
    {
        $user = Faculty::factory()->create();

        $response = $this->actingAs($user,'faculty')->get('faculty/confirm-password');

        $response->assertStatus(200);
    }

    public function test_password_can_be_confirmed(): void
    {
        $user = Faculty::factory()->create();

        $response = $this->actingAs($user,'faculty')->post('faculty/confirm-password', [
            'password' => 'password',
        ]);

        $response->assertRedirect();
        $response->assertSessionHasNoErrors();
    }

    public function test_password_is_not_confirmed_with_invalid_password(): void
    {
        $user = Faculty::factory()->create();

        $response = $this->actingAs($user,'faculty')->post('faculty/confirm-password', [
            'password' => 'wrong-password',
        ]);

        $response->assertSessionHasErrors();
    }
}
