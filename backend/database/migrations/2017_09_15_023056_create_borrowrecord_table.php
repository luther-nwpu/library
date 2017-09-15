<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBorrowrecordTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('borrowrecord', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id')->unsigned();
            $table->foreign('user_id')
                  ->references('id')->on('users')
                  ->onDelete('cascade');
            $table->timestamp('return_time');
            $table->integer('book_id')->unsigned();
            $table->foreign('book_id')
                  ->references('id')->on('books')
                  ->onDelete('cascade');
            $table->integer('type_id')->unsigned();
            $table->foreign('type_id')
                  ->references('id')->on('borrowtypes')
                  ->onDelete('cascade');
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
        Schema::dropIfExists('borrowrecord');
    }
}
