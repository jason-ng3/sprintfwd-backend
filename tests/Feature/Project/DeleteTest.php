<?php

namespace Tests\Feature\Project;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use App\Models\Project;

class DeleteTest extends TestCase
{
    use RefreshDatabase;

    public function test_delete_project()
    {
        $project = factory(Project::class)->create();
        $response = $this->deleteJson(route('projects.destroy', $project->id));

        $response->assertStatus(200);

        $response->assertJsonStructure(['message']);
        $this->assertDatabaseMissing('projects', ['id' => $project->id]);
    }
}