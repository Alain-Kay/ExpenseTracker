<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('expenses', function (Blueprint $table) {
            $table->integer('expense_id', true);
            $table->integer('expense_category_id');
            $table->integer('user_id');
            $table->integer('expense_currency_id');
            $table->string('expense_title');
            $table->string('expense_description');
            $table->integer('expense_amount');
            $table->date('expense_date');
            $table->timestamps();

            $table->foreign('user_id')->references('user_id')->on('users')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('expense_category_id')->references('category_id')->on('categories')->onDelete('cascade')->onDelete('cascade');
            $table->foreign('expense_currency_id')->references('currency_id')->on('currencies')->onDelete('cascade')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('expenses');
    }
};
