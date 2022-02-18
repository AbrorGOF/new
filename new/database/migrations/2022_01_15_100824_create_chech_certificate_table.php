<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateChechCertificateTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('check_certificate', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('category_id')->nullable(true);
            $table->unsignedBigInteger('region_id')->nullable(true);
            $table->string('passport')->nullable(true);
            $table->text('receive')->nullable(true);
            $table->text('error')->nullable(true);
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
        Schema::dropIfExists('chech_certificate');
    }
}
