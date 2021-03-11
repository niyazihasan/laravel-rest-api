<?php

namespace Tests\Feature\Http\Controllers\Api;

use App\Models\ExpenseCategory;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class ExpenseCantegoryControllerTest extends TestCase
{
    use RefreshDatabase, WithFaker;

    public function test_can_get_list_of_all_expense_categories()
    {
        ExpenseCategory::factory()->count(10)->create();

        $this->get('/api/expense-categories')
            ->assertSuccessful()
            ->assertJsonStructure([
                'data' => [
                    '*' => ['id', 'name']
                ]
            ]);
    }

    public function test_can_create_an_expense_category()
    {
        $expense_category = ExpenseCategory::factory()->make();

        $data = ['name' => $expense_category->name];

        $this->post('/api/expense-categories', $data)
            ->assertSuccessful()
            ->assertJson(['data' => $data]);

        $this->assertDatabaseHas('expense_categories', $data);
    }

    public function test_can_get_a_single_expense_category()
    {
        $expense_category = ExpenseCategory::factory()->create();

        $this->get("/api/expense-categories/$expense_category->id")
            ->assertSuccessful()
            ->assertExactJson([
                'data' => [
                    'id' => $expense_category->id,
                    'name' => $expense_category->name
                ]
            ]);
    }

    public function test_can_update_an_expense_category()
    {
        $expense_category = ExpenseCategory::factory()->create();

        $data = [
            'id' => $expense_category->id,
            'name' => $expense_category->name
        ];

        $this->patch("/api/expense-categories/$expense_category->id", $data)
            ->assertSuccessful()
            ->assertExactJson(['data' => $data]);

        $this->assertDatabaseHas('expense_categories', $data);
    }

    public function test_can_delete_an_expense_category()
    {
        $expense_category = ExpenseCategory::factory()->create();

        $this->delete("/api/expense-categories/$expense_category->id")
            ->assertSuccessful();

        $this->assertDeleted($expense_category);
    }
}
