<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTechCardWorkTypesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tech_card__work_types', function (Blueprint $table) {
            $table->id();

            $table->bigInteger('tech_card_id');
            $table->bigInteger('work_type_id');
            $table->integer('unit_count')->nullable();

            $table->date('start_date')->nullable();
            $table->date('deadline')->nullable();
            $table->integer('hours')->nullable();

            $table->bigInteger('stage_id')->nullable();
            $table->date('completed_date')->nullable();
            $table->bigInteger('responsible_id')->nullable();
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
        Schema::dropIfExists('tech_card__work_types');
    }
}
