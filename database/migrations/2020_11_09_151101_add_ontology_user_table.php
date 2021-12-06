<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddOntologyUserTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ontology_user', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('ontology_id');
            $table->unsignedInteger('user_id');
            $table->foreign('ontology_id')->references('id')->on('ontologies')->onDelete('cascade');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
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
        Schema::dropIfExists('ontology_user');
    }
}
