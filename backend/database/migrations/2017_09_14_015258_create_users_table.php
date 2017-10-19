<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->increments('id');              // 主键自增
            $table->string('password');            // 'password'
            $table->string('email');               // 'email'唯一
            $table->string('usercode');  // 一卡通的hash值
            $table->string('usernumber');          // 学号
            $table->string('username');            // 姓名
            $table->integer('imageid');
            $table->string('userinfo');             // 学生信息
            $table->string('useruniversity');
            $table->string('usercollege');
            $table->timestamps();                   //自动生成时间戳记录创建更新时间
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('users');
    }
}
