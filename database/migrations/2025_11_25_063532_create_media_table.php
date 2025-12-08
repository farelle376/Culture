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
        Schema::create('media', function (Blueprint $table) {
            $table->id();
             $table->string('chemin');
            $table->text('description');
            $table->unsignedBigInteger('id_contenu');
            $table->foreign('id_contenu')->references('id')->on('contenu');
            $table->unsignedBigInteger('id_type_media');
            $table->foreign('id_type_media')->references('id')->on('type_media');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('media');
    }
};
