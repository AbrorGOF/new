<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAcceptNurseLogTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('accept_nurse_log', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('accepted_user_id');
            $table->unsignedBigInteger('nurse_id');
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
        Schema::dropIfExists('accept_nurse_log');
    }
}
