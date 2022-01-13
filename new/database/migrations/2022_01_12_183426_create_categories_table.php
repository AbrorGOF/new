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
                'cat_id' => 72,
                'title' => 'Клиник биохимик лаборатория лаборанти',
                'type' => 'ixtisos',
            ],
            [
                'cat_id' => 83,
                'title' => 'Анестезист(ка) ҳамшира',
                'type' => 'malaka',
            ],
            [
                'cat_id' => 85,
                'title' => 'Даволаш профилактика муассасаларида акушерлик ва гинекологик ёрдам кўрсатиш',
                'type' => 'malaka'
            ],
            [
                'cat_id' => 86,
                'title' => 'Соғлом ва бемор болаларда ҳамширалик иши',
                'type' => 'malaka'
            ],
            [
                'cat_id' => 87,
                'title' => 'Гематология ва трансфузиологияда ҳамширалик иши',
                'type' => 'malaka'
            ],
            [
                'cat_id' => 88,
                'title' => 'Дерматовенерология ва косметологияда ҳамширалик иши',
                'type' => 'malaka'
            ],
            [
                'cat_id' => 89,
                'title' => 'Замонавий жарроҳликда ҳамширалик иши',
                'type' => 'malaka'
            ],
            [
                'cat_id' => 90,
                'title' => 'Ички касалликларда ҳамширалик иши',
                'type' => 'malaka'
            ],
            [
                'cat_id' => 91,
                'title' => 'Карантин ва ўта хавфли инфекцияларда замонавий текшириш усуллари',
                'type' => 'malaka'
            ],
            [
                'cat_id' => 92,
                'title' => 'Лаборатория ишида замонавий текшириш усуллари',
                'type' => 'malaka'
            ],
            [
                'cat_id' => 93,
                'title' => 'Массаж ҳамшираси',
                'type' => 'malaka'
            ],
            [
                'cat_id' => 94,
                'title' => 'Мактабгача таълим ва таълим муассасалари ҳамшираси',
                'type' => 'malaka'
            ],
            [
                'cat_id' => 95,
                'title' => 'Неонатологияда ҳамширалик иши',
                'type' => 'malaka'
            ],
            [
                'cat_id' => 96,
                'title' => 'Нефрология ва гемодиализда ҳамширалик иши',
                'type' => 'malaka'
            ],
            [
                'cat_id' => 97,
                'title' => 'Нур терапияда ҳамширалик иши',
                'type' => 'malaka'
            ],
            [
                'cat_id' => 98,
                'title' => 'Ортопедик стоматологияда янги технологиялар',
                'type' => 'malaka'
            ],
            [
                'cat_id' => 99,
                'title' => 'Тез тиббий ёрдам тизимида аҳолига  фельдшер парамедик хизматини кўрсатиш',
                'type' => 'malaka'
            ],
            [
                'cat_id' => 100,
                'title' => 'Реанимация ва интенсив терапияда ҳамширалик иши',
                'type' => 'malaka'
            ],
            [
                'cat_id' => 101,
                'title' => 'Руҳий касалликлар ва наркологияда ҳамширалик иши',
                'type' => 'malaka'
            ],
            [
                'cat_id' => 102,
                'title' => 'Спорт тиббиёти ҳамшираси',
                'type' => 'malaka'
            ],
            [
                'cat_id' => 103,
                'title' => 'Тиббий статистика ва замонавий компьютер технологиялари',
                'type' => 'malaka'
            ],
            [
                'cat_id' => 104,
                'title' => 'Тиббий - асбоб ва анжомларни замонавий зарарсизлантириш усуллари',
                'type' => 'malaka'
            ],
            [
                'cat_id' => 105,
                'title' => 'Стоматологияда ҳамширалик иши',
                'type' => 'malaka'
            ],
            [
                'cat_id' => 106,
                'title' => 'Суд тиббиёт экспертиза ва патологик анатомия хизматини кўрсатиш',
                'type' => 'malaka'
            ],
            [
                'cat_id' => 107,
                'title' => 'Санитария -эпидемиологик осойишталик ва жамоат саломатлиги хизмати врач ёрдамчиси',
                'type' => 'malaka'
            ],
            [
                'cat_id' => 108,
            'title' => 'Санитария -эпидемиологик осойишталик ва жамоат саломатлиги хизмати лаборатория лаборанти',
                'type' => 'malaka'
            ],
            [
                'cat_id' => 109,
                'title' => 'Тиббий меҳнат экспертизасида ҳамширалик иши',
                'type' => 'malaka'
            ],
            [
                'cat_id' => 110,
                'title' => 'Тез тиббий ёрдам диспетчери',
                'type' => 'malaka'
            ],
            [
                'cat_id' => 111,
                'title' => 'Фармацевт ассистенти',
                'type' => 'malaka'
            ],
            [
                'cat_id' => 112,
                'title' => 'Физиотерапияда ҳамширалик иши',
                'type' => 'malaka'
            ],
            [
                'cat_id' => 113,
                'title' => 'Сил касалликлари профилактикаси ва парваришида ҳамширалик иши',
                'type' => 'malaka'
            ],
            [
                'cat_id' => 114,
                'title' => 'Замонавий клиник - функционал текширувларга пациентларни ва аппаратларни тайёрлаш',
                'type' => 'malaka'
            ],
            [
                'cat_id' => 115,
                'title' => 'Хавфсиз иммунизация',
                'type' => 'malaka'
            ],
            [
                'cat_id' => 116,
            'title' => 'Шошилинч тиббий ёрдам кўрсатиш',
            'type' => 'malaka'
            ],
            [
                'cat_id' => 117,
                'title' => 'Болалар ва катталар юқумли касалликларида ҳамширалик иши',
                'type' => 'malaka'
            ],
            [
                'cat_id' => 118,
                'title' => 'Рентген лаборанти',
                'type' => 'malaka'
            ],
            [
                'cat_id' => 119,
                'title' => 'Тиббиёт бригада ҳамширалари',
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
