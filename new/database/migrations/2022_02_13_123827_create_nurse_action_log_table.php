<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateNurseActionLogTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('nurse_action_log', function (Blueprint $table) {
          $table->id();
          $table->unsignedBigInteger('user_id');
          $table->unsignedBigInteger('nurse_id');
          $table->string('action');
          $table->string('reason')->nullable();
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
        Schema::dropIfExists('nurse_action_log');
    }
}
