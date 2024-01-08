<?php

namespace Tests\Feature\Project;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\Project;

class UpdateTest extends TestCase
{
    use RefreshDatabase, WithFaker;

    public function test_update_with_valid_project_name()
    {   
        $project = factory(Project::class)->create();
        $newName = 'Brand New Project';
        $response = $this->putJson("/api/projects/{$project->id}", ['name' => $newName]);

        $response->assertStatus(200);

        $response->assertJson([
            'message' => 'Project updated successfully',
            'project' => ['name' => $newName]
        ]);

        $this->assertDatabaseHas('projects', ['id' => $project->id, 'name' => $newName]);
    }
    
    public function test_update_with_invalid_project_name()
    {
        $project = factory(Project::class)->create();
        $invalidName = '';

        $response = $this->putJson("/api/projects/{$project->id}", ['name' => $invalidName]);

        $response->assertStatus(422);
        $response->assertJsonValidationErrors(['name']);
    }
}