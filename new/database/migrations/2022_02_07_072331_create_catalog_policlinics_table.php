<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCatalogPoliclinicsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('catalog_polyclinics', function (Blueprint $table) {
            $table->id();
            $table->string('okpo', 24)->nullable();
            $table->string('tin', 24)->nullable();
            $table->string('full_title', 200)->nullable();
            $table->string('short_title', 200)->nullable();
            $table->string('csdp', 8)->nullable();
            $table->string('soato', 24)->nullable();
            $table->string('address', 100)->nullable();
            $table->string('street', 100)->nullable();
            $table->string('phone', 100)->nullable();
            $table->string('email', 64)->nullable();
            $table->string('oked', 8)->nullable();
            $table->string('soogu', 8)->nullable();
            $table->string('ptp', 8)->nullable();
            $table->string('prize', 8)->nullable();
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
        Schema::dropIfExists('catalog_policlinics');
    }
}
