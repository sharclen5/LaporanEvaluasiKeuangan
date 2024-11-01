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
        Schema::create('financial_data', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('province_id');
            $table->unsignedBigInteger('categories_id');
            $table->year('year');
            $table->decimal('budget', 20, 2);
            $table->decimal('realization', 20, 2);
            $table->decimal('percentage', 5, 2)->virtualAs('realization / budget * 100');
            $table->timestamps();

            $table->foreign('province_id')
                  ->references('id')
                  ->on('provinces')
                  ->onDelete('cascade');

            $table->foreign('categories_id')
                  ->references('id')
                  ->on('categories')
                  ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('financial_data');
    }
};