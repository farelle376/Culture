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
        Schema::create('utilisateur', function (Blueprint $table) {
            $table->id();
             $table->string('nom');
            $table->string('prenom');
            $table->string('password');
            $table->string('email')->unique();
            $table->string('sexe');
            $table->date('date_inscription');
            $table->date('date_naissance');
            $table->string('statut');
            $table->string('photo');
            $table->unsignedBigInteger('id_roles');
            $table->foreign('id_roles')->references('id_role')->on('roles');
            $table->unsignedBigInteger('id_langue');
            $table->foreign('id_langue')->references('id')->on('langue');
           
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('utilisateur');
    }
};
