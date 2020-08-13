<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOntologyClassesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ontology_classes', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->string('superclass')->nullable();
            $table->string('subclass')->nullable();
            $table->string('definition');
            $table->string('synonyms')->nullable();
            $table->string('example_of_usage');
            $table->string('imported_from')->nullable();
            $table->string('formal_definition','191')->nullable();
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
        Schema::dropIfExists('ontology-classes');
    }
}
