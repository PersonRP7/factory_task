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
        Schema::create('meal_translations', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedBigInteger('post_id')->nullable();
            $table->string('locale')->index();
            $table->string('title');
            $table->text('description');
        
            $table->unique(['meal_id', 'locale']);
            $table->foreign('meal_id')->references('id')->on('meal')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('meal_translations');
    }
};
