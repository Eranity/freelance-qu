<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSecondSignalsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('second_signals', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('tech_card_id');


            $table->integer('number_of_copies')->nullable();    // Количество экземпляров
            $table->string('format')->nullable();   // Формат

            $table->integer('total_pages')->nullable();     // Общее количество страниц
            $table->integer('colored_count')->nullable();   // Из них цветные
            $table->integer('inserts_count')->nullable();   // Из них вклейки

            $table->string('text_paper')->nullable();       // Бумага на текст
            $table->string('text_paper_colorfulness')->nullable(); // Красочность

            $table->string('insert_paper')->nullable();     // Бумага на вклейки
            $table->string('insert_paper_colorfulness')->nullable(); // Красочность

            $table->string('cover_paper')->nullable();      // Бумага на обложку
            $table->string('cover_paper_colorfulness')->nullable(); // Красочность

            $table->enum('binding_type', ['Мягкий', 'Твердый'])->nullable();    // Вид переплета

            $table->string('colored_pages')->nullable();    // Цветные страницы

            $table->date('start_date')->nullable();
            $table->date('completed_date')->nullable();

            $table->enum('status', ['В процессе', 'Завершено'])->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('second_signals');
    }
}
