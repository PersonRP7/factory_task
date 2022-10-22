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
        Schema::table('ingredient_meal', function (Blueprint $table) {
            // meal fk
            $table->unsignedBigInteger('meal_id');
            $table->foreign('meal_id')->references('id')->on('meals')->onDelete('cascade');
            // meal fk
 
            // ingredient fk
            $table->unsignedBigInteger('ingredient_id');
            $table->foreign('ingredient_id')->references('id')->on('ingredients')->onDelete('cascade');
            // ingredient fk
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('ingredient_meal', function (Blueprint $table) {
            //
        });
    }
};
