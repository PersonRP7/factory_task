<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tag_meal', function (Blueprint $table) {
            $table->id();

            // meal fk
            $table->unsignedBigInteger('meal_id');
            $table->foreign('meal_id')->references('id')->on('meals')->onDelete('cascade');
            // meal fk

            // tag fk
            $table->unsignedBigInteger('tag_id');
            $table->foreign('tag_id')->references('id')->on('tags')->onDelete('cascade');
            // tag fk
 
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tag_meal');
    }
};
