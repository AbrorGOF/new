<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateNurseReferencesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('nurse_references', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('nurse_id');
            $table->unsignedBigInteger('user_id');
            $table->string('file');
            $table->string('status');
            $table->timestamps();
        });
      Schema::table('nurse_references', function (Blueprint $table) {
        $table->foreign('nurse_id')
          ->references('id')
          ->on('nurses');
        $table->foreign('user_id')
          ->references('id')
          ->on('users');
      });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('nurse_references');
    }
}
