<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ProfileTest extends TestCase
{
    use RefreshDatabase;

    public function test_candidat_profile_page_is_displayed(): void
    {
        $user = User::factory()->create(['role' => 'candidat']);

        $response = $this
            ->actingAs($user)
            ->get('/candidat/profil');

        $response->assertOk();
    }

    public function test_candidat_profile_information_can_be_updated(): void
    {
        $user = User::factory()->create(['role' => 'candidat']);

        $response = $this
            ->actingAs($user)
            ->put('/candidat/profil/infos', [
                'name' => 'Test User Updated',
                'telephone' => '+229 97 00 00 00',
                'localisation' => 'Cotonou',
            ]);

        $response
            ->assertSessionHasNoErrors()
            ->assertRedirect('/candidat/profil');

        $user->refresh();

        $this->assertSame('Test User Updated', $user->name);
        $this->assertSame('+229 97 00 00 00', $user->telephone);
    }
}