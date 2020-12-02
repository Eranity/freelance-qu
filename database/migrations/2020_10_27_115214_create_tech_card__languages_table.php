<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTechCardLanguagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tech_card__languages', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('tech_card_id');
            $table->enum('language', ['Казахский', 'Руский', 'Английский', 'Другой']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tech_card__languages');
    }
}
