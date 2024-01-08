<?php

namespace Tests\Feature\Member;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\Member;
use App\Models\Team;

class UpdateTeamTest extends TestCase
{
    use RefreshDatabase, WithFaker;

    public function test_update_valid_team_with_member()
    {
        $team = factory(Team::class)->create();
        $newTeam = factory(Team::class)->create();
        $member = factory(Member::class)->create(['team_id' => $team->id]);

        $response = $this->patchJson("/api/members/{$member->id}/update-team", [
          'team_id' => $newTeam->id,
        ]);

        $response->assertStatus(200)
                 ->assertJson(['message' => 'Team updated successfully.']);
        
        $member->refresh();
        $this->assertEquals($newTeam->id, $member->team_id);
    }

    public function test_update_invalid_team_with_member()
    {
        $member = factory(Member::class)->create();
        $nonExistentTeamId = 999;

        $response = $this->patchJson("/api/members/{$member->id}/update-team", [
            'team_id' => $nonExistentTeamId,
        ]);

        $response->assertStatus(422);
    }
}