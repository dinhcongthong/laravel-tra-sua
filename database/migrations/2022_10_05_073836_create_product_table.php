<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('product', function (Blueprint $table) {
            $table->id();
            $table->foreignId('store_id')->constrained('store');
            $table->bigInteger('crawl_id')->nullable();
            $table->string('name');
            $table->text('description')->nullable();
            $table->foreignId('gallery_id')->constrained('gallery');
            $table->bigInteger('price');
            $table->string('discount')->nullable();
            $table->foreignId('product_status_id')->constrained('product_status');
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
        Schema::dropIfExists('product');
    }
}
