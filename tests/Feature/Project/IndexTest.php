<?php

namespace Tests\Feature\Project;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use App\Models\Project;

class IndexTest extends TestCase
{
    use RefreshDatabase;

    public function test_returns_all_projects()
    {
        factory(Project::class, 3)->create();

        $response = $this->getJson('/api/projects');

        $response->assertStatus(200);
        $this->assertCount(3, $response->json('projects'));

        $response->assertJsonStructure([
            'projects' => [
                '*' => ['id', 'name']
            ]
        ]);
    }
}