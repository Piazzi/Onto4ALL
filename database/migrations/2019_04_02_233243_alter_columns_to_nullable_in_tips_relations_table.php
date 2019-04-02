<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AlterColumnsToNullableInTipsRelationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('tips_relations', function (Blueprint $table) {
            $table->string('similar_relation')->nullable()->change();
            $table->integer('cardinality')->nullable()->change();
            $table->string('imported_from')->nullable()->change();
            $table->renameColumn('description', 'definition')->nullable()->change();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('tips_relations', function (Blueprint $table) {
            //
        });
    }
}
