<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
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
            $table->enum('type', ['worker', 'nurse']);
            $table->string('role');
            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();
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
                'password' => bcrypt('odilbekda')
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
