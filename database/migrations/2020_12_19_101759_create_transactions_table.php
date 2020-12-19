<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTransactionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('transactions', function (Blueprint $table) {
            $table->id();
            $table->string('type');
            $table->integer('account_id')->unsigned()->index();
            $table->integer('expense_id')->unsigned()->index();
            $table->integer('income_id')->unsigned()->index();
            $table->float('amount');
            $table->timestamps();

            $table->foreign('account_id')
                ->references('id')
                ->on('accounts')
                ->onUpdate('cascade')
                ->onDelete('cascade');

            $table->foreign('expense_id')
                ->references('id')
                ->on('expense_categories')
                ->onUpdate('cascade')
                ->onDelete('cascade');

            $table->foreign('income_id')
                ->references('id')
                ->on('income_categories')
                ->onUpdate('cascade')
                ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('transactions');
    }
}
