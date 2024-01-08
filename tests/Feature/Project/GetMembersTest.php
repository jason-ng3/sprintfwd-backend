<?php

namespace Tests\Feature\Project;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use App\Models\Project;
use App\Models\Member;

class GetMembersTest extends TestCase
{
    use RefreshDatabase;

    public function test_returns_members_of_project()
    {
        $project = factory(Project::class)->create();
        $members = factory(Member::class, 5)->create();

        foreach ($members as $member) {
            $this->patchJson("/api/projects/{$project->id}/add-member", [
                'member_id' => $member->id,
            ]);
        }

        $response = $this->getJson("/api/projects/{$project->id}/members");

        $response->assertStatus(200);
        $response->assertJsonCount(5, 'members');

        foreach ($members as $member) {
            $response->assertJsonFragment([
                'id' => $member->id,
                'first_name' => $member->first_name,
                'last_name' => $member->last_name,
                'team_id' => $member->team_id,
            ]);
        }
    }
}