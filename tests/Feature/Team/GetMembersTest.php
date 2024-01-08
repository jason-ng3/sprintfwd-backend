<?php

namespace Tests\Feature\Team;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use App\Models\Team;
use App\Models\Member;

class GetMembersTest extends TestCase
{
    use RefreshDatabase;

    public function test_returns_members_of_team()
    {
      $team = factory(Team::class)->create();
      $members = factory(Member::class, 5)->create(['team_id' => $team->id]);

      $response = $this->getJson("/api/teams/{$team->id}/members");

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