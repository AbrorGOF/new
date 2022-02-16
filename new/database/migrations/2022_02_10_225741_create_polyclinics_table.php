<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePolyclinicsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('polyclinics', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('address');
            $table->string('phone');
            $table->unsignedBigInteger('region_id');
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('city_id')->nullable();
            $table->string('training_center_id')->nullable();
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
        Schema::dropIfExists('polyclinics');
    }
}
