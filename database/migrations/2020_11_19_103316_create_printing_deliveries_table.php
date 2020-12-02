<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePrintingDeliveriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('printing_deliveries', function (Blueprint $table) {
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

            $table->string('soft_cover_paper')->nullable();      // Бумага на обложку(мягкий)
            $table->string('soft_cover_paper_colorfulness')->nullable(); // Красочность
            $table->enum('soft_cover_wrap_pressing_type', ['Матовый', 'Глянцевый'])->nullable();    // Припрессовка пленки

            $table->string('hard_cover_paper')->nullable();      // Бумага на обложку(твердый)
            $table->string('hard_cover_paper_colorfullness')->nullable(); // Красочность
            $table->enum('hard_cover_wrap_pressing_type', ['Матовый', 'Глянцевый'])->nullable();    // Припрессовка пленки

            $table->integer('soft_binding_count')->nullable();   // Мягкий переплет(к-во)
            $table->integer('hard_binding_count')->nullable();   // Твердый переплет(к-во)

            $table->string('colored_pages')->nullable();    // Цветные страницы

            $table->text('remark')->nullable();    // Замечания

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
        Schema::dropIfExists('printing_deliveries');
    }
}
