<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProjectsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('Projects', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->bigInteger('description');
            $table->longText('tech_id');
            $table->float('budget');
            $table->boolean('is_rush');
            $table->timestamp('created_date',0);
            $table->timestamp('deadline',0);
            $table->timestamp('completion_date',0);
            $table->enum('status', ['new', 'in progres', 'done']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('Projects');
    }
}
