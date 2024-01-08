<?php

namespace Tests\Feature\Member;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\Member;
use App\Models\Team;

class UpdateTest extends TestCase
{
    use RefreshDatabase, WithFaker;

    public function test_update_with_valid_member()
    {   
        $member = factory(Member::class)->create();
        $updateResponse = $this->putJson("/api/members/{$member->id}", [
            'first_name' => 'Jason',
            'last_name' => 'Ng',
            'team_id' => $member->team_id,
        ]);

        $updateResponse->assertStatus(200);
        $updateResponse->assertJson([
            'message' => 'Member updated successfully',
            'member' => [
                'first_name' => 'Jason', 
                'last_name' => 'Ng',
                'team_id' => $member->team_id,
            ]
        ]);
    }
}