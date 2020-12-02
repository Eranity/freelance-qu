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
            $table->bigInteger('tech_id');
            $table->longText('description');
            $table->longText('editor_requirements');
            $table->longText('designer_requirements');
            $table->longText('templator_requirements');
            $table->float('budget');
            $table->boolean('is_rush')->default(false);
            $table->timestamp('created_date')->useCurrent();
            $table->timestamp('deadline')->useCurrent();
            $table->timestamp('completion_date')->useCurrent();
            $table->enum('status', ['Новый', 'В работе', 'Завершенный']);
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
