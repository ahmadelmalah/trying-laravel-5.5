<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSheetsLinksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sheets_links', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('sheet_id')->unsigned();
            $table->foreign('sheet_id')->references('id')->on('sheets')->onDelete('cascade');
            $table->string('url');
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
        Schema::dropIfExists('sheets_links');
    }
}
