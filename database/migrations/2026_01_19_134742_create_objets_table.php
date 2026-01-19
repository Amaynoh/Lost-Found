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
        Schema::create('objets', function (Blueprint $table) {
            $table->id(); 
            $table->string('title'); 
            $table->text('description'); 
            $table->enum('type', ['perdu', 'trouvé']); 
            $table->string('location'); 
            $table->date('date'); 
            $table->string('image')->nullable(); 
            $table->enum('status', ['en attente', 'archive', 'livre'])->default('en attente'); 
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->timestamps(); 
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('objets');
    }
};
