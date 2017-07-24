<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCommentsTable extends Migration
{
    /**
     * Run the migrations.
     *id    int PK
father_id   int FK trỏ đến comment gốc
        (nếu nó là comment trả lời)
trip_id int FK
user_id int FK
pictures    int FK 
created_at  timestamp   
updated_at  timestamp   

     * @return void
     */
    public function up()
    {
        Schema::create('comments', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('father_id')->nullable();
            $table->integer('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->integer('trip_id')->references('id')->on('trips')->onDelete('cascade');
            $table->integer('picture_id')->nullable()->references('id')->on('pictures')->onDelete('cascade');
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
        Schema::dropIfExists('comments');
    }
}
