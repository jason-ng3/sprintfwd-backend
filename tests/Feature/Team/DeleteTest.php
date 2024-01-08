<?php

namespace Tests\Feature\Team;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use App\Models\Team;

class DeleteTest extends TestCase
{
    use RefreshDatabase;

    public function test_delete_team()
    {
        $team = factory(Team::class)->create();
        $response = $this->deleteJson(route('teams.destroy', $team->id));

        $response->assertStatus(200);

        $response->assertJsonStructure(['message']);
        $this->assertDatabaseMissing('teams', ['id' => $team->id]);
    }
}