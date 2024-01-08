<?php

namespace Tests\Feature\Project;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use App\Models\Project;
use App\Models\Member;

class AddMemberTest extends TestCase
{
    use RefreshDatabase;

    public function test_add_member_to_project()
    {
        $project = factory(Project::class)->create();
        $member = factory(Member::class)->create();

        $response = $this->patchJson("/api/projects/{$project->id}/add-member", [
            'member_id' => $member->id,
        ]);

        $response->assertStatus(200);
        $response->assertJson(['message' => 'Member added to the project successfully']);

        $this->assertTrue($project->members->contains($member));
    }
}