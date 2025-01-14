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
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('username')->unique();
            $table->string('firts_name');
            $table->string('last_name');
            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->string('img');
            $table->bigInteger('estado')->default(1);
           // $table->bigInteger('cliente_id')->default(0);

            $table->unsignedBigInteger('rol_id');
            $table->rememberToken();
            $table->timestamps();
            
            $table->foreign("rol_id")
            ->references("id")
            ->on("user_rol")
            ->onDelete("cascade");
        
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
    }
};
