<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateShortUrl extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('short_url', function (Blueprint $table) {
            $table->increments('id')->autoIncrement();
            $table->string('code',8)->default('')->comment('短网址code');
            $table->string('long_url',1024)->default('')->comment('长网址');
            $table->timestamp('created_at')->useCurrent()->comment('创建时间');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('short_url');
    }
}
