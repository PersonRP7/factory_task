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
        Schema::table('meals', function (Blueprint $table) {

            // Category fk
            $table->unsignedBigInteger('category_id')->nullable();

            $table->foreign('category_id')->references('id')
            ->on('categories')->onDelete('cascade')
            ;
            //onDelete serves no purpose here because the application level
            //soft delete pattern stops the mysql cascade trigger from engaging.
            //Either use a third party package, or implement an observer pattern.
            //OR:
            //Implement custom soft delete functionality by overriding the model delete
            //method.
            //
            //Category fk
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('meals', function (Blueprint $table) {
            $table->dropColumn(['category_id']);
        });
    }
};
