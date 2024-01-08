<?php

namespace Tests\Feature\Member;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\Member;
use App\Models\Team;

class CreateTest extends TestCase
{
    use RefreshDatabase, WithFaker;

    public function test_create_a_valid_member()
    {
        $team = factory(Team::class)->create();

        $validData = [
            'first_name' => $this->faker->firstName,
            'last_name' => $this->faker->lastName,
            'city' => $this->faker->city,
            'state' => $this->faker->stateAbbr,
            'country' => $this->faker->country,
            'team_id' => $team->id,
        ];

        $response = $this->postJson('/api/members', $validData);

        $response->assertStatus(201);
        $this->assertCount(1, Member::all());
        $response->assertJson([
            'message' => 'Member created successfully.',
        ]);
    }
    
    public function test_create_an_invalid_member()
    {   
        $team = factory(Team::class)->create();
        $teamId = $team->pluck('id')->toArray();

        $invalidData = [
            'first_name' => '', 
            'last_name' => '',
            'team_id' => $teamId,
        ];

        $response = $this->postJson('/api/members', $invalidData);

        $response->assertStatus(422);
        $response->assertJsonStructure(['errors']);
        $response->assertJsonFragment(['message' => 'The given data was invalid.']);
    }
}
