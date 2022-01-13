<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDeskLogsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('desk_logs', function (Blueprint $table) {
            $table->id();
            $table->text('request');
            $table->text('response')->nullable(true);
            $table->bigInteger('pinfl')->nullable(true);
            $table->Integer('inn')->nullable(true);
            $table->string('status')->nullable(true);
            $table->string('http_code')->nullable(true);
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
        Schema::dropIfExists('desk_logs');
    }
}
