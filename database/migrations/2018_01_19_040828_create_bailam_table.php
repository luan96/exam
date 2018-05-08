<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBailamTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('bailam', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id');
            $table->integer('makythi');
            $table->integer('madethi');
            $table->integer('macauhoi');
            $table->float('diemcauhoi');
            $table->string('noidungcauhoi');
            $table->string('dapancauhoi');
            $table->string('noidungtraloi');
            $table->string('dapancuathisinh');
            $table->float('diemcauhoicuathisinh');
            $table->string('trangthailambai');
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
        Schema::dropIfExists('bailam');
    }
}
