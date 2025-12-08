<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddStatisticsToContenuTable extends Migration
{
    public function up()
    {
        Schema::table('contenu', function (Blueprint $table) {
            $table->unsignedBigInteger('vues')->default(0);
            $table->unsignedBigInteger('likes_count')->default(0);
            $table->unsignedBigInteger('commentaires_count')->default(0);
            $table->unsignedBigInteger('partages_count')->default(0);
        });
    }

    public function down()
    {
        Schema::table('contenu', function (Blueprint $table) {
            $table->dropColumn(['vues', 'likes_count', 'commentaires_count', 'partages_count']);
        });
    }
}