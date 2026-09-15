<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateResultsTable extends Migration
{
    public function up()
    {
        Schema::create('results', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->string('letter');
            $table->integer('raw_score');
            $table->integer('value');
            $table->timestamps();

            // Reference the `id` from the `names` table
            $table->foreign('user_id')->references('id')->on('names')->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::dropIfExists('results');
    }
}

