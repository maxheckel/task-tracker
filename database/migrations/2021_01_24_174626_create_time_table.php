<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTimeTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('time', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->dateTime('start_time')->nullable();
            $table->dateTime('end_time')->nullable();
            $table->boolean('is_running')->default(false);
            $table->integer('user_id');
            $table->integer('task_id');
            $table->integer('time');
            $table->boolean('billable');
            $table->boolean('was_billed')->default(false);
            $table->integer('invoice_id')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('time');
    }
}
