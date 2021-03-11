<?php

namespace Tests\Feature\Http\Controllers\Api;

use App\Models\IncomeCategory;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class IncomeCantegoryControllerTest extends TestCase
{
    use RefreshDatabase, WithFaker;

    public function test_can_get_list_of_all_income_categories()
    {
        IncomeCategory::factory()->count(10)->create();

        $this->get('/api/income-categories')
            ->assertSuccessful()
            ->assertJsonStructure([
                'data' => [
                    '*' => ['id', 'name']
                ]
            ]);
    }

    public function test_can_create_an_income_category()
    {
        $income_category = IncomeCategory::factory()->make();

        $data = ['name' => $income_category->name];

        $this->post('/api/income-categories', $data)
            ->assertSuccessful()
            ->assertJson(['data' => $data]);

        $this->assertDatabaseHas('income_categories', $data);
    }

    public function test_can_get_a_single_income_category()
    {
        $income_category = IncomeCategory::factory()->create();

        $this->get("/api/income-categories/$income_category->id")
            ->assertSuccessful()
            ->assertExactJson([
                'data' => [
                    'id' => $income_category->id,
                    'name' => $income_category->name
                ]
            ]);
    }

    public function test_can_update_an_income_category()
    {
        $income_category = IncomeCategory::factory()->create();

        $data = [
            'id' => $income_category->id,
            'name' => $income_category->name
        ];

        $this->patch("/api/income-categories/$income_category->id", $data)
            ->assertSuccessful()
            ->assertExactJson(['data' => $data]);

        $this->assertDatabaseHas('income_categories', $data);
    }

    public function test_can_delete_an_income_category()
    {
        $income_category = IncomeCategory::factory()->create();

        $this->delete("/api/income-categories/$income_category->id")
            ->assertSuccessful();

        $this->assertDeleted($income_category);
    }
}
