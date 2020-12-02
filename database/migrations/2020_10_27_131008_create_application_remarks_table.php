<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateApplicationRemarksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('application_remarks', function (Blueprint $table) {
            $table->id();
            $table->string('subject');
            $table->string('content');
            $table->string('application_id');
            $table->string('file')->nullable();
            $table->string('comment')->nullable();
            $table->boolean('is_answered')->nullable();
            $table->timestampTz('created_at')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('application_remarks');
    }
}
