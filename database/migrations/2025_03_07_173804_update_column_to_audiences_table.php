<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up()
    {
        Schema::table('audiences', function (Blueprint $table) {
            // Primero eliminamos la clave foránea
            $table->dropForeign(['film_id']);

            // Luego eliminamos la columna
            $table->dropColumn('film_id');


        });
    }

    public function down()
    {
        Schema::table('audiences', function (Blueprint $table) {

            // Volvemos a agregar la columna eliminada
            
            $table->unsignedBigInteger('film_id');

            // Restauramos la clave foránea
            $table->foreign('film_id')->references('id')->on('films')->onDelete('cascade');
        });
    }
};
