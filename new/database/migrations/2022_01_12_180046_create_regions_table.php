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
                'title' => 'Тошкент шахри',
                'link' => 'https://toshkent.imedic.uz/api/method/cabinet.check'
            ],
            [
                'title' => 'Тошкент вилояти',
                'link' => 'https://toshkent.imedic.uz/api/method/cabinet.check'
            ],
            [
                'title' => 'Самарканд вилояти',
                'link' => 'https://samarqand.imedic.uz/api/method/cabinet.check'
            ],
            [
                'title' => 'Жиззах вилояти',
                'link' => 'https://jizzax.imedic.uz/api/method/cabinet.check'
            ],
            [
                'title' => 'Сирдарё вилояти',
                'link' => 'https://guliston.imedic.uz/api/method/cabinet.check'
            ],
            [
                'title' => 'Фаргона вилояти',
                'link' => 'https://fargona.imedic.uz/api/method/cabinet.check'
            ],
            [
                'title' => 'Андижон вилояти',
                'link' => 'https://andijon.imedic.uz/api/method/cabinet.check'
            ],
            [
                'title' => 'Кашакадарё вилояти',
                'link' => 'https://qarshi.imedic.uz/api/method/cabinet.check'
            ],
            [
                'title' => 'Наманган вилояти',
                'link' => 'https://namangan.imedic.uz/api/method/cabinet.check'
            ],
            [
                'title' => 'Сурхондарё вилояти',
                'link' => 'https://termiz.imedic.uz/api/method/cabinet.check'
            ],
            [
                'title' => 'Бухоро вилояти',
                'link' => 'https://buxoro.imedic.uz/api/method/cabinet.check'
            ],
            [
                'title' => 'Навоий вилояти',
                'link' => 'https://navoiy.imedic.uz/api/method/cabinet.check'
            ],
            [
                'title' => 'Коракалпогистон Республикаси',
                'link' => 'https://nukus.imedic.uz/api/method/cabinet.check'
            ],
            [
                'title' => 'Хоразм вилояти',
                'link' => 'https://urganch.imedic.uz/api/method/cabinet.check'
            ],
            [
                'title' => 'Кукон шахри',
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
