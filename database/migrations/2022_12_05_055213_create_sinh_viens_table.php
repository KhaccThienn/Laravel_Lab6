<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sinh_vien', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name', 100);
            $table->string('email', 100)->unique();
            $table->string('password', 100);
            $table->string('phone', 50)->unique();
            $table->string('address')->nullable();
            $table->integer('class_id')->unsigned();
            $table->timestamps();

            $table->foreign('class_id')->references('id')->on('lop_hoc');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('sinh_vien', function (Blueprint $table){
            $table->dropForeign('sinh_vien_class_id_foreign');
        });
        Schema::dropIfExists('sinh_vien');
    }
};
