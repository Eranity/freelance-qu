<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTechCardsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tech_cards', function (Blueprint $table) {
            $table->id();

            $table->string('order_number')->unique();
            $table->string('ib_number');    // Номер ИБ
            $table->string('isbn')->unique();
            $table->string('book_name');

            $table->bigInteger('application_id');
            $table->bigInteger('edition_id');
            $table->enum('payment', ['Университет', 'Автор', 'Грант', 'Университет-Автор']);
            $table->string('department');
            $table->string('templan');

            $table->string('riso_protocol_number'); // РИСО: протокол №
            $table->date('riso_protocol_date');

            $table->string('ac_protocol_number'); // Academic Council - Ученый совет КазНУ
            $table->date('ac_protocol_date');

            $table->string('rums_protocol_number'); // РУМС: протокол №
            $table->date('rums_protocol_date');

            $table->enum('manuscript', ['Электронный вариант', 'Бумажный вариант', 'Электронный и бумажный', 'нет']);   // Рукопись

            $table->integer('total_pages');
            $table->integer('total_symbols');
            $table->integer('author_sheet_volume'); // Объем в а.л.
            $table->string('format');
            $table->string('kegel');
            $table->enum('editing_complexity', [1, 2, 3]);  // Сложность редактуры
            $table->enum('layout_complexity', [1, 2, 3]);   // Сложность верстки


            $table->string('ioot');

            $table->string('conclusion')->nullable();  // Заключение доредакционной экспертизы

            $table->integer('circulation_author');  // Тираж(автор)
            $table->integer('circulation_university');  // Тираж(университет)
            $table->integer('circulation_library'); // из них в библиотеку

            $table->bigInteger('project_manager_id');

            $table->date('created_date');
            $table->date('appointment_date');

            $table->enum('status', ['Создано', 'Оформлена']);

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tech_cards');
    }
}
