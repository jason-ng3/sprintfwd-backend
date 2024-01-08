<?php

namespace Tests\Feature\Team;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use App\Models\Team;

class ShowTest extends TestCase
{
    use RefreshDatabase;

    public function test_returns_correct_team()
    {
        $team = factory(Team::class)->create();

        $response = $this->getJson(route('teams.show', $team->id));

        $response->assertStatus(200);
        $response->assertJsonStructure(['team' => ['id', 'name']]);

        $response->assertJson([
            'team' => [
                'id' => $team->id,
                'name' => $team->name,
            ]
        ]);
    }
}