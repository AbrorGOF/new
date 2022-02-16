<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDiplomTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('nurse_diplomas', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('nurse_id');
            $table->unsignedBigInteger('college_id');
            $table->string('number');
            $table->date('date');
            $table->tinyInteger('degree');
            $table->string('file');
            $table->timestamps();
        });
        Schema::create('nurse_certificates', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('nurse_id');
            $table->unsignedBigInteger('training_center_id');
            $table->string('number');
            $table->date('date');
            $table->date('end_date');
            $table->string('file');
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
        Schema::dropIfExists('diplom');
    }
}
