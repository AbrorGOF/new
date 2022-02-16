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
            $table->unsignedBigInteger('parent_id')->nullable();
            $table->string('name');
            $table->string('phone')->unique();
            $table->string('type')->nullable();
            $table->string('role')->nullable();
            $table->string('status')->default('active');
            $table->string('email')->unique()->nullable();
            $table->string('password');
            $table->rememberToken();
            $table->timestamps();
        });
        DB::table('users')
            ->insert([
                'name' => 'Odilbek Raxmonov',
                'type' => 'admin',
                'role' => '1',
                'phone' => '998909999341',
                'email' => 'admin@gx.uz',
                'password' => bcrypt('odilbekda'),
                'status' => 'active',
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
