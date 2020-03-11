<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateGoodsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('goods', function (Blueprint $table) {
            $table->uuid('id')->primary();
            //物品名称
            $table->string('name',32);  
            //作者
            $table->string('author',32);
            //简介
            $table->string('intro',100); 
            //尺寸
            $table->string('size',16);
            //价格
            $table->decimal('price', 8, 2);
            //图片资源地址
            $table->string('imgUrl');
            //工艺品类型id
            $table->integer('genre_id');
            //所属商家ID
            $table->uuid('user_id');
            $table->timestamps();

        });


        Schema::table('users', function (Blueprint $table) {
            $table->string('email');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('goods');
    }
}

