<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateStocksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('stocks', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('tech_card_id');
            $table->bigInteger('employee_id')->nullable();
            $table->integer('library')->nullable();
            $table->integer('author')->nullable();
            $table->date('start_date')->nullable();
            $table->date('completed_date')->nullable();
            $table->enum('status', ['Получено', 'Передан автору'])->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('stocks');
    }
}
