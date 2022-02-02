<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRegionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('regions', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('link');
        });
        DB::table('regions')->insert([
            [
                'title' => 'Toshkent shahri',
                'link' => 'https://toshkent.imedic.uz/api/method/cabinet.check'
            ],
            [
                'title' => 'Toshkent viloyati',
                'link' => 'https://toshkent.imedic.uz/api/method/cabinet.check'
            ],
            [
                'title' => 'Samarqand viloyati',
                'link' => 'https://samarqand.imedic.uz/api/method/cabinet.check'
            ],
            [
                'title' => 'Jizzax viloyati',
                'link' => 'https://jizzax.imedic.uz/api/method/cabinet.check'
            ],
            [
                'title' => 'Sirdaryo viloyati',
                'link' => 'https://guliston.imedic.uz/api/method/cabinet.check'
            ],
            [
                'title' => 'Fargona viloyati',
                'link' => 'https://fargona.imedic.uz/api/method/cabinet.check'
            ],
            [
                'title' => 'Andijon viloyati',
                'link' => 'https://andijon.imedic.uz/api/method/cabinet.check'
            ],
            [
                'title' => 'Qashqadaryo viloyati',
                'link' => 'https://qarshi.imedic.uz/api/method/cabinet.check'
            ],
            [
                'title' => 'Namangan viloyati',
                'link' => 'https://namangan.imedic.uz/api/method/cabinet.check'
            ],
            [
                'title' => 'Surxandaryo viloyati',
                'link' => 'https://termiz.imedic.uz/api/method/cabinet.check'
            ],
            [
                'title' => 'Buxoro viloyati',
                'link' => 'https://buxoro.imedic.uz/api/method/cabinet.check'
            ],
            [
                'title' => 'Navoiy viloyati',
                'link' => 'https://navoiy.imedic.uz/api/method/cabinet.check'
            ],
            [
                'title' => 'Qoraqalpog`iston Respublikasi',
                'link' => 'https://nukus.imedic.uz/api/method/cabinet.check'
            ],
            [
                'title' => 'Xorazm viloyati',
                'link' => 'https://urganch.imedic.uz/api/method/cabinet.check'
            ],
            [
                'title' => 'Qo`qon шахри',
                'link' => 'https://qoqon.imedic.uz/api/method/cabinet.check'
            ],
        ]);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('regions');
    }
}
