<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrderTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('order', function (Blueprint $table) {
            $table->id();
            $table->foreignId('order_status_id')->constrained('order_status');
            $table->foreignId('payment_method_id')->constrained('payment_methods');
            $table->string('total_payment');
            $table->string('customer_name');
            $table->string('customer_phone');
            $table->string('client_ip');
            $table->text('note')->nullable();
            $table->date('order_date');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('order');
    }
}
