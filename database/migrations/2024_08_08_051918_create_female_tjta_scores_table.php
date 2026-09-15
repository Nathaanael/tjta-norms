<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFemaleTjtaScoresTable extends Migration
{
    public function up()
    {
        Schema::create('female_tjta_scores', function (Blueprint $table) {
            $table->id();
            $table->integer('raw_score');
            $table->integer('nervous');
            $table->integer('depressive');
            $table->integer('active_social');
            $table->integer('expressive_responsive');
            $table->integer('sympathetic');
            $table->integer('subjective');
            $table->integer('dominant');
            $table->integer('hostile');
            $table->integer('self_disciplined');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('female_tjta_scores');
    }
}
