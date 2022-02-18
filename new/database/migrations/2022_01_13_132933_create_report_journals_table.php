<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateReportJournalsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('report_journals', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->string('patient_full_name');
            $table->tinyInteger('patient_age');
            $table->timestamp('patient_visit_time');
            $table->string('patient_address');
            $table->string('doctor_full_name');
            $table->string('doctor_diagnosis');
            $table->string('treatment_name');
            $table->unsignedBigInteger('category_id');
            $table->string('others')->nullable(true);
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
        Schema::dropIfExists('report_journals');
    }
}
