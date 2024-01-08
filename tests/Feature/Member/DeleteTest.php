<?php

namespace Tests\Feature\Member;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\Member;
use App\Models\Team;

class DeleteTest extends TestCase
{
    use RefreshDatabase, WithFaker;

    public function test_delete_member()
    {
        $member = factory(Member::class)->create();
        $response = $this->deleteJson(route('members.destroy', $member->id));

        $response->assertStatus(200);

        $response->assertJsonStructure(['message']);
        $this->assertDatabaseMissing('members', ['id' => $member->id]);
    }
}