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
        Schema::create('entrada', function (Blueprint $table) {
            $table->id();
            $table->integer('entrada');
            $table->string('detalle');
            $table->unsignedBigInteger('id_user');
            $table->unsignedBigInteger('id_opcion');
            $table->unsignedBigInteger('id_caja');
            $table->date('fecha');
            $table->time('hora');
            $table->timestamps();

            $table->foreign("id_opcion")
            ->references("id")
            ->on("entrada_opcion")
            ->onDelete("cascade");

            $table->foreign("id_caja")
            ->references("id")
            ->on("cajas")
            ->onDelete("cascade");
            
            $table->foreign("id_user")
            ->references("id")
            ->on("users")
            ->onDelete("cascade");
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('entradas');
    }
};
