<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::table('contenu', function (Blueprint $table) {
            // Ajouter les colonnes d'engagement si elles n'existent pas
            if (!Schema::hasColumn('contenu', 'likes_count')) {
                $table->integer('likes_count')->default(0)->after('statut');
            }
            
            if (!Schema::hasColumn('contenu', 'commentaires_count')) {
                $table->integer('commentaires_count')->default(0)->after('likes_count');
            }
            
            if (!Schema::hasColumn('contenu', 'vues')) {
                $table->integer('vues')->default(0)->after('commentaires_count');
            }
            
            if (!Schema::hasColumn('contenu', 'partages_count')) {
                $table->integer('partages_count')->default(0)->after('vues');
            }
            
            // S'assurer que la colonne statut existe
            if (!Schema::hasColumn('contenu', 'statut')) {
                $table->enum('statut', ['pending', 'approved', 'rejected'])->default('pending')->after('contenu');
            }
        });
    }

    public function down()
    {
        Schema::table('contenu', function (Blueprint $table) {
            // Supprimer les colonnes si nécessaire
            $table->dropColumn(['likes_count', 'commentaires_count', 'vues', 'partages_count']);
        });
    }
};