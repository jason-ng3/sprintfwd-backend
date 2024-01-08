<?php

namespace Tests\Feature\Team;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\Team;

class CreateTest extends TestCase
{
    use RefreshDatabase, WithFaker;

    public function test_create_a_valid_team()
    {
        $validData = ['name' => $this->faker->name];
        $response = $this->postJson('/api/teams', $validData);

        $response->assertStatus(201);
        $this->assertCount(1, Team::all());
        $response->assertJsonStructure(['data']);
        $response->assertJson(['message' => 'Team created successfully.']);
    }
    
    public function test_create_an_invalid_team()
    {
        $invalidData = [];
        $response = $this->postJson('/api/teams', $invalidData);

        $response->assertStatus(422);
        $response->assertJsonStructure(['errors']);
        $response->assertJsonFragment(['message' => 'The given data was invalid.']);
    }
}
