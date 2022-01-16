<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCategoriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('categories', function (Blueprint $table) {
            $table->id();
            $table->integer('cat_id');
            $table->string('title');
            $table->enum('status', ['active', 'blocked', 'deleted'])->default('active');
            $table->enum('type', ['malaka', 'ixtisos']);
            $table->timestamps();
        });
        DB::table('categories')->insert([
            [
                'cat_id' => 73,
                'title' => 'Davolash ishi',
                'type' => 'malaka',
            ],
            [
                'cat_id' => 74,
                'title' => 'Umumiy amaliyot akusheri',
                'type' => 'malaka',
            ],
            [
                'cat_id' => 78,
                'title' => 'Hamshiralik ishi',
                'type' => 'malaka'
            ]
        ]);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down (){
        Schema::dropIfExists('categories');
    }
}
