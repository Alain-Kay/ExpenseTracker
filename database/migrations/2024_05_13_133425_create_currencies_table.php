<?php

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('currencies', function (Blueprint $table) {
            $table->integer('currency_id', true);
            $table->string('currency_name', 50);
            $table->string('currency_symbol', 10);
            $table->timestamps();
        });

        DB::table('currencies')->insert([
            [
                'currency_name' => 'Dollar',
                'currency_symbol' => 'USD',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'currency_name' => 'Franc congolais',
                'currency_symbol' => 'CDF',
                'created_at' => now(),
                'updated_at' => now()
            ]
        ]);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('currencies');
    }
};
