<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AlterColumnInOntologiesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('ontologies', function (Blueprint $table) {
            $table->string('general_purpose', 500)->change();
            $table->string('scope', 500)->change();
            $table->string('competence_questions', 500)->change();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('ontologies', function (Blueprint $table) {
            //
        });
    }
}
