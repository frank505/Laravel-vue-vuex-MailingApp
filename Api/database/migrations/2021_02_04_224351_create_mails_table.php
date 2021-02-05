<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('mails', function (Blueprint $table) {
            $table->id();
            $table->string('uuid')->unique();
            $table->bigInteger('posted_by_id')->unsigned();
            $table->foreign('posted_by_id')->references('id')->on('users');
            $table->string('from');
            $table->string('to');
            $table->string('subject');
            $table->string('text_content');
            $table->string('html_content',500);
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
        Schema::dropIfExists('mails');
    }
}
