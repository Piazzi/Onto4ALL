<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddColumnsToOntologiesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('ontologies', function (Blueprint $table) {
            $table->string('domain')->nullable();
            $table->string('general_purpose')->nullable();
            $table->string('profile_users')->nullable();
            $table->string('intended_use')->nullable();
            $table->string('type_of_ontology')->nullable();
            $table->string('degree_of_formality')->nullable();
            $table->string('scope')->nullable();
            $table->string('competence_questions')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('ontology', function (Blueprint $table) {
            //
        });
    }
}
