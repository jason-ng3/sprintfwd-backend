<?php

namespace Tests\Feature\Project;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use App\Models\Project;

class ShowTest extends TestCase
{
    use RefreshDatabase;

    public function test_returns_correct_project()
    {
        $project = factory(Project::class)->create();

        $response = $this->getJson(route('projects.show', $project->id));

        $response->assertStatus(200);
        $response->assertJsonStructure(['project' => ['id', 'name']]);

        $response->assertJson([
            'project' => [
                'id' => $project->id,
                'name' => $project->name,
            ]
        ]);
    }
}