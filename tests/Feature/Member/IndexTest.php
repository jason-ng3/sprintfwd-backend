<?php

namespace Tests\Feature\Member;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\Member;
use App\Models\Team;

class IndexTest extends TestCase
{
  use RefreshDatabase, WithFaker;

    public function test_returns_all_projects()
    {
      $teamOne = factory(Team::class)->create();
      $teamTwo = factory(Team::class)->create();

      $teamOneMembers = factory(Member::class, 5)->create(['team_id' => $teamOne->id]);
      $teamTwoMembers = factory(Member::class, 3)->create(['team_id' => $teamTwo->id]);

      $response = $this->getJson('/api/members');
      $response->assertStatus(200);

      $response->assertJsonStructure([
          'members' => [
              '*' => [
                  'id',
                  'first_name',
                  'last_name',
                  'team_id'
              ]
          ]
      ]);

      $this->assertCount(8, $response->json('members'));
    }
}