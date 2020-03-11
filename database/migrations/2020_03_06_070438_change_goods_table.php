<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class ChangeGoodsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('goods', function (Blueprint $table) {
            $table->renameColumn('user_id', 'shop_id');  //重命名所属商家id字段名
            $table->integer('status')->default(1)->comment('1代表未销售可购买 2代表已销售');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('goods', function (Blueprint $table) {
            $table->renameColumn('shop_id', 'user_id');
            $table->dropColumn('status');
        });
    }
}
