<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class CreateReportCategiesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('report_categories', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->tinyInteger('type')->nullable(true)->comment('1-mustaqil, 2-doktor tafsiyasi');
            $table->string('title_ru')->nullable(true);
            $table->string('title_krill')->nullable(true);
            $table->string('title_eng')->nullable(true);
            $table->timestamps();
        });
        DB::table('report_categories')->insert([
            [
                'title' => 'Bemorlar soni',
                'type' => null
            ],
            [
                'title' => 'Murojaatlar soni',
                'type' => null
            ],
            [
                'title' => 'Profilaktik tadbirlar',
                'type' => 1
            ],
            [
                'title' => 'Diagnostik tadbirlar',
                'type' => 1
            ],
            [
                'title' => 'Hamshiralik parvarishi',
                'type' => 1
            ],
            [
                'title' => 'Shoshilinch tibbiy yordam',
                'type' => 1
            ],
            [
                'title' => 'Palliativ tibbiy yordam',
                'type' => 1
            ],
            [
                'title' => 'Sog‘lom turmush tarzi bo‘yicha tadbirlar',
                'type' => 1
            ],
            [
                'title' => 'Boshqalar',
                'type' => 1
            ],
            [
                'title' => 'Profilaktik tadbirlar',
                'type' => 2
            ],
            [
                'title' => 'Diagnostik tadbirlar',
                'type' => 2
            ],
            [
                'title' => 'Hamshiralik parvarishi',
                'type' => 2
            ],
            [
                'title' => 'Inyeksiyalar',
                'type' => 2
            ],
            [
                'title' => 'Muolajalar  tibbiy massaj',
                'type' => 2
            ],
            [
                'title' => 'Muolajalar davolovchi gimnastika',
                'type' => 2
            ],
            [
                'title' => 'Shoshilinch tibbiy yordam',
                'type' => 2
            ],
            [
                'title' => 'Palliativ tibbiy yordam',
                'type' => 2
            ],
            [
                'title' => 'Sog‘lom turmush tarzi bo‘yicha tadbirlar',
                'type' => 2
            ],
            [
                'title' => 'Boshqalar',
                'type' => 2
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
        Schema::dropIfExists('report_categies');
    }
}
