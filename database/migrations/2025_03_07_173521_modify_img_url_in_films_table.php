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
    Schema::table('films', function (Blueprint $table) {
        $table->text('img_url')->change(); // Cambia el tipo a TEXT
    });
}

public function down()
{
    Schema::table('films', function (Blueprint $table) {
        $table->string('img_url', 255)->change(); // Revertir a VARCHAR(255) si es necesario
    });
}

};
