<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOpenTimesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('open_times', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->text('day');
            $table->text('dayFr');
            $table->time('morningOpen')->nullable();
            $table->time('morningClose')->nullable();
            $table->time('nightOpen')->nullable();
            $table->time('nightClose')->nullable();
            $table->boolean('morningIsClose');
            $table->boolean('nigthIsClose');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('open_times');
    }
}
