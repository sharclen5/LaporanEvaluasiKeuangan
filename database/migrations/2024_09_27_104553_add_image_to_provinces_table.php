<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
{
    Schema::table('provinces', function (Blueprint $table) {
        $table->string('image')->nullable(); // Image path, nullable for existing rows
    });
}

public function down()
{
    Schema::table('provinces', function (Blueprint $table) {
        $table->dropColumn('image');
    });
}

};
