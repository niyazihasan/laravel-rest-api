<?php

namespace Tests\Feature\Http\Controllers\Api;

use App\Models\Transaction;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class TransactionControllerTest extends TestCase
{
    use RefreshDatabase, WithFaker;

    public function test_can_get_list_of_all_transactions()
    {
        Transaction::factory()->count(10)->create();

        $this->get('/api/transactions')
            ->assertSuccessful()
            ->assertJsonStructure([
                'data' => [
                    '*' => [
                        'id', 'type', 'account_id',
                        'amount', 'expense_id', 'income_id'
                    ]
                ]
            ]);
    }

    public function test_can_create_an_transaction()
    {
        $transaction = Transaction::factory()->make();

        $data = [
            'type' => $transaction->type,
            'account_id' => $transaction->account_id,
            'amount' => $transaction->amount,
            'expense_id' => $transaction->expense_id,
            'income_id' => $transaction->income_id
        ];

        $this->post('/api/transactions', $data)
            ->assertSuccessful()
            ->assertJson(['data' => $data]);

        $this->assertDatabaseHas('transactions', $data);
    }

    public function test_can_get_a_single_transaction()
    {
        $transaction = Transaction::factory()->create();

        $this->get("/api/transactions/$transaction->id")
            ->assertSuccessful()
            ->assertExactJson([
                'data' => [
                    'id' => $transaction->id,
                    'type' => $transaction->type,
                    'account_id' => $transaction->account_id,
                    'amount' => $transaction->amount,
                    'expense_id' => $transaction->expense_id,
                    'income_id' => $transaction->income_id
                ]
            ]);
    }

    public function test_can_update_an_transaction()
    {
        $transaction = Transaction::factory()->create();

        $data = [
            'id' => $transaction->id,
            'type' => $transaction->type,
            'account_id' => $transaction->account_id,
            'amount' => $transaction->amount,
            'expense_id' => $transaction->expense_id,
            'income_id' => $transaction->income_id
        ];

        $this->patch("/api/transactions/$transaction->id", $data)
            ->assertSuccessful()
            ->assertExactJson(['data' => $data]);

        $this->assertDatabaseHas('transactions', $data);
    }

    public function test_can_delete_an_transaction()
    {
        $transaction = Transaction::factory()->create();

        $this->delete("/api/transactions/$transaction->id")
            ->assertSuccessful();

        $this->assertDeleted($transaction);
    }
}
