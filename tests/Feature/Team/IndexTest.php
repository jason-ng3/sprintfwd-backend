<?php

namespace Tests\Feature\Team;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use App\Models\Team;

class IndexTest extends TestCase
{
    use RefreshDatabase;

    public function test_returns_all_teams()
    {
        factory(Team::class, 3)->create();

        $response = $this->getJson('/api/teams');

        $response->assertStatus(200);
        $this->assertCount(3, $response->json('teams'));

        $response->assertJsonStructure([
            'teams' => [
                '*' => ['id', 'name']
            ]
        ]);
    }
}