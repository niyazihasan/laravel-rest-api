<?php

namespace Database\Factories;

use App\Models\{Account, ExpenseCategory, IncomeCategory, Transaction};
use Illuminate\Database\Eloquent\Factories\Factory;

class TransactionFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Transaction::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'type' => $this->faker->randomElement(['income', 'spending']),
            'account_id' => Account::factory(),
            'expense_id' => ExpenseCategory::factory(),
            'income_id' => IncomeCategory::factory(),
            'amount' => $this->faker->numberBetween(1, 10000)
        ];
    }
}
