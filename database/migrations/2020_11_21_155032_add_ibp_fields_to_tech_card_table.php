<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddIbpFieldsToTechCardTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('tech_cards', function (Blueprint $table) {
            $table->enum('type', ['tech_card', 'ibp'])->default('tech_card');
            $table->enum('product_type', ['ИБ', 'Книжно/Журн.'])->nullable();
            $table->enum('complexity', ['Шаблон', 'Стандарт', 'Сложный'])->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('tech_cards', function (Blueprint $table) {
            $table->dropColumn('type');
            $table->dropColumn('product_type');
            $table->dropColumn('complexity');
        });
    }
}
