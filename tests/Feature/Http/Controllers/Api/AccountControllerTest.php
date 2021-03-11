<?php

namespace Tests\Feature\Http\Controllers\Api;

use App\Models\Account;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class AccountControllerTest extends TestCase
{
    use RefreshDatabase, WithFaker;

    public function test_can_get_list_of_all_accounts()
    {
        Account::factory()->count(10)->create();

        $this->get('/api/accounts')
            ->assertSuccessful()
            ->assertJsonStructure([
                'data' => [
                    '*' => ['id', 'name', 'balance']
                ]
            ]);
    }

    public function test_can_create_an_account()
    {
        $account = Account::factory()->make();

        $data = [
            'name' => $account->name,
            'balance' => $account->balance
        ];

        $this->post('/api/accounts', $data)
            ->assertSuccessful()
            ->assertJson(['data' => $data]);

        $this->assertDatabaseHas('accounts', $data);
    }

    public function test_can_get_a_single_account()
    {
        $account = Account::factory()->create();

        $this->get("/api/accounts/$account->id")
            ->assertSuccessful()
            ->assertExactJson([
                'data' => [
                    'id' => $account->id,
                    'name' => $account->name,
                    'balance' => $account->balance
                ]
            ]);
    }

    public function test_can_update_an_account()
    {
        $account = Account::factory()->create();

        $data = [
            'id' => $account->id,
            'name' => $account->name,
            'balance' => $account->balance
        ];

        $this->patch("/api/accounts/$account->id", $data)
            ->assertSuccessful()
            ->assertExactJson(['data' => $data]);

        $this->assertDatabaseHas('accounts', $data);
    }

    public function test_can_delete_an_account()
    {
        $account = Account::factory()->create();

        $this->delete("/api/accounts/$account->id")
            ->assertSuccessful();

        $this->assertDeleted($account);
    }
}
