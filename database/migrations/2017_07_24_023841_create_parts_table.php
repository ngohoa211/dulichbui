<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePartsTable extends Migration
{
    /**
     * Run the migrations.
     *parts     
field   type    description
id  int PK
trip_id int FK
name    varchar tên
status  int xác định vị trí trong trip
        Vd: 0-chặng đầu
start_latitude  float   Vĩ độ khởi đầu
start_longitude float   Kinh độ khởi đầu
end_latitude    float   Vĩ độ kết thúc
end_longitude   float   Kinh độ kết thúc
start_date  datetime    thời gian bắt đầu đi
end_date    datetime    thời gian kết thúc đi
activiti    varchar hoạt động
move_by varchar phương tiện di chuyển
created_at  timestamp   
updated_at  timestamp   

     * @return void
     */
    public function up()
    {
        Schema::create('parts', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('trip_id')->references('id')->on('trips')->onDelete('cascade');
            $table->string('name');
            $table->integer('status');
            $table->float('start_latitude',16,13);
            $table->float('start_longitude',16,13);
            $table->float('end_latitude',16,13);
            $table->float('end_longitude',16,13);
            $table->datetime('start_date');
            $table->datetime('end_date');
            $table->string('activiti')->nullable();
            $table->string('move_by');
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
        Schema::dropIfExists('parts');
    }
}
