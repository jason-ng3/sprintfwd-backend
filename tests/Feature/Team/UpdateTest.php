<?php

namespace Tests\Feature\Team;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use Illuminate\Http\Response;
use App\Models\Team;

class UpdateTest extends TestCase
{
    use RefreshDatabase, WithFaker;

    public function test_update_with_valid_team_name()
    {   
        $team = factory(Team::class)->create();
        $newName = 'Brand New Team';
        $response = $this->putJson("/api/teams/{$team->id}", ['name' => $newName]);

        $response->assertStatus(200);

        $response->assertJson([
            'message' => 'Team updated successfully',
            'team' => ['name' => $newName]
        ]);

        $this->assertDatabaseHas('teams', ['id' => $team->id, 'name' => $newName]);
    }
    
    public function test_update_with_invalid_team_name()
    {
        $team = factory(Team::class)->create();
        $invalidName = '';

        $response = $this->putJson("/api/teams/{$team->id}", ['name' => $invalidName]);

        $response->assertStatus(422);
        $response->assertJsonValidationErrors(['name']);
    }
}