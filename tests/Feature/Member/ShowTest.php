<?php

namespace Tests\Feature\Member;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\Member;
use App\Models\Team;

class ShowTest extends TestCase
{
  use RefreshDatabase, WithFaker;

    public function test_returns_correct_member()
    {
        $member = factory(Member::class)->create();
        $showResponse = $this->getJson(route('members.show', $member->id));
        $showResponse->assertStatus(200);

        $showResponse->assertJson([
            'member' => [
                'id' => $member->id,
                'first_name' => $member->first_name,
                'last_name' => $member->last_name,
                'city' => $member->city,
                'state' => $member->state,
                'country' => $member->country,
                'team_id' => $member->team_id,
            ]
        ]);
    }
}