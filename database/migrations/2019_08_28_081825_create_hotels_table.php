<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateHotelsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('hotels', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('province_id');
            $table->integer('city_id');
            $table->integer('user_id');
            $table->string('name');
            $table->string('slug');
            $table->string('address');
            $table->text('about')->nullable();
            $table->string('email');
            $table->string('phone1');
            $table->string('phone2')->nullable();
            $table->string('map')->nullable();
            $table->string('facebook');
            $table->string('instagram')->nullable();
            $table->string('website')->nullable();
            $table->integer('category');
            $table->string('image')->nullable();
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
        Schema::dropIfExists('hotels');
    }
}
