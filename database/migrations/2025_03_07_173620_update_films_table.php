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
        Schema::table('films', function (Blueprint $table) {
            $table->string('name', 100)->change();
            $table->string('genre', 50)->change();
            $table->string('country', 30)->change();
            $table->string('img_url', 255)->change();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('films', function (Blueprint $table) {
            $table->string('name', 255)->change();
            $table->string('genre', 255)->change();
            $table->string('country', 255)->change();
            $table->text('img_url')->change();
            
        });
    }
};
