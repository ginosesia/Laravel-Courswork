<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCommentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('comments', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->mediumText('comment');
            $table->string('email');
            $table->string('name');
            $table->boolean('approved');
            $table->unsignedBigInteger('post_id')->unsigned();   
            $table->unsignedBigInteger('user_id')->unsigned();
            $table->timestamps();

        });

         Schema::table('comments', function ($table) {
             $table->foreign('post_id')->references('id')->on('posts')->onDelete('cascade');
         });

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
         Schema::table('comments', function (Blueprint $table) {
             $table->dropForeign(['post_id']);
         });
        Schema::dropIfExists('comments');
    }
}

