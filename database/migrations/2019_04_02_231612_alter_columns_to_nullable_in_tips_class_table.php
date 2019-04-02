<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AlterColumnsToNullableInTipsClassTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('tips_class', function (Blueprint $table) {
            $table->string('superclass')->nullable()->change();
            $table->string('subclass')->nullable()->change();
            $table->string('synonyms')->nullable()->change();
            $table->string('imported_from')->nullable()->change();
            $table->renameColumn('description', 'definition');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('tips_class', function (Blueprint $table) {
            //
        });
    }
}
