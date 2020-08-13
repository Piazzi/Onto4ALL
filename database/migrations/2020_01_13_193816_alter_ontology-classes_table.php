<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AlterOntologyClassesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('ontology_classes', function (Blueprint $table) {
            $table->string('class_id',7);
            $table->string('label',50);
            $table->string('elucidation', 500)->nullable();
            $table->string('comments', 255)->nullable();
            $table->string('is_defined_by', 50)->nullable();
            $table->string('disjoint_with', 50)->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('ontology-classes', function (Blueprint $table) {
            //
        });
    }
}
