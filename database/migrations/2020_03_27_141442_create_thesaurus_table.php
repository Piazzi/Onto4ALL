<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateThesaurusTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('thesaurus', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name');
            $table->date('publication_date')->nullable();
            $table->date('last_uploaded')->nullable();
            $table->text('description')->nullable();
            $table->string('created_by')->nullable();
            $table->string('domain')->nullable();
            $table->string('profile_users')->nullable();
            $table->text('file');
            $table->unsignedInteger('user_id');
            $table->foreign('user_id')->references('id')->on('users');
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
        Schema::dropIfExists('thesaurus');
    }
}
