<?php

namespace Tests\Feature\Project;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\Project;

class CreateTest extends TestCase
{
    use RefreshDatabase, WithFaker;

    public function test_create_a_valid_project()
    {
        $validData = ['name' => $this->faker->name];
        $response = $this->postJson('/api/projects', $validData);

        $response->assertStatus(201);
        $this->assertCount(1, Project::all());
        $response->assertJsonStructure(['data']);
        $response->assertJson(['message' => 'Project created successfully.']);
    }
    
    public function test_create_an_invalid_project()
    {
        $invalidData = [];
        $response = $this->postJson('/api/projects', $invalidData);

        $response->assertStatus(422);
        $response->assertJsonStructure(['errors']);
        $response->assertJsonFragment(['message' => 'The given data was invalid.']);
    }
}
