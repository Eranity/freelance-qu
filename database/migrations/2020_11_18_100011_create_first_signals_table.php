<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFirstSignalsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('first_signals', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('tech_card_id');
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
        Schema::dropIfExists('first_signals');
    }
}
