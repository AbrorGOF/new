<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('surname');
            $table->string('patronym')->nullable();
            $table->string('phone')->unique();
            $table->string('passport');
            $table->string('pinfl');
            $table->bigInteger('category_id');
            $table->bigInteger('region_id');
            $table->string('central_polyclinic');
            $table->string('family_polyclinic');
            $table->string('doctor_station');
            $table->string('reference')->nullable();
            $table->enum('type', ['worker', 'nurse'])->nullable();
            $table->string('role')->nullable();
            $table->string('email')->unique()->nullable();
            $table->string('password');
            $table->rememberToken();
            $table->timestamps();
        });
        DB::table('users')
            ->insert([
                'name' => 'Odilbek',
                'surname' => 'Raxmonov',
                'patronym' => 'Orifjon ogli',
                'passport' => 'AA1234567',
                'pinfl' => '3123456789',
                'type' => 'worker',
                'role' => '1',
                'phone' => '998909999341',
                'email' => 'admin@gx.uz',
                'password' => bcrypt('odilbekda'),
                'central_polyclinic' => '1',
                'family_polyclinic' => '1',
                'doctor_station' => '1',
                'region_id' => '1',
                'category_id' => '1',
                'reference' => '/123/12.pdf',
            ]);

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('users');
    }
}
