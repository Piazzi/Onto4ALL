<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOntologiesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ontologies', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->date('publication_date')->nullable();
            $table->date('last_uploaded')->nullable();
            $table->string('description')->nullable();
            $table->string('link')->nullable();
            $table->string('created_by')->nullable();
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
        Schema::dropIfExists('ontologies');
    }
}
