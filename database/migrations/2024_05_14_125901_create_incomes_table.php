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
        Schema::create('incomes', function (Blueprint $table) {
            $table->integer('income_id', true);
            $table->integer('user_id');
            $table->integer('income_category_id');
            $table->integer('income_currency_id');
            $table->string('income_title')->unique();
            $table->string('income_source');
            $table->string('income_description');
            $table->integer('income_amount');
            $table->date('income_date');
            $table->timestamps();

            $table->foreign('user_id')->references('user_id')->on('users')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('income_category_id')->references('category_id')->on('categories')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('income_currency_id')->references('currency_id')->on('currencies')->onDelete('cascade')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('incomes');
    }
};
