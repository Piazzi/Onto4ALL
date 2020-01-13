<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AlterOntologyRelationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('ontology-relations', function (Blueprint $table) {
            $table->string('relation_id', 50);
            $table->string('label', 50);
            $table->string('synonyms', 50)->nullable();
            $table->string('is_defined_by', 50)->nullable();
            $table->string('comments', 255)->nullable();
            $table->string('inverse_of', 50)->nullable();
            $table->string('subproperty_of', 50)->nullable();
            $table->string('superproperty_of', 50)->nullable();

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('ontology_relations', function (Blueprint $table) {
            //
        });
    }
}
