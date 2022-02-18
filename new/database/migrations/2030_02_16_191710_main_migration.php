<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class MainMigration extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('nurses', function (Blueprint $table) {
            $table->foreign('user_id')
                ->references('id')
                ->on('users');
            $table->foreign('category_id')
                ->references('id')
                ->on('categories');
            $table->foreign('region_id')
                ->references('id')
                ->on('regions');
            $table->foreign('polyclinic_id')
                ->references('id')
                ->on('polyclinics');
        });
        Schema::table('doctors', function (Blueprint $table) {
            $table->foreign('user_id')
                ->references('id')
                ->on('users');
            $table->foreign('region_id')
                ->references('id')
                ->on('regions');
            $table->foreign('polyclinic_id')
                ->references('id')
                ->on('polyclinics');
        });
        Schema::table('workers', function (Blueprint $table) {
            $table->foreign('user_id')
                ->references('id')
                ->on('users');
            $table->foreign('region_id')
                ->references('id')
                ->on('regions');
            $table->foreign('training_center_id')
                ->references('id')
                ->on('training_center');
        });
        Schema::table('nurse_action_log', function (Blueprint $table) {
            $table->foreign('user_id')
                ->references('id')
                ->on('users');
            $table->foreign('nurse_id')
                ->references('id')
                ->on('nurses');
        });
        Schema::table('polyclinics', function (Blueprint $table) {
            $table->foreign('user_id')
                ->references('id')
                ->on('users');
            $table->foreign('region_id')
                ->references('id')
                ->on('regions');
            $table->foreign('training_center_id')
                ->references('id')
                ->on('training_center');
        });
        Schema::table('nurse_certificates', function (Blueprint $table) {
            $table->foreign('nurse_id')
                ->references('id')
                ->on('nurses');
            $table->foreign('training_center_id')
                ->references('id')
                ->on('training_center');
        });
        Schema::table('nurse_diplomas', function (Blueprint $table) {
            $table->foreign('nurse_id')
                ->references('id')
                ->on('nurses');
            $table->foreign('college_id')
                ->references('id')
                ->on('colleges');
        });
        Schema::table('report_journals', function (Blueprint $table) {
            $table->foreign('user_id')
                ->references('id')
                ->on('users');
        });
        Schema::table('report_quarterlies', function (Blueprint $table) {
            $table->foreign('user_id')
                ->references('id')
                ->on('users');
            $table->foreign('category_id')
                ->references('id')
                ->on('report_categories');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
}
