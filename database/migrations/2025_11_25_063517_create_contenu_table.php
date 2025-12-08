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
        Schema::create('contenu', function (Blueprint $table) {
            $table->id();
            $table->string('titre');
            $table->text('texte');
            $table->string('statut');
            $table->date('date_creation');
            $table->date('date_validation');

           $table->unsignedBigInteger('moderateur_id');
           $table->foreign('moderateur_id')->references('id')->on('utilisateur');

           $table->unsignedBigInteger('id_type_contenu');
           $table->foreign('id_type_contenu')->references('id')->on('type_contenu');

           $table->unsignedBigInteger('parent_id');
           $table->foreign('parent_id')->references('id')->on('utilisateur');

           $table->unsignedBigInteger('auteur_id');
           $table->foreign('auteur_id')->references('id')->on('utilisateur');

           $table->unsignedBigInteger('id_region');
           $table->foreign('id_region')->references('id')->on('region');

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
        Schema::dropIfExists('contenu');
    }
};
