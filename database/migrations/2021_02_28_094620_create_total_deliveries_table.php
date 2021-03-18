<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTotalDeliveriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('total_deliveries', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->date('deli_date');
            $table->decimal('total_tr',12, 2)->default(0.00);
            $table->decimal('total_money',12, 2)->default(0.00);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('total_deliveries');
    }
}
