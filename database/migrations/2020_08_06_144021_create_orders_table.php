<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->string('orderId');
            $table->date('deliDate');
            $table->json('orderList');
            $table->string('utensils');
            $table->string('payMethod');
            $table->decimal('ticketResto',12, 2)->default(0.00);
            $table->decimal('cbResto',12, 2)->default(0.00);
            $table->decimal('totalPrice',12, 2);
            $table->decimal('tva6',12, 2);
            $table->decimal('tva10',12, 2);
            $table->decimal('tva20',12, 2);
            $table->text('infoOrder')->nullable();
            $table->string('deliTime');
            $table->string('deliType');
            $table->timestamps();
            $table->boolean('orderStatus')->default(0);
            $table->boolean('paymentStatus')->default(0);
            $table->string('paygreenID')->nullable();

            $table->foreign('user_id')
                ->references('id')
                ->on('users')
                ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('orders');
    }
}
